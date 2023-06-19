<?php

session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";

if ($_REQUEST['action'] == 'insert') {

    $nome = anti_injection($_REQUEST['nome']);
    $email = anti_injection($_REQUEST['email']);
    $senha = md5($_REQUEST['senha']);
    $perfil = anti_injection($_REQUEST['perfil']);
    $ativo = anti_injection($_REQUEST['ativo']);

    $sql = "insert into usuarios (nome, login, senha, perfil, ativo) values ('$nome', '$email', '$senha', '$perfil', '$ativo')";
    $conn->query($sql);

    header("location: listaUsuario.php");
} elseif ($_REQUEST['action'] == 'edit') {

    $id = anti_injection($_REQUEST['id']);
    $nome = anti_injection($_REQUEST['nome']);
    $email = anti_injection($_REQUEST['email']);
    $senha = md5($_REQUEST['senha']);
    $perfil = anti_injection($_REQUEST['perfil']);
    $ativo = anti_injection($_REQUEST['ativo']);

    if (empty($_REQUEST['senha'])) {
        $sql = "update usuarios set nome = '$nome', login = '$email', perfil = '$perfil', ativo = '$ativo' where idusuario = $id";
        $conn->query($sql);
    } else {
        $sql = "update usuarios set nome = '$nome', login = '$email', perfil = '$perfil', ativo = '$ativo', senha = '$senha' where idusuario = $id";
        $conn->query($sql);
    }

    $sql;

    header("location: listaUsuario.php");
} elseif ($_REQUEST['action'] == 'delete') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "delete from usuarios where idusuario = $id";
    $conn->query($sql);

    header("location: listaUsuario.php");
}
