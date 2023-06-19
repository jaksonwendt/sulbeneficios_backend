<?php

session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";
require_once "lib/WideImage/WideImage.php";

if ($_REQUEST['action'] == 'edit') {

    $id = anti_injection($_REQUEST['id']);
    $valor = moedaBanco($_REQUEST['valor']);
    $data = $_REQUEST['data'];

    $sql = "update utilizacao set valor = '$valor', data = '$data' where id = $id";
    $conn->query($sql);

    header("location: listaUtilizacao.php");
} elseif ($_REQUEST['action'] == 'delete') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "delete from utilizacao where id = $id";
    $conn->query($sql);

    header("location: listaUtilizacao.php");
}
