<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header('Content-Type: application/json');

$id = anti_injection($_POST['id']);

if (!empty($id)){

$sql = "select nome, fim, (COALESCE((SELECT SUM(valor) FROM utilizacao WHERE cliente = clientes.id), 0)) + 
(COALESCE((select sum(valor) from sorteio where cliente = clientes.id and recebido = 'S'), 0)) as total from clientes, assinatura where clientes.id = assinatura.cliente and assinatura.status = 'Pago' and md5(clientes.id) = '$id' order by fim desc limit 0, 1";
$rs = $conn->query($sql);

if ($rs->rowCount() > 0) {
    $dados = $rs->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($dados, JSON_PRETTY_PRINT);
} else {
    $sql = "select nome from clientes where md5(clientes.id) = '$id'";
    $rs = $conn->query($sql);

    $nome = $rs->fetch(PDO::FETCH_ASSOC);

    $dados = array();
    $ln['nome'] = $nome['nome'];
    $ln['fim'] = '1999-12-31';
    $ln['valor'] = 0;
    array_push($dados, $ln);

    echo json_encode($dados, JSON_PRETTY_PRINT);
}
}else{
	echo json_encode("Erro", JSON_PRETTY_PRINT);
}