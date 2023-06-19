
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

    $premio = anti_injection($_POST['premio']);

    $sql = "select * from sorteio where md5(id) = '$premio' and cliente = $cliente";
    $rs = $conn->query($sql);

    if ($rs->rowCount() > 0) {

        $dados = $rs->fetch(PDO::FETCH_ASSOC);
        $id = $dados['id'];

        if ($dados['recebido' == 'S']) {
            echo json_encode('Você já recebeu esse prêmio.', JSON_PRETTY_PRINT);
        } else {
            $conn->query("update sorteio set recebido = 'S', datarecebido = now() where id = $id");
            echo json_encode('true', JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode('Prêmio não encontrado', JSON_PRETTY_PRINT);
    }
}
