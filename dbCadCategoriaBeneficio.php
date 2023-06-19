<?php

session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";

if ($_REQUEST['action'] == 'insert') {

    $categoria = anti_injection($_REQUEST['categoria']);

    $sql = "insert into categoriaben (categoria) values ('$categoria')";
    $conn->query($sql);

    header("location: listaCategoriasBeneficios.php");
} elseif ($_REQUEST['action'] == 'edit') {

    $id = anti_injection($_REQUEST['id']);
    $categoria = anti_injection($_REQUEST['categoria']);

    $sql = "update categoriaben set categoria = '$categoria' where id = $id";
    $conn->query($sql);

    header("location: listaCategoriasBeneficios.php");
} elseif ($_REQUEST['action'] == 'delete') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "delete from categoriaben where id = $id";
    $conn->query($sql);

    header("location: listaCategoriasBeneficios.php");
}
