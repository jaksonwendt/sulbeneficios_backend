<?php
session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";

if ($_REQUEST['action'] == 'insert') {

    $action = "dbCadSorteio.php?action=insert";

    $id = "";
    $cliente = "";
    $nomeCliente = "";
    $premio = "";
    $valor = "";
    $data = "";
    $recebido = "N";
    $datarecebido = null;
} elseif ($_REQUEST['action'] == 'edit') {

    $action = "dbCadSorteio.php?action=edit";

    $id = anti_injection($_REQUEST['id']);

    $sql = "select * from sorteio where id = $id";
    $rs = $conn->query($sql);

    if ($rs->rowCount() > 0) {
        $dados = $rs->fetch(PDO::FETCH_ASSOC);

        $cliente = $dados['cliente'];
        $premio = $dados['premio'];
        $valor = moedaUsuario($dados['valor']);
        $data = $dados['data'];
        $recebido = $dados['recebido'];
        $datarecebido = invertedata(normalizaDataHora($dados['datarecebido']));

        $nomeCliente = $conn->query("select concat(trim(clientes.nome), ' ', trim(clientes.sobrenome)) from clientes where id = $cliente")->fetchColumn();
    } else {
        header("location: listaSorteios.php");
    }
} else {
    header("location: listaSorteios.php");
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

    <link rel="stylesheet" href="bower_components\select2\css\select2.min.css">

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
                                                        <h4>Sorteio</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                            <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#">Sorteio</a>
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
                                                        <form action="<?= $action ?>" method="POST">
                                                            <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                                            <div class="form-group row">
                                                                <div class="col-sm-2">
                                                                    <label for="cliente">Cód. Cliente:</label>
                                                                    <div class="input-group input-group-button">
                                                                        <input type="text" class="form-control" name="cliente" id="cliente" value="<?= $cliente ?>">
                                                                        <span class="input-group-addon btn btn-primary btn-sm" id="buscar">
                                                                            <span>
                                                                                Buscar
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <label for="nomeCliente">Nome do cliente</label>
                                                                    <input type="text" class='form-control' name="nomeCliente" id="nomeCliente" value="<?= $nomeCliente ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="premio">Prêmio</label>
                                                                    <input type="text" class="form-control" name="premio" id="premio" value="<?= $premio ?>">
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label for="valor">Valor</label>
                                                                    <input type="text" class="form-control" name="valor" id="valor" value="<?= $valor ?>">
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label for="data">Data do Sorteio</label>
                                                                    <input type="date" class="form-control" name="data" id="data" value="<?= $data ?>">
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label for="recebido">Recebido</label>
                                                                    <select name="recebido" id="recebido" class="form-control">
                                                                        <?php
                                                                        if ($recebido == 'S') {
                                                                            echo "<option value='S'>Sim</option>";
                                                                            echo "<option value='N'>Não</option>";
                                                                        } else {
                                                                            echo "<option value='N'>Não</option>";
                                                                            echo "<option value='S'>Sim</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label for="datarecebido">Data recebimento</label>
                                                                    <input type="date" class="form-control" name="datarecebido" id="datarecebido" value="<?= $datarecebido ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" class="btn btn-success btn-sm" value="Gravar">
                                                                    <a href="#" class="btn btn-danger btn-sm" onclick="window.location='listaSorteios.php'">Cancelar</a>
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

    <script type="text/javascript" src="bower_components\i18next\js\i18next.min.js"></script>
    <script type="text/javascript" src="bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>

    <script src="assets\js\pcoded.min.js"></script>
    <script src="assets\js\vartical-layout.min.js"></script>
    <script src="assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="assets\js\script.js"></script>

    <script type="text/javascript" src="bower_components\select2\js\select2.full.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#buscar").on("click", function(e) {
                e.preventDefault();

                var codigo = $("#cliente").val();

                if (codigo == "") {
                    $("#cliente").focus();
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: 'ajax/apiClientesSemAuth.php',
                    data: {
                        codigo: codigo
                    },
                    success: function(data) {
                        $("#nomeCliente").val(data[0].nome);
                    }

                })
            })
        });
    </script>
</body>

</html>