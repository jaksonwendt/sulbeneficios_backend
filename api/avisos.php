<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header('Content-Type: application/json');

$sql = "SELECT * FROM avisos";
$rs = $conn->query($sql);

if ($rs->rowCount() > 0) {
    $dados = $rs->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($dados, JSON_PRETTY_PRINT);
}
