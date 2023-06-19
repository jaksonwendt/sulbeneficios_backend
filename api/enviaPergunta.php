
<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//POST
$id = anti_injection($_POST['cliente']);
$hash = anti_injection($_POST['hash']);

$sql = "select id from clientes where md5(cpf) = '$hash' and md5(id) = '$id'";
$rs = $conn->query($sql);

if ($rs->rowCount() > 0) {
    $cliente = $rs->fetchColumn();

    $profissional = anti_injection($_POST['profissional']);
    $mensagem = anti_injection($_POST['mensagem']);
    $data = date("Y-m-d");
    $status = 1;

    $sql = "insert into perguntas (cliente, profissional, data, status, pergunta) values ('$cliente', '$profissional', '$data', '$status', '$mensagem')";
    if ($conn->query($sql)) {
        echo json_encode('true', JSON_PRETTY_PRINT);
    } else {
        echo json_encode('false', JSON_PRETTY_PRINT);
    }
}
