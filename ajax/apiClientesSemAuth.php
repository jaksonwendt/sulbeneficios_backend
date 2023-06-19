<?php

session_start();

require_once "../session.php";
require_once "../lib/conexao.php";
require_once "../lib/functions.php";

header('Content-Type: application/json');

$codigo = anti_injection($_REQUEST['codigo']);

$sql = "select id, concat(trim(clientes.nome), ' ', trim(clientes.sobrenome)) as nome from clientes where id = $codigo order by nome";
$rs = $conn->query($sql);

if ($rs->rowCount() > 0) {
    $return = array();

    while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
        $cliente = array();
        $cliente['id'] = $ln['id'];
        $cliente['nome'] = $ln['nome'];
        array_push($return, $cliente);
    }


    echo json_encode($return, JSON_PRETTY_PRINT);
} else {
    return;
}
