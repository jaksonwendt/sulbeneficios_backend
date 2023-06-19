<?php

session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";
require_once "lib/WideImage/WideImage.php";

if ($_REQUEST['action'] == 'insert') {

    $categoria = anti_injection($_REQUEST['categoria']);

    $icone = imagemBanco($_FILES['icone'], 'storage', 135, 135);

    $sql = "insert into categoria (categoria, icone) values ('$categoria', '$icone')";
    $conn->query($sql);

    header("location: listaCategoria.php");
} elseif ($_REQUEST['action'] == 'edit') {

    $id = anti_injection($_REQUEST['id']);
    $categoria = anti_injection($_REQUEST['categoria']);

    $icone = imagemBanco($_FILES['icone'], 'storage', 135, 135);

    if (!empty($icone)) {
        $sql = "update categoria set categoria = '$categoria', icone = '$icone' where id = $id";
    } else {
        $sql = "update categoria set categoria = '$categoria' where id = $id";
    }

    $conn->query($sql);

    header("location: listaCategoria.php");
} elseif ($_REQUEST['action'] == 'delete') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "delete from categoria where id = $id";
    $conn->query($sql);

    header("location: listaCategoria.php");
} elseif ($_REQUEST['action'] == 'deletelogo') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "update categoria set icone = '' where id = $id";
    $conn->query($sql);

    header("location: cadCategoria.php?action=edit&id=$id");
}
