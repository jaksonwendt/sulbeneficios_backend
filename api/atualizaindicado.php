<?php

require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//header('Content-Type: application/json');

$id = (!empty($_POST['id'])) ? anti_injection($_POST['id']) : "";
$indicado = (!empty($_POST['indicado'])) ? anti_injection($_POST['indicado']) : "";

if (!empty($id)) {
    $sql = "select id, nome from clientes where md5(clientes.id) = '$id'";
    $rs = $conn->query($sql);
    if ($rs->rowCount() > 0) {
        $dados = $rs->fetch(PDO::FETCH_ASSOC);
        $cliente = $dados['id'];
        $nomeCliente = $dados['nome'];

        if (is_numeric($indicado)) {
            $sql = "update clientes set indicado = '$indicado' where id = $cliente";
            $conn->query($sql);

            //Verificar se foi indicado por alguém e creditar os pontos - 2 pontos para indicante
            $sqlIndicado = "select indicado from clientes where id = $cliente";
            $rsIndicado = $conn->query($sqlIndicado);

            if ($rsIndicado->rowCount() > 0) {
                $indicado = $rsIndicado->fetchColumn();

                if (!empty($indicado)) {
                    $sqlValida = "select * from pontos where descricao like '%#$cliente#%'";
                    $rsValida = $conn->query($sqlValida);

                    if ($rsValida->rowCount() == 0) {

                        $sqlNomeIndicado = "select * from clientes where id = $indicado";
                        $rsNomeIndicado = $conn->query($sqlNomeIndicado);

                        if ($rsNomeIndicado->rowCount() > 0) {
                            $textoIndicado = utf8_decode("Indicação #" . $cliente . "# " . $nomeCliente);
                            $sqlPontuar = "insert into pontos (cliente, descricao, data, pontos, tipo) values ($indicado, '$textoIndicado', now(), '2', 'C')";
                            $conn->query($sqlPontuar);
                        }
                    }
                }
            }
        }
    }
}
