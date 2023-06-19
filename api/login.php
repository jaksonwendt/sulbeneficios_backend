<?php

require_once '../vendor/autoload.php';
require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header('Content-Type: application/json');

$login = isset($_POST['login']) ? anti_injection($_POST['login']) : "";
$senha = isset($_POST['senha']) ? anti_injection($_POST['senha']) : "";

if ($login != "" && $senha != "") {

    $sql = "select * from clientes where cpf = '$login' and password = '" . md5($senha) . "' and ativo = 'S'";
    $rs = $conn->query($sql);

    if ($rs->rowCount() > 0) {
        $dados = $rs->fetch(PDO::FETCH_ASSOC);

        $retorno = array();
        $retorno['status'] = "Autorizado";
        $retorno['id'] = md5($dados['id']);
        $retorno['hash'] = md5($dados['cpf']);

        echo json_encode($retorno, JSON_PRETTY_PRINT);
    } else {
        $dados = $rs->fetch(PDO::FETCH_ASSOC);

        $retorno = array();
        $retorno['status'] = "Erro";
        $retorno['id'] = "";
        $retorno['hash'] = "";

        echo json_encode($retorno, JSON_PRETTY_PRINT);
    }
} else {

    $retorno = array();
    $retorno['status'] = "Erro";
    $retorno['id'] = "";
    $retorno['hash'] = "";

    echo json_encode($retorno, JSON_PRETTY_PRINT);
}
