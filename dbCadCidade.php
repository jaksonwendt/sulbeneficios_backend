<?php

session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";

if ($_REQUEST['action'] == 'insert') {

    $cidade = anti_injection($_REQUEST['cidade']);

    $sql = "insert into cidades (cidade) values ('$cidade')";
    $conn->query($sql);

    header("location: listaCidades.php");
} elseif ($_REQUEST['action'] == 'edit') {

    $id = anti_injection($_REQUEST['id']);
    $cidade = anti_injection($_REQUEST['cidade']);

    $sql = "update cidades set cidade = '$cidade' where id = $id";
    $conn->query($sql);

    header("location: listaCidades.php");
} elseif ($_REQUEST['action'] == 'delete') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "delete from cidades where id = $id";
    $conn->query($sql);

    header("location: listaCidades.php");
}
