
<?php
//PHP 7 : composer require "mercadopago/dx-php:2.5.3"
//PHP 5 : composer require "mercadopago/dx-php:1.12.5"

require_once '../vendor/autoload.php';
require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//MercadoPago\SDK::setAccessToken("APP_USR-6188932688013057-021412-6937ef9e8cc3daceb3499806642c7c79-1015014769");
MercadoPago\SDK::setAccessToken("APP_USR-6506092667463422-060807-77e18ed3d04e9c5d77ca704633fa3284-1383492123"); //Winderson

if (isset($_POST['type'])) {
    if ($_POST['type'] == 'renovacao') {
        $id = anti_injection($_POST['id']);
        $sql = "select * from clientes where md5(id) = '$id'";
        $rs = $conn->query($sql);

        if ($rs->rowCount() > 0) {
            $dados = $rs->fetch(PDO::FETCH_ASSOC);

            $cliente = $dados['id'];
            $nome = $dados['nome'];
            $sobrenome = $dados['sobrenome'];
            $cpf = $dados['cpf'];
            $cep = $dados['cep'];

            //CAPTURA ENDEREÇO
            $url = "https://viacep.com.br/ws/{$cep}/json/";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $endereco = json_decode($response);
            if ($endereco) {
                $logradouro = $endereco->logradouro;
                $bairro = $endereco->bairro;
                $cidade = $endereco->localidade;
                $uf = $endereco->uf;
            }
        } else {
            echo "Cadastro incompleto. Entre em contato com o suporte.";
        }
    }
} else {

    //POST
    $nome = anti_injection($_POST['nome']);
    $sobrenome = anti_injection($_POST['sobrenome']);
    $datanasc = inverteData($_POST['datanasc']);
    $cpf = anti_injection($_POST['cpf']);
    $genero = anti_injection($_POST['genero']);
    $whatsapp = anti_injection($_POST['whatsapp']);
    $cep = anti_injection($_POST['cep']);

    //CAPTURA ENDEREÇO
    $url = "https://viacep.com.br/ws/{$cep}/json/";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $endereco = json_decode($response);
    if ($endereco) {
        $logradouro = $endereco->logradouro;
        $bairro = $endereco->bairro;
        $cidade = $endereco->localidade;
        $uf = $endereco->uf;
    }

    //INSERE CLIENTE
    $sql = "insert into clientes (nome, sobrenome, datanasc, cpf, genero, whatsapp, cep, endereco, numero, complemento, bairro, cidade, estado, ativo, datacad, local, password) values ('$nome', '$sobrenome', '$datanasc', '$cpf', '$genero', '$whatsapp', '$cep', '$logradouro', '0', '$bairro', '', '$cidade', '$uf', 'S', now(), 'APP', '559d712599f9fd9aab5d4135cf48f1ee')";
    $conn->query($sql);

    $cliente = $conn->lastInsertId();
}

//INSERE ASSINATURA
$inicio = date("Y-m-d");
$fim = incDay($inicio, 30);
$sql = "insert into assinatura (cliente, data, status, inicio, fim, valor) values ('$cliente', now(), 'Em Aberto', '$inicio', '$fim', '11.90')";
$sql = $conn->query($sql);

$assinatura = $conn->lastInsertId();

//MERCADO PAGO
$payment = new MercadoPago\Payment();
$payment->transaction_amount = 11.90;
//$payment->transaction_amount = 1.00;
$payment->description = "Clube de benefícios";
$payment->payment_method_id = "pix";
$payment->notification_url = 'https://clubedebeneficiosdosul.com.br/api/retorno.php';
$payment->issuer_id = $assinatura;
$payment->payer = array(
    "email" => "$cliente@clubedebeneficiosdosul.com.br",
    "first_name" => "$nome",
    "last_name" => "$sobrenome",
    "identification" => array(
        "type" => "CPF",
        "number" => "$cpf"
    ),
    "address" =>  array(
        "zip_code" => "$cep",
        "street_name" => "$logradouro",
        "street_number" => "0",
        "neighborhood" => "$bairro",
        "city" => "$cidade",
        "federal_unit" => "$uf"
    )
);

$payment->save();

//var_dump($payment);

$conn->query("update assinatura set mercadopago = '" . $payment->id . "' where id = $assinatura");

echo $payment->point_of_interaction->transaction_data->qr_code;
