<?php

require_once '../vendor/autoload.php';
require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$id = isset($_POST['id']) ? anti_injection($_POST['id']) : "";
$codigo = isset($_POST['codigo']) ? anti_injection($_POST['codigo']) : "";

if ($id != "" && $codigo != "") {

    $data = date("Y-m-d");

    $sql = "select * from codigos where md5(cliente) = '$id' and codigo = '$codigo' and ativo = 'S' and data = '$data'";
    $rs = $conn->query($sql);

    if ($rs->rowCount() > 0) {

        $dados = $rs->fetch(PDO::FETCH_ASSOC);

        $retorno = array();
        $retorno['status'] = "true";
        $retorno['comercio'] = $dados['comercio'];
		
		$conn->query("update codigos set ativo = 'N' where codigo = '$codigo'");

        echo json_encode($retorno, JSON_PRETTY_PRINT);
    } else {
        $retorno = array();
        $retorno['status'] = "false";
        $retorno['comercio'] = "";

        echo json_encode($retorno, JSON_PRETTY_PRINT);
    }
} else {
    $retorno = array();
    $retorno['status'] = "false";
    $retorno['comercio'] = "";

    echo json_encode($retorno, JSON_PRETTY_PRINT);
}
