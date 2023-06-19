
<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//POST
$id = anti_injection($_POST['cliente']);
$hash = anti_injection($_POST['hash']);

$sql = "select id from clientes where md5(cpf) = '$hash' and md5(id) = '$id'";
$rs = $conn->query($sql);

if ($rs->rowCount() > 0) {
    $cliente = $rs->fetchColumn();
    $profissional = anti_injection($_POST['profissional']);

    $sql = "select * from perguntas where cliente = $cliente and profissional = $profissional order by id";
    $rs = $conn->query($sql);

    if ($rs->rowCount() > 0) {
        $dados = $rs->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($dados, JSON_PRETTY_PRINT);
    }else{
        echo json_encode("vazio", JSON_PRETTY_PRINT);
    }
}
