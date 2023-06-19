<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header('Content-Type: application/json');

$cliente = isset($_POST['cliente']) ? anti_injection($_POST['cliente']) : "xxx";

if ($cliente != "") {

    $sql = "select utilizacao.id, nome, categoriaben.categoria, data, valor, tipo, 'ok' as status from utilizacao, comercio, categoriaben where utilizacao.comercio = comercio.id and categoriaben.id = comercio.categoria and md5(cliente) = '$cliente' UNION select sorteio.id, 'Sul Benefícios', premio, data, valor, 'P', recebido from sorteio where md5(cliente) = '$cliente' order by data desc";
    $rs = $conn->query($sql);

    if ($rs->rowCount() > 0) {
        $dados = array();

        while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
            $dado = array();

            $dado['nome'] = $ln['nome'];
            $dado['categoria'] = $ln['categoria'];
            $dado['id'] = $ln['id'];
            $dado['recebido'] = $ln['status'];
            $dado['data'] = normalizaData($ln['data']);
            $dado['valor'] = moedaUsuario($ln['valor']);

            if ($ln['tipo'] == 'D') {
                $dado['tipo'] = 'Desconto';
            } else {
                $dado['tipo'] = 'Prêmio';
            }

            array_push($dados, $dado);
        }

        echo json_encode($dados, JSON_PRETTY_PRINT);
    }
}
