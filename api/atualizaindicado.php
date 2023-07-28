<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//header('Content-Type: application/json');

$id = anti_injection($_POST['id']);
$indicado = anti_injection($_POST['indicado']);

echo $id;
echo "<br>";
echo $indicado;

if (!empty($id)) {
    $sql = "select id from clientes where md5(clientes.id) = '$id'";
    $rs = $conn->query($sql);
    if ($rs->rowCount() > 0) {
        $dados = $rs->fetchColumn();

        if (is_numeric($indicado)) {
            $sql = "update clientes set indicado = '$indicado' where id = $dados";
            $conn->query($sql);
        }
    }
}
