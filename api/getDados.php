<?php

use MercadoPago\POS;

require_once '../vendor/autoload.php';
require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header('Content-Type: application/json');

$id = isset($_POST['id']) ? anti_injection($_POST['id']) : "";
$hash = isset($_POST['hash']) ? anti_injection($_POST['hash']) : "";

/*
$retorno = array();
$retorno['1'] = $id;
$retorno['2'] = $hash;

echo json_encode($retorno, JSON_PRETTY_PRINT);
*/

if ($id != "" && $hash != "") {

    $sql = "select * from clientes where md5(cpf) = '$hash' and md5(id) = '$id'";
    $rs = $conn->query($sql);

    if ($rs->rowCount() > 0) {
        $dados = $rs->fetch(PDO::FETCH_ASSOC);

        $cliente = array();
        $cliente['id'] = $dados['id'];
        $cliente['nome'] = $dados['nome'];
        $cliente['sobrenome'] = $dados['sobrenome'];
        $cliente['datanasc'] = normalizaData($dados['datanasc']);
        $cliente['genero'] = $dados['genero'];
        $cliente['whatsapp'] = $dados['whatsapp'];
        $cliente['cep'] = $dados['cep'];
        $cliente['cpf'] = $dados['cpf'];
        $cliente['dataalt'] = $dados['dataalt'];
        $cliente['indicado'] = $dados['indicado'];

        echo json_encode($cliente, JSON_PRETTY_PRINT);
    }
}
