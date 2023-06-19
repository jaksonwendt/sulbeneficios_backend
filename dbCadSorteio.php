<?php

session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";

if ($_REQUEST['action'] == 'insert') {

    $cliente = anti_injection($_REQUEST['cliente']);
    $premio = anti_injection($_REQUEST['premio']);
    $valor = moedaBanco($_REQUEST['valor']);
    $data = $_REQUEST['data'];
    $recebido = anti_injection($_REQUEST['recebido']);
    $datarecebido = $_REQUEST['datarecebido'];

    $sql = "insert into sorteio (cliente, premio, valor, data, recebido, datarecebido) values ('$cliente', '$premio', '$valor', '$data', '$recebido', '$datarecebido')";
    $conn->query($sql);

    header("location: listaSorteios.php");
} elseif ($_REQUEST['action'] == 'edit') {

    $id = anti_injection($_REQUEST['id']);
    $cliente = anti_injection($_REQUEST['cliente']);
    $premio = anti_injection($_REQUEST['premio']);
    $valor = moedaBanco($_REQUEST['valor']);
    $data = $_REQUEST['data'];
    $recebido = anti_injection($_REQUEST['recebido']);
    $datarecebido = $_REQUEST['datarecebido'];

    $sql = "update sorteio set cliente = '$cliente', premio = '$premio', valor = '$valor', data = '$data', recebido = '$recebido', datarecebido = '$datarecebido' where id = $id";
    $conn->query($sql);

    header("location: listaSorteios.php");
} elseif ($_REQUEST['action'] == 'delete') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "delete from sorteio where id = $id";
    $conn->query($sql);

    header("location: listaSorteios.php");
}
