<?php

session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";
require_once "lib/WideImage/WideImage.php";

if ($_REQUEST['action'] == 'edit') {

    $id = anti_injection($_REQUEST['id']);
    $status = anti_injection($_REQUEST['status']);
    $video = $_REQUEST['video'];

    $data_resposta = ($status == 2) ? date("Y-m-d") : null;

    $sql = "update perguntas set video = '$video', status = '$status', data_resposta = '$data_resposta' where id = $id";
    $conn->query($sql);

    header("location: listaPerguntas.php");
} elseif ($_REQUEST['action'] == 'delete') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "delete from perguntas where id = $id";
    $conn->query($sql);

    header("location: listaPerguntas.php");
}
