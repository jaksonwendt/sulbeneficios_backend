
<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//POST
$id = anti_injection($_POST['cliente']);

$sql = "select * from pontos where md5(cliente) = '$id' order by data desc";
$rs = $conn->query($sql);

if ($rs->rowCount() > 0) {
    $dados = array();
    while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
        $ponto = array();
        $ponto['data'] = normalizaDataHora2($ln['data']);
        $ponto['descricao'] = utf8_encode($ln['descricao']);
        $ponto['pontos'] = $ln['pontos'];
        $ponto['tipo'] = $ln['tipo'];

        array_push($dados, $ponto);
    }

    echo json_encode($dados, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode('false', JSON_PRETTY_PRINT);
}
