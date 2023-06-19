
<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header('Content-Type: application/json');

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

    $sql = "SELECT * FROM perguntas WHERE data > DATE_SUB(CURDATE(), INTERVAL 30 DAY) and cliente = $cliente";
    $rs = $conn->query($sql);

    if ($rs->rowCount() > 0) {
        echo json_encode('bloqueado', JSON_PRETTY_PRINT);
    } else {
        echo json_encode('liberado', JSON_PRETTY_PRINT);
    }
}
