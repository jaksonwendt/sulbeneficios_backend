 <?php

require_once '../vendor/autoload.php';
require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header('Content-Type: application/json');

$cpf = isset($_POST['cpf']) ? anti_injection($_POST['cpf']) : "";

if ($cpf != "") {

    $sql = "select * from clientes where cpf = '$cpf'";
    $rs = $conn->query($sql);

    if ($rs->rowCount() > 0) {
        $dados = $rs->fetch(PDO::FETCH_ASSOC);

        $retorno = array();
        $retorno['status'] = "Existe";

        echo json_encode($retorno, JSON_PRETTY_PRINT);
    } else {
        $dados = $rs->fetch(PDO::FETCH_ASSOC);

        $retorno = array();
        $retorno['status'] = "Liberado";
        $retorno['id'] = "";
        $retorno['hash'] = "";

        echo json_encode($retorno, JSON_PRETTY_PRINT);
    }
} else {

    $retorno = array();
    $retorno['status'] = "Erro";

    echo json_encode($retorno, JSON_PRETTY_PRINT);
}
