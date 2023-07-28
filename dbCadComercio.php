<?php

session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";
require_once "lib/WideImage/WideImage.php";

if ($_REQUEST['action'] == 'insert') {

    $nome = anti_injection($_REQUEST['nome']);
    $categoria = anti_injection($_REQUEST['categoria']);
    $cidade = anti_injection($_REQUEST['cidade']);
    $desconto = anti_injection($_REQUEST['desconto']);
    $ativo = anti_injection($_REQUEST['ativo']);
    $whatsapp = anti_injection($_REQUEST['whatsapp']);

    $logo = imagemBanco($_FILES['logo'], 'storage', 150, 100);

    $sql = "insert into comercio (nome, logo, categoria, cidade, desconto, ativo, whatsapp) values ('$nome', '$logo', '$categoria', '$cidade', '$desconto', '$ativo', '$whatsapp')";
    $conn->query($sql);

    header("location: listaComercios.php");
} elseif ($_REQUEST['action'] == 'edit') {

    $id = anti_injection($_REQUEST['id']);
    $nome = anti_injection($_REQUEST['nome']);
    $categoria = anti_injection($_REQUEST['categoria']);
    $cidade = anti_injection($_REQUEST['cidade']);
    $desconto = anti_injection($_REQUEST['desconto']);
    $ativo = anti_injection($_REQUEST['ativo']);
    $whatsapp = anti_injection($_REQUEST['whatsapp']);

    $logo = imagemBanco($_FILES['logo'], 'storage', 150, 100);

    if (!empty($logo)) {
        $sql = "update comercio set nome = '$nome', whatsapp = '$whatsapp', categoria = '$categoria', cidade = '$cidade', desconto = '$desconto', ativo = '$ativo', logo = '$logo' where id = $id";
    } else {
        $sql = "update comercio set nome = '$nome', whatsapp = '$whatsapp', categoria = '$categoria', cidade = '$cidade', desconto = '$desconto', ativo = '$ativo' where id = $id";
    }

    $conn->query($sql);

    header("location: listaComercios.php");
} elseif ($_REQUEST['action'] == 'delete') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "delete from comercio where id = $id";
    $conn->query($sql);

    header("location: listaComercios.php");
}elseif ($_REQUEST['action'] == 'deletelogo') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "update comercio set logo = '' where id = $id";
    $conn->query($sql);

    header("location: cadComercio.php?action=edit&id=$id");
}


