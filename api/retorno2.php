<?php
require_once '../vendor/autoload.php';
require_once '../lib/conexao.php';
require_once '../lib/functions.php';

$sql = "select cliente from assinatura where mercadopago = '59664551018'";
$rs = $conn->query($sql);
if ($rs->rowCount() > 0) {
    $cliente = $rs->fetchColumn();

    $sqlRenovacao = "select * from assinatura where status = 'Pago' and cliente = $cliente";
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
