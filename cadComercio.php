﻿<?php
session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";

if ($_REQUEST['action'] == 'insert') {

    $action = "dbCadComercio.php?action=insert";

    $id = "";
    $nome = "";
    $logo = "";
    $categoria = "";
    $cidade = "";
    $desconto = "";
    $ativo = "";
} elseif ($_REQUEST['action'] == 'edit') {

    $action = "dbCadComercio.php?action=edit";

    $id = anti_injection($_REQUEST['id']);

    $sql = "select * from comercio where id = $id";
    $rs = $conn->query($sql);

    if ($rs->rowCount() > 0) {
        $dados = $rs->fetch(PDO::FETCH_ASSOC);

        $nome = $dados['nome'];
        $logo = $dados['logo'];
        $categoria = $dados['categoria'];
        $cidade = $dados['cidade'];
        $desconto = $dados['desconto'];
        $ativo = $dados['ativo'];
    } else {
        header("location: listaComercios.php");
    }
} else {
    header("location: listaComercios.php");
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
                                                        <h4>Cadastro de Comércios</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                            <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#">Cadastro de comércios</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <form action="<?= $action ?>" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <label for="nome">Nome:</label>
                                                                    <input type="text" class="form-control" name="nome" id="nome" value="<?= $nome ?>" required>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="categoria">Categoria:</label>
                                                                    <select name="categoria" id="categoria" class="form-control">
                                                                        <?php
                                                                        if ($categoria == "") {
                                                                            $sql = "select * from categoriaben";
                                                                            $rs = $conn->query($sql);
                                                                            if ($rs->rowCount() > 0) {
                                                                                while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                                                                                    echo "<option value='{$ln['id']}'>{$ln['categoria']}</option>";
                                                                                }
                                                                            }
                                                                        } else {
                                                                            $sql = "select * from categoriaben where id = $categoria";
                                                                            $rs = $conn->query($sql);
                                                                            if ($rs->rowCount() > 0) {
                                                                                while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                                                                                    echo "<option value='{$ln['id']}'>{$ln['categoria']}</option>";
                                                                                }
                                                                            }

                                                                            $sql = "select * from categoriaben where id <> $categoria";
                                                                            $rs = $conn->query($sql);
                                                                            if ($rs->rowCount() > 0) {
                                                                                while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                                                                                    echo "<option value='{$ln['id']}'>{$ln['categoria']}</option>";
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label for="cidade">Cidade:</label>
                                                                    <select name="cidade" id="cidade" class="form-control">
                                                                        <?php
                                                                        if ($cidade == "") {
                                                                            $sql = "select * from cidades";
                                                                            $rs = $conn->query($sql);
                                                                            if ($rs->rowCount() > 0) {
                                                                                while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                                                                                    echo "<option value='{$ln['id']}'>{$ln['cidade']}</option>";
                                                                                }
                                                                            }
                                                                        } else {
                                                                            $sql = "select * from cidades where id = $cidade";
                                                                            $rs = $conn->query($sql);
                                                                            if ($rs->rowCount() > 0) {
                                                                                while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                                                                                    echo "<option value='{$ln['id']}'>{$ln['cidade']}</option>";
                                                                                }
                                                                            }

                                                                            $sql = "select * from cidades where id <> $cidade";
                                                                            $rs = $conn->query($sql);
                                                                            if ($rs->rowCount() > 0) {
                                                                                while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                                                                                    echo "<option value='{$ln['id']}'>{$ln['cidade']}</option>";
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-3">
                                                                    <label for="desconto">Desconto:</label>
                                                                    <input type="text" name="desconto" id="desconto" class="form-control autonumber" data-a-sep="." data-a-dec="," value="<?= $desconto ?>">
                                                                </div>
                                                                <div class="col-sm-3">
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
                                                                <div class="col-sm-3">
                                                                    <label for="logo">Logo: <sup>150px x 100px</sup></label>
                                                                    <input type="file" name="logo" id="logo" class="form-control">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <?php
                                                                    if ($_REQUEST['action'] == 'edit' && !empty($logo)) {
                                                                        echo "<label for='#'>Clique na logo para remover</label>";
                                                                        echo "<br>";
                                                                        echo "<img src='$logo' class='thumb-logo' onClick='deleteLogo($id)' />";
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" class="btn btn-success btn-sm" value="Gravar">
                                                                    <a href="#" class="btn btn-danger btn-sm" onclick="window.location='listaComercios.php'">Cancelar</a>
                                                                </div>
                                                            </div>
                                                        </form>
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
    <script type="text/javascript" src="bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="bower_components\bootstrap\js\bootstrap.min.js"></script>
    <script type="text/javascript" src="bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <script type="text/javascript" src="bower_components\modernizr\js\modernizr.js"></script>
    <script type="text/javascript" src="bower_components\modernizr\js\css-scrollbars.js"></script>

    <!-- Masking js -->
    <script src="assets\pages\form-masking\inputmask.js"></script>
    <script src="assets\pages\form-masking\jquery.inputmask.js"></script>
    <script src="assets\pages\form-masking\autoNumeric.js"></script>
    <script src="assets\pages\form-masking\form-mask.js"></script>

    <script type="text/javascript" src="bower_components\i18next\js\i18next.min.js"></script>
    <script type="text/javascript" src="bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>

    <script src="assets\js\pcoded.min.js"></script>
    <script src="assets\js\vartical-layout.min.js"></script>
    <script src="assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="assets\js\script.js"></script>

    <script>
        function deleteLogo(item) {
            if (confirm('Tem certeza que deseja remover a logo?')) {
                window.location = "dbCadComercio.php?action=deletelogo&id=" + item;
            }
        }
    </script>
</body>

</html>