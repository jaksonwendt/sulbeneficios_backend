﻿<?php
session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";

if ($_REQUEST['action'] == 'insert') {

    $action = "dbCadCliente.php?action=insert";

    $id = "";
    $nome = "";
    $sobrenome = "";
    $datanasc = "";
    $cpf = "";
    $genero = "";
    $whatsapp = "";
    $cep = "";
    $endereco = "";
    $numero = "";
    $complemento = "";
    $bairro = "";
    $cidade = "";
    $estado = "";
    $ativo = "";
    $datacad = date("Y-m-d");
    $local = "Painel";
    $indicado = "";
} elseif ($_REQUEST['action'] == 'edit') {

    $action = "dbCadCliente.php?action=edit";

    $id = anti_injection($_REQUEST['id']);

    $sql = "select * from clientes where id = $id";
    $rs = $conn->query($sql);

    if ($rs->rowCount() > 0) {
        $dados = $rs->fetch(PDO::FETCH_ASSOC);

        $nome = $dados['nome'];
        $sobrenome = $dados['sobrenome'];
        $datanasc = $dados['datanasc'];
        $genero = $dados['genero'];
        $cpf = $dados['cpf'];
        $whatsapp = $dados['whatsapp'];
        $datacad = $dados['datacad'];
        $local = $dados['local'];
        $cep = $dados['cep'];
        $endereco = $dados['endereco'];
        $numero = $dados['numero'];
        $complemento = $dados['complemento'];
        $bairro = $dados['bairro'];
        $cidade = $dados['cidade'];
        $estado = $dados['estado'];
        $indicado = $dados['indicado'];
    } else {
        header("location: listaClientes.php");
    }
} else {
    header("location: listaClientes.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Sul Benefícios </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <link rel="icon" href="assets\images\favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bower_components\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets\icon\themify-icons\themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets\icon\icofont\css\icofont.css">
    <link rel="stylesheet" type="text/css" href="assets\icon\feather\css\feather.css">
    <link rel="stylesheet" type="text/css" href="assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="assets\css\jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets\icon\font-awesome\css\font-awesome.min.css">

    <style>
        .thumb-logo {
            cursor: pointer;
        }
    </style>

</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <?php require_once "top.php" ?>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <?php require_once "nav.php" ?>

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-header start -->
                                    <div class="page-header">
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="page-header-title">
                                                    <div class="d-inline">
                                                        <h4>Cliente</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                            <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#">Cliente</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="tab-header card">
                                                    <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" href="#pessoal" role="tab" aria-expanded="true">Dados Pessoais</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#assinaturas" role="tab" aria-expanded="false">Assinaturas</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#beneficios" role="tab" aria-expanded="false">Descontos</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#pontuacao" role="tab" aria-expanded="false">Pontuação</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" href="#indicacao" role="tab" aria-expanded="false">Indicações</a>
                                                            <div class="slide"></div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="pessoal" role="tabpanel" aria-expanded="true">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <h5 class="card-header-text">Código do assinante: #<?= $id ?></h5>
                                                                <br>
                                                                <br>
                                                                <form action="<?= $action ?>" method="POST" enctype="multipart/form-data">
                                                                    <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-3">
                                                                            <label for="nome">Nome:</label>
                                                                            <input type="text" class="form-control" name="nome" id="nome" value="<?= $nome ?>" required>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <label for="sobrenome">Sobrenome:</label>
                                                                            <input type="text" class="form-control" name="sobrenome" id="sobrenome" value="<?= $sobrenome ?>" require>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <label for="datanasc">Data Nasc:</label>
                                                                            <input type="date" class="form-control" name="datanasc" id="datanasc" value="<?= $datanasc ?>">
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <label for="cpf">CPF:</label>
                                                                            <input type="text" class="form-control" name="cpf" id="cpf" value="<?= $cpf ?>" require>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <label for="genero">Gênero:</label>
                                                                            <select name="genero" id="genero" class="form-control">
                                                                                <?php
                                                                                if ($genero == 'Masculino') {
                                                                                    echo "<option>Masculino</option>";
                                                                                    echo "<option>Feminino</option>";
                                                                                } else {
                                                                                    echo "<option>Feminino</option>";
                                                                                    echo "<option>Masculino</option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-2">
                                                                            <label for="whatsapp">WhatsApp:</label>
                                                                            <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="<?= $whatsapp ?>" require>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <label for="ativo">Ativo</label>
                                                                            <select name="ativo" id="ativo" class="form-control">
                                                                                <?php
                                                                                if ($ativo == 'N') {
                                                                                    echo "<option value='N'>Não</option>";
                                                                                    echo "<option value='S'>Sim</option>";
                                                                                } else {
                                                                                    echo "<option value='S'>Sim</option>";
                                                                                    echo "<option value='N'>Não</option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <label for="datacad">Data cadastro:</label>
                                                                            <input type="date" class="form-control" name="datacad" id="datacad" value="<?= $datacad ?>" readonly>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <label for="local">Local de cadastro:</label>
                                                                            <input type="text" class="form-control" name="local" id="local" value="<?= $local ?>" readonly>
                                                                        </div>
                                                                        <?php
                                                                        if ($_REQUEST['action'] == 'edit') {
                                                                        ?>
                                                                            <div class="col-sm-3">
                                                                                <label for="novasenha">Nova senha</label>
                                                                                <div class="input-group input-group-button">
                                                                                    <input type="password" class="form-control" name="password" id="password">
                                                                                    <span class="input-group-addon btn btn-primary btn-sm" id="verSenha">
                                                                                        <span>
                                                                                            <i class="fa fa-eye"></i>
                                                                                        </span>
                                                                                    </span>
                                                                                    <span class="input-group-addon btn btn-primary btn-sm" id="gerarSenha">
                                                                                        <span>
                                                                                            Gerar senha
                                                                                        </span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-2">
                                                                            <label for="cep">CEP:</label>
                                                                            <input type="text" class="form-control" name="cep" id="cep" value="<?= $cep ?>">
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <label for="endereco">Endereço:</label>
                                                                            <input type="text" class="form-control" name="endereco" id="endereco" value="<?= $endereco ?>">
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <label for="numero">Nº:</label>
                                                                            <input type="text" class="form-control" name="numero" id="numero" value="<?= $numero ?>">
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <label for="complemento">Complemento:</label>
                                                                            <input type="text" class="form-control" name="complemento" id="complemento" value="<?= $complemento ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-3">
                                                                            <label for="bairro">Bairro:</label>
                                                                            <input type="text" class="form-control" name="bairro" id="bairro" value="<?= $bairro ?>">
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <label for="cidade">Cidade:</label>
                                                                            <input type="text" class="form-control" name="cidade" id="cidade" value="<?= $cidade ?>" require>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <label for="estado">Estado:</label>
                                                                            <input type="text" class="form-control" name="estado" id="estado" value="<?= $estado ?>">
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <label for="indicado">Indicado por:</label>
                                                                            <input type="text" class="form-control" name="indicado" id="indicado" value="<?= $indicado ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-12">
                                                                            <input type="submit" class="btn btn-success btn-sm" value="Gravar">
                                                                            <a href="#" class="btn btn-danger btn-sm" onclick="window.location='listaClientes.php'">Cancelar</a>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="assinaturas" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="card">
                                                                            <div class="card-block contact-details">
                                                                                <?php
                                                                                if (!empty($id)) {
                                                                                ?>
                                                                                    <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#meuModal"><i class="fa fa-plus"></i> Adicionar</a>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                                <br><br>
                                                                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Data da assinatura</th>
                                                                                            <th>Início</th>
                                                                                            <th>Término</th>
                                                                                            <th>Status</th>
                                                                                            <th class="text-right">Valor</th>
                                                                                            <th>Ações</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php

                                                                                        if (!empty($id)) {
                                                                                            $sql = "select * from assinatura where cliente = $id and status = 'Pago'";
                                                                                            $rs = $conn->query($sql);

                                                                                            if ($rs->rowCount() > 0) {
                                                                                                $total = 0;

                                                                                                while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {

                                                                                                    switch ($ln['status']) {
                                                                                                        case 'Pago':
                                                                                                            $status = "<span class='label label-success'>Pago</span>";
                                                                                                            break;
                                                                                                        case 'Em Aberto':
                                                                                                            $status = "<span class='label label-danger'>Em Aberto</span>";
                                                                                                            break;
                                                                                                    }

                                                                                                    if (strtotime($ln['fim']) <= strtotime(date("Y-m-d"))) {
                                                                                                        $color = "style='color: red'";
                                                                                                    } else {
                                                                                                        $color = "";
                                                                                                    }

                                                                                                    $total += $ln['valor'];
                                                                                        ?>
                                                                                                    <tr>
                                                                                                        <td><?= normalizaData($ln['data']) ?></td>
                                                                                                        <td><?= normalizaData($ln['inicio']) ?></td>
                                                                                                        <td <?= $color ?>><?= normalizaData($ln['fim']) ?></td>
                                                                                                        <td><?= $status ?></td>
                                                                                                        <td class="text-right">R$ <?= moedaUsuario($ln['valor']) ?></td>
                                                                                                        <td>
                                                                                                            <a class="btn btn-danger btn-sm" action="#" onclick="excluirAssinatura(<?= $id ?>, <?= $ln['id'] ?>)"><i class="fa fa-trash"></i> Excluir</a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                <?php
                                                                                                }
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td colspan="4"><strong>Total</strong></td>
                                                                                                    <td class="text-right"><strong>R$ <?= moedaUsuario($total) ?></strong></td>
                                                                                                    <td></td>
                                                                                                </tr>
                                                                                        <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="beneficios" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="card">
                                                                            <div class="card-block contact-details">
                                                                                <br><br>
                                                                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Data</th>
                                                                                            <th>Comércio</th>
                                                                                            <th class="text-right">Valor</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php

                                                                                        if (!empty($id)) {
                                                                                            $sql = "select nome, valor, data from utilizacao, comercio where utilizacao.comercio = comercio.id and cliente = $id order by data desc";
                                                                                            $rs = $conn->query($sql);

                                                                                            if ($rs->rowCount() > 0) {

                                                                                                $total = 0;

                                                                                                while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {

                                                                                                    $total += $ln['valor'];

                                                                                        ?>
                                                                                                    <tr>

                                                                                                        <td><?= normalizaData($ln['data']) ?></td>
                                                                                                        <td><?= $ln['nome'] ?></td>
                                                                                                        <td class="text-right">R$ <?= moedaUsuario($ln['valor']) ?></td>
                                                                                                    </tr>
                                                                                                <?php
                                                                                                }
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td colspan="2"><strong>Total</strong></td>
                                                                                                    <td class="text-right"><strong>R$ <?= moedaUsuario($total) ?></strong></td>
                                                                                                </tr>
                                                                                        <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="pontuacao" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="card">
                                                                            <div class="card-block contact-details">
                                                                                <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#addpontos"><i class="fa fa-plus"></i> Adicionar</a>
                                                                                <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#removepontos"><i class="fa fa-remove"></i> Resgatar / Remover</a>
                                                                                <br><br>
                                                                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Data</th>
                                                                                            <th>Descrição</th>
                                                                                            <th class="text-center">Pontos</th>
                                                                                            <th>Ações</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php

                                                                                        if (!empty($id)) {
                                                                                            $sql = "select * from pontos where cliente = $id order by data desc";
                                                                                            $rs = $conn->query($sql);

                                                                                            if ($rs->rowCount() > 0) {

                                                                                                $total = 0;

                                                                                                while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {

                                                                                                    $total += $ln['pontos'];

                                                                                                    if ($ln['tipo'] == 'C') {
                                                                                                        $color = "#0ac282";
                                                                                                        $pontos = "+" . $ln['pontos'];
                                                                                                    } else {
                                                                                                        $color = "#eb3422";
                                                                                                        $pontos = $ln['pontos'];
                                                                                                    }

                                                                                        ?>
                                                                                                    <tr>

                                                                                                        <td><?= normalizaDataHora2($ln['data']) ?></td>
                                                                                                        <td><?= utf8_encode($ln['descricao']) ?></td>
                                                                                                        <td class="text-center" style="font-weight: bold; color: <?= $color ?>"><?= $pontos ?></td>
                                                                                                        <td>
                                                                                                            <a class="btn btn-danger btn-sm" action="#" onclick="excluirPontos(<?= $id ?>, <?= $ln['id'] ?>)"><i class="fa fa-trash"></i> Excluir</a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                <?php
                                                                                                }
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td colspan="2"><strong>Total</strong></td>
                                                                                                    <td class="text-center"><strong><?= $total ?></strong></td>
                                                                                                    <td></td>
                                                                                                </tr>
                                                                                        <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="indicacao" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="card">
                                                                            <div class="card-block contact-details">
                                                                                <br><br>
                                                                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Nome</th>
                                                                                            <th>Data Cadastro</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php

                                                                                        if (!empty($id)) {
                                                                                            $sql = "select * from clientes where indicado = $id order by datacad";
                                                                                            $rs = $conn->query($sql);

                                                                                            if ($rs->rowCount() > 0) {

                                                                                                $total = 0;

                                                                                                while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {

                                                                                                    $total++;

                                                                                        ?>
                                                                                                    <tr>

                                                                                                        <td><?= utf8_encode($ln['nome'] . " " . $ln['sobrenome']) ?></td>
                                                                                                        <td><?= normalizaData($ln['datacad']) ?></td>
                                                                                                    </tr>
                                                                                                <?php
                                                                                                }
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td colspan="1"><strong>Total</strong></td>
                                                                                                    <td class="text-left"><strong><?= $total ?></strong></td>
                                                                                                </tr>
                                                                                        <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD ASSINATURA -->
    <div class="modal fade" id="meuModal" tabindex="-1" role="dialog" aria-labelledby="meuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="meuModalLabel">Nova assinatura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="dbCadCliente.php?action=assinatura" method="POST" id="frmAssinatura">
                            <input type="hidden" name="cliente" id="cliente" value="<?= $id ?> ">
                            <div class="form-group row">
                                <label for="data">Data cadastro</label>
                                <input type="date" class="form-control" name="datacad" id="datacad" value="<?= date("Y-m-d") ?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="datainicio">Data início</label>
                                <input type="date" class="form-control" name="datainicio" id="datainicio" required>
                            </div>
                            <div class="form-group row">
                                <label for="datafim">Data término</label>
                                <input type="date" class="form-control" name="datafim" id="datafim" required>
                            </div>
                            <div class="form-group row">
                                <label for="valor">Valor</label>
                                <input type="text" class="form-control" name="valor" id="valor" value="0,00">
                            </div>
                            <div class="form-group row">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status" class="form-control">
                                    <option>Pago</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnAssinatura">Salvar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD PONTOS -->
    <div class="modal fade" id="addpontos" tabindex="-1" role="dialog" aria-labelledby="meuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="meuModalLabel">Adicionar pontos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="dbCadCliente.php?action=addpontos" method="POST" id="frmAddPontos">
                            <input type="hidden" name="cliente" id="cliente" value="<?= $id ?> ">
                            <input type="hidden" name="tipo" id="tipo" value="C">
                            <div class="form-group row">
                                <label for="data">Data cadastro</label>
                                <input type="datetime" class="form-control" name="datacad" id="datacad" value="<?= date("Y-m-d H:i:s") ?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="descricao">Descrição</label>
                                <input type="text" class="form-control" name="descricao" id="descricao" required>
                            </div>
                            <div class="form-group row">
                                <label for="pontos">Pontos para adicionar</label>
                                <input type="text" class="form-control" name="pontos" id="pontos" value="0">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnAddPontos">Salvar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- REMOVE PONTOS -->
    <div class="modal fade" id="removepontos" tabindex="-1" role="dialog" aria-labelledby="meuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="meuModalLabel">Adicionar pontos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="dbCadCliente.php?action=removepontos" method="POST" id="frmRemovePontos">
                            <input type="hidden" name="cliente" id="cliente" value="<?= $id ?> ">
                            <input type="hidden" name="tipo" id="tipo" value="D">
                            <div class="form-group row">
                                <label for="data">Data cadastro</label>
                                <input type="datetime" class="form-control" name="datacad" id="datacad" value="<?= date("Y-m-d H:i:s") ?>" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="descricao">Descrição</label>
                                <input type="text" class="form-control" name="descricao" id="descricao" required>
                            </div>
                            <div class="form-group row">
                                <label for="pontos">Pontos para remover</label>
                                <input type="text" class="form-control" name="pontos" id="pontos" value="0">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnRemovePontos">Salvar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="bower_components\bootstrap\js\bootstrap.min.js"></script>
    <script type="text/javascript" src="bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <script type="text/javascript" src="bower_components\modernizr\js\modernizr.js"></script>
    <script type="text/javascript" src="bower_components\modernizr\js\css-scrollbars.js"></script>

    <script type="text/javascript" src="bower_components\i18next\js\i18next.min.js"></script>
    <script type="text/javascript" src="bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>

    <script src="assets\js\pcoded.min.js"></script>
    <script src="assets\js\vartical-layout.min.js"></script>
    <script src="assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="assets\js\script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>
        $('#cep').inputmask('99999-999');
        $('#cpf').inputmask('999.999.999-99');
        $('#whatsapp').inputmask('(99)99999-9999');
    </script>

    <script>
        $("#cep").on("blur", function(e) {
            var cep = $(this).val();
            if (cep.trim() !== '') {
                $.getJSON('https://viacep.com.br/ws/' + cep + '/json/', function(data) {
                    if (!data.erro) {
                        $('#endereco').val(data.logradouro);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.localidade);
                        $('#estado').val(data.uf);
                    } else {
                        alert('CEP não encontrado.');
                    }
                });
            }
        })

        //Gravar Assinatura
        $("#btnAssinatura").on("click", function(e) {

            var form = $("#frmAssinatura");

            form.submit();

        })

        //Gravar Adição de pontos
        $("#btnAddPontos").on("click", function(e) {

            var form = $("#frmAddPontos");

            form.submit();

        })

        //Gravar Remoção de pontos
        $("#btnRemovePontos").on("click", function(e) {

            var form = $("#frmRemovePontos");

            form.submit();

        })

        $("#gerarSenha").on("click", function(e) {
            e.preventDefault();

            var senha = generatePassword(8);

            $("#password").val(senha);
        })

        $("#verSenha").on("click", function(e) {
            e.preventDefault();
            var status = $("#password").prop('type');
            if (status == 'text') {
                $("#password").prop('type', 'password');
            } else {
                $("#password").prop('type', 'text');
            }
        })

        function excluirAssinatura(cliente, id) {
            if (confirm('Tem certeza que deseja excluir essa assinatura?')) {
                window.location = "dbCadCliente.php?action=excluirassinatura&cliente=" + cliente + "&assinatura=" + id;
            }
        }

        function excluirPontos(cliente, id) {
            if (confirm('Tem certeza que deseja excluir os pontos desse cliente?')) {
                window.location = "dbCadCliente.php?action=excluirpontos&cliente=" + cliente + "&pontos=" + id;
            }
        }

        function generatePassword(length) {
            var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            var password = "";

            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * charset.length);
                password += charset.charAt(randomIndex);
            }

            return password;
        }
    </script>
</body>

</html>