<?php

session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";
require_once "lib/WideImage/WideImage.php";

if ($_REQUEST['action'] == 'insert') {

    $nome = anti_injection($_REQUEST['nome']);
    $categoria = anti_injection($_REQUEST['categoria']);
    $descricao = anti_injection($_REQUEST['descricao']);

    $foto = imagemBanco($_FILES['foto'], 'storage', 300, 300);

    $sql = "insert into profissionais (nome, categoria, descricao, foto) values ('$nome', '$categoria', '$descricao', '$foto')";
    $conn->query($sql);

    header("location: listaProfissionais.php");
} elseif ($_REQUEST['action'] == 'edit') {

    $id = anti_injection($_REQUEST['id']);
    $nome = anti_injection($_REQUEST['nome']);
    $categoria = anti_injection($_REQUEST['categoria']);
    $descricao = anti_injection($_REQUEST['descricao']);

    $foto = imagemBanco($_FILES['foto'], 'storage', 300, 300);

    if (!empty($foto)) {
        $sql = "update profissionais set nome = '$nome', categoria = '$categoria', descricao = '$descricao', foto = '$foto' where id = $id";
    } else {
        $sql = "update profissionais set nome = '$nome', categoria = '$categoria', descricao = '$descricao' where id = $id";
    }

    $conn->query($sql);

    header("location: listaProfissionais.php");
} elseif ($_REQUEST['action'] == 'delete') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "delete from profissionais where id = $id";
    $conn->query($sql);

    header("location: listaProfissionais.php");
} elseif ($_REQUEST['action'] == 'deletelogo') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "update profissionais set foto = '' where id = $id";
    $conn->query($sql);

    header("location: cadProfissionais.php?action=edit&id=$id");
}
