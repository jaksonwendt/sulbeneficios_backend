
<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//POST
$id = anti_injection($_POST['cliente']);

$sql = "select sum(pontos) as pontos from pontos where  md5(cliente) = '$id'";
$rs = $conn->query($sql);

if ($rs->rowCount() > 0) {
    $pontos = $rs->fetchColumn();

    echo json_encode($pontos, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode('false', JSON_PRETTY_PRINT);
}
