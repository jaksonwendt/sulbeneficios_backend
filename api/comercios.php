<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header('Content-Type: application/json');

if (isset($_POST['cidade'])) {
    $cidade = anti_injection($_POST['cidade']);

    $sql = "select nome, logo, desconto, categoriaben.categoria from comercio, categoriaben where comercio.categoria = categoriaben.id and ativo = 'S' and cidade = $cidade";
} else {
    $sql = "select nome, logo, desconto, categoriaben.categoria from comercio, categoriaben where comercio.categoria = categoriaben.id and ativo = 'S'";
}

//echo $sql;

$rs = $conn->query($sql);

if ($rs->rowCount() > 0) {
    $dados = array();

    while ($ln = $rs->fetch(PDO::FETCH_ASSOC)){
        $comercio = array();
        $comercio['nome'] = ($ln['nome']);
        $comercio['logo'] = ($ln['logo']);
        $comercio['desconto'] = ($ln['desconto']);
        $comercio['categoria'] = ($ln['categoria']);

        array_push($dados, $comercio);
    }


    echo json_encode($dados, JSON_UNESCAPED_UNICODE);
}
