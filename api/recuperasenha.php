<?php
require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$cpf = (isset($_POST['cpf'])) ? anti_injection($_POST['cpf']) : "";

if ($cpf != "") {
    $sql = "select id, whatsapp from clientes where cpf = '$cpf'";
    $rs = $conn->query($sql);

    if ($rs->rowCount() > 0) {
        $dados = $rs->fetch(PDO::FETCH_ASSOC);

        $id = $dados['id'];
        $whatsapp = $dados['whatsapp'];

        $senha = gerarSenha(6, false, false, true, false);
        $senhamd5 = md5($senha);

        $sql = "update clientes set password = '$senhamd5' where id = $id";
        $conn->query($sql);

        disparaWhatsApp($whatsapp, "Sua nova senha é: $senha");

        echo "Senha enviada.";
    }
}
