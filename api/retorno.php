<?php
require_once '../vendor/autoload.php';
require_once '../lib/conexao.php';
require_once '../lib/functions.php';

//MercadoPago\SDK::setAccessToken("APP_USR-6188932688013057-021412-6937ef9e8cc3daceb3499806642c7c79-1015014769");
MercadoPago\SDK::setAccessToken("APP_USR-6506092667463422-060807-77e18ed3d04e9c5d77ca704633fa3284-1383492123"); //Winderson

$merchant_order = null;

switch ($_GET["topic"]) {
    case "payment":
        $payment = MercadoPago\Payment::find_by_id($_GET["id"]);
        $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);
        break;
}

if ($payment->status == 'approved') {
    $id = $_GET["id"];
    $conn->query("update assinatura set status = 'Pago' where mercadopago = '$id'");

    $sql = "select cliente from assinatura where mercadopago = '$id'";
    $rs = $conn->query($sql);
    if ($rs->rowCount() > 0) {
        $cliente = $rs->fetchColumn();

        $sqlRenovacao = "select * from assinatura where status = 'Pago'";;
        $rsRenovavao = $conn->query($sqlRenovacao);

        if ($rsRenovavao->rowCount() == 1) {

            $pass = gerarSenha(6, false, false, true, false);
            $senha = md5($pass);

            $conn->query("update clientes set password = '$senha' where id = $cliente");

            $sql = "select nome, whatsapp from clientes where id = $cliente";
            $rs = $conn->query($sql);

            if ($rs->rowCount() > 0) {
                $dados = $rs->fetch(PDO::FETCH_ASSOC);
                $texto = "Olá " . $dados['nome'] . ", sua senha para acessar o aplicativo é $pass.";

                disparaWhatsApp($dados['whatsapp'], $texto);
            }
        }
    }
}
