
<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//POST
$id = anti_injection($_POST['id']);
$hash = anti_injection($_POST['hash']);

$sql = "select id from clientes where md5(cpf) = '$hash' and md5(id) = '$id'";
$rs = $conn->query($sql);

if ($rs->rowCount() > 0) {
    $cliente = $rs->fetchColumn();

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
    $sql = "update clientes set nome = '$nome', sobrenome = '$sobrenome', datanasc = '$datanasc', cpf = '$cpf', genero = '$genero', whatsapp = '$whatsapp', cep = '$cep', endereco = '$logradouro', bairro = '$bairro', cidade = '$cidade', estado = '$uf', dataalt = now() where id = $cliente";
    $conn->query($sql);
}
