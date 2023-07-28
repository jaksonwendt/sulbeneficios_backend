
<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//POST
$id = anti_injection($_POST['cliente']);
$version = anti_injection($_POST['version']);

$sql = "select id from clientes where  md5(id) = '$id'";
$rs = $conn->query($sql);

if ($rs->rowCount() > 0) {
    $cliente = $rs->fetchColumn();

	$sql = "select * from pontos where descricao like '%$version%' and cliente = $cliente";
	$rs = $conn->query($sql);
	
	if ($rs->rowCount() == 0){
		$texto = utf8_decode("Atualização app $version");
		$sql = "insert into pontos (cliente, descricao, data, pontos, tipo) values ($cliente, '$texto', now(), '1', 'C')";
		$conn->query($sql);
	}
} else {
    echo json_encode('false', JSON_PRETTY_PRINT);
}
