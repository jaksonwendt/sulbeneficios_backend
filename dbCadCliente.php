<?php

session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";
require_once "lib/WideImage/WideImage.php";

if ($_REQUEST['action'] == 'insert') {
    $nome = anti_injection($_REQUEST['nome']);
    $sobrenome = anti_injection($_REQUEST['sobrenome']);
    $datanasc = anti_injection($_REQUEST['datanasc']);
    $cpf = anti_injection($_REQUEST['cpf']);
    $genero = anti_injection($_REQUEST['genero']);
    $whatsapp = anti_injection($_REQUEST['whatsapp']);
    $ativo = anti_injection($_REQUEST['ativo']);
    $datacad = anti_injection($_REQUEST['datacad']);
    $local = anti_injection($_REQUEST['local']);
    $cep = anti_injection($_REQUEST['cep']);
    $endereco = anti_injection($_REQUEST['endereco']);
    $numero = anti_injection($_REQUEST['numero']);
    $bairro = anti_injection($_REQUEST['bairro']);
    $complemento = anti_injection($_REQUEST['complemento']);
    $cidade = anti_injection($_REQUEST['cidade']);
    $estado = anti_injection($_REQUEST['estado']);

    $senha = gerarSenha();
    $password = md5($senha);

    //Todo
    $mensagem = "Olá $nome. Seu cadastro no Sul Benefícios foi criado com sucesso. Baixe o app e comece a usar. Para entrar use seu *CPF* e senha *$senha*";
    disparaWhatsApp($whatsapp, $mensagem);

    $sql = "insert into clientes (nome, sobrenome, datanasc, cpf, genero, whatsapp, cep, endereco, numero, complemento, bairro, cidade, estado, ativo, datacad, local, password) values ('$nome', '$sobrenome', '$datanasc', '$cpf', '$genero', '$whatsapp', '$cep', '$endereco', '$numero', '$bairro', '$complemento', '$cidade', '$estado', '$ativo', '$datacad', '$local', '$password')";
    $conn->query($sql);

    $id = $conn->lastInsertId();

    header("location: cadCliente.php?action=edit&id=$id");
} elseif ($_REQUEST['action'] == 'edit') {

    $id = anti_injection($_REQUEST['id']);
    $nome = anti_injection($_REQUEST['nome']);
    $sobrenome = anti_injection($_REQUEST['sobrenome']);
    $datanasc = anti_injection($_REQUEST['datanasc']);
    $cpf = anti_injection($_REQUEST['cpf']);
    $genero = anti_injection($_REQUEST['genero']);
    $whatsapp = anti_injection($_REQUEST['whatsapp']);
    $ativo = anti_injection($_REQUEST['ativo']);
    $cep = anti_injection($_REQUEST['cep']);
    $endereco = anti_injection($_REQUEST['endereco']);
    $numero = anti_injection($_REQUEST['numero']);
    $bairro = anti_injection($_REQUEST['bairro']);
    $complemento = anti_injection($_REQUEST['complemento']);
    $cidade = anti_injection($_REQUEST['cidade']);
    $estado = anti_injection($_REQUEST['estado']);

    if (isset($_REQUEST['password']) && !empty($_REQUEST['password'])) {
        $senha = md5($_REQUEST['password']);
        $sqlSenha = " , password = '$senha'";
    } else {
        $sqlSenha = "";
    }

    $sql = "update clientes set nome = '$nome', sobrenome = '$sobrenome', datanasc = '$datanasc', cpf = '$cpf', genero = '$genero', whatsapp = '$whatsapp', ativo = '$ativo', cep = '$cep', endereco = '$endereco', numero = '$numero', bairro = '$bairro', complemento = '$complemento', cidade = '$cidade', estado = '$estado' $sqlSenha where id = $id";
    $conn->query($sql);

    //echo $sql;

    header("location: listaClientes.php");
} elseif ($_REQUEST['action'] == 'delete') {
    $id = anti_injection($_REQUEST['id']);

    $sql = "delete from clientes where id = $id";
    $conn->query($sql);

    header("location: listaClientes.php");
} elseif ($_REQUEST['action'] == 'assinatura') {

    $cliente = anti_injection($_REQUEST['cliente']);
    $datacad = anti_injection($_REQUEST['datacad']);
    $datainicio = (!empty($_REQUEST['datainicio'])) ? $_REQUEST['datainicio'] : date("Y-m-d");
    $datafim = (!empty($_REQUEST['datafim'])) ? $_REQUEST['datafim'] : date("Y-m-d");
    $valor = anti_injection($_REQUEST['valor']);
    $status = moedaBanco($_REQUEST['status']);

    $sql = "insert into assinatura (cliente, data, status, inicio, fim, valor) values ('$cliente', '$datacad', '$status', '$datainicio', '$datafim', '$valor')";
    $sql = $conn->query($sql);

    header("location: cadCliente.php?action=edit&id=$cliente");
} elseif ($_REQUEST['action'] == 'excluirassinatura') {

    $cliente = anti_injection($_REQUEST['cliente']);
    $assinatura = anti_injection($_REQUEST['assinatura']);

    $sql = "delete from assinatura where id = $assinatura";
    $conn->query($sql);

    header("location: cadCliente.php?action=edit&id=$cliente");
}
