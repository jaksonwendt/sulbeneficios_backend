<?php

session_start();

require_once "../session.php";
require_once "../lib/conexao.php";
require_once "../lib/functions.php";

$tipo = $_REQUEST['tipo'];
$para = $_REQUEST['para'];
$mensagem = $_REQUEST['mensagem'];

if ($tipo == 'WhatsApp' && $para == 'Todos') {
    if ($mensagem != "") {
        $sql = "select whatsapp from clientes";
        $rs = $conn->query($sql);

        $i = 0;
        if ($rs->rowCount() > 0) {
            while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                $numero = $ln['whatsapp'];
                disparaWhatsApp("$numero", $mensagem);
                $i++;
            }
        }
        echo "Disparado para $i clientes";
    }
}
