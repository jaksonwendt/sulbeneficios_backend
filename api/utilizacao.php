<?php

require_once '../vendor/autoload.php';
require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$comercio = isset($_POST['comercio']) ? anti_injection($_POST['comercio']) : "";
$cliente = isset($_POST['cliente']) ? anti_injection($_POST['cliente']) : "";
$type = isset($_POST['type']) ? anti_injection($_POST['type']) : "";

if ($comercio != "" && $cliente != "") {

    if ($type == 'check') {

        $sql = "select id from comercio where md5(id) = '$comercio'";
        $rs = $conn->query($sql);

        if ($rs->rowCount() > 0) {
            $idComercio = $rs->fetchColumn();
        }

        $sql = "select id from clientes where md5(id) = '$cliente'";
        $rs = $conn->query($sql);

        if ($rs->rowCount() > 0) {
            $idCliente = $rs->fetchColumn();
        }

        $sql = "select * from utilizacao where cliente = $idCliente and comercio = $idComercio and data >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
        $rs = $conn->query($sql);

        if ($rs->rowCount() > 0) {
            echo json_encode('utilizado', JSON_PRETTY_PRINT);
        } else {
            //Envia Código para Comércio
            $sql = "select nome, sobrenome, cpf from clientes where md5(id) = '$cliente'";
            $rs = $conn->query($sql);
            $dados = $rs->fetch(PDO::FETCH_ASSOC);
            $nome = $dados['nome'];
            $sobrenome = $dados['sobrenome'];
            $cpf = $dados['cpf'];

            $sql = "select whatsapp from comercio where md5(id) = '$comercio'";
            $rs = $conn->query($sql);
            $whatsapp = $rs->fetchColumn();

            $pass = gerarSenha(6, false, false, true, false);
            $texto = "Olá! O código do seu cliente é $pass. Confira os dados: Nome: $nome $sobrenome e CPF: $cpf";
            disparaWhatsApp($whatsapp, $texto);

            $conn->query("insert into codigos (cliente, comercio, data, codigo, ativo) values ('$idCliente', '$idComercio', now(), '$pass', 'S')");

            echo json_encode('continue', JSON_PRETTY_PRINT);
        }
    } elseif ($type == 'use') {
        $sql = "select id from clientes where md5(id) = '$cliente'";
        $rs = $conn->query($sql);

        if ($rs->rowCount() > 0) {
            $idCliente = $rs->fetchColumn();
        }

        $desconto = isset($_POST['desconto']) ? anti_injection($_POST['desconto']) : "0";
        $desconto = str_replace(".", ",", $desconto);
        $desconto = moedaBanco($desconto);

        $conn->query("insert into utilizacao (cliente, comercio, data, valor, tipo) values ('$idCliente', '$comercio', now(), '$desconto', 'D')");

        echo json_encode('finish', JSON_PRETTY_PRINT);
    }
} else {
    echo json_encode('false', JSON_PRETTY_PRINT);
}
