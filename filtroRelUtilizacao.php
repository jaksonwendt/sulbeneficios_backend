<?php
session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";

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
    <link rel="stylesheet" type="text/css" href="assets\icon\font-awesome\css\font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="assets\css\jquery.mCustomScrollbar.css">

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
                                                        <h4>Uso do benefício</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                            <a href="dashboard.php"> <i class=" feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#">Uso do benefício</a>
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
                                                        <form action="relUtilizacao.php" method="GET" id="frmFiltro" target="_blank">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="fcliente">Cliente:</label>
                                                                    <input type="text" class="form-control" name="fcliente" id="fcliente">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label for="fcomercio">Comércio:</label>
                                                                    <select name="fcomercio" id="fcomercio" class="form-control">
                                                                        <option value="T">Todos</option>
                                                                        <?php
                                                                        $sql = "select * from comercio order by nome";
                                                                        $rs = $conn->query($sql);

                                                                        if ($rs->rowCount() > 0) {
                                                                            while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                                                                                echo "<option value='{$ln['id']}'>{$ln['nome']}</option>";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label for="fdatainicio">Data Início:</label>
                                                                    <input type="date" class="form-control" name="fdatainicio" id="fdatainicio">
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label for="fdatafinal">Data Final:</label>
                                                                    <input type="date" class="form-control" name="fdatafinal" id="fdatafinal">
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label for="fgerar">Gerar em:</label>
                                                                    <select name="fgerar" id="fgerar" class="form-control">
                                                                        <option value="T">Tela</option>
                                                                        <option value="E">Excel</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <a class="btn btn-primary btn-sm" href="#" id="btnFiltrar"><i class="fa fa-filter"></i> Gerar relatório</a>
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
    <script src="bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
    <script src="assets\pages\data-table\js\jszip.min.js"></script>
    <script src="assets\pages\data-table\js\pdfmake.min.js"></script>
    <script src="assets\pages\data-table\js\vfs_fonts.js"></script>
    <script src="bower_components\datatables.net-buttons\js\buttons.print.min.js"></script>
    <script src="bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>
    <script src="bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
    <script type="text/javascript" src="bower_components\i18next\js\i18next.min.js"></script>
    <script type="text/javascript" src="bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>
    <script src="assets\pages\data-table\js\data-table-custom.js"></script>

    <script src="assets\js\pcoded.min.js"></script>
    <script src="assets\js\vartical-layout.min.js"></script>
    <script src="assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="assets\js\script.js"></script>


    <script>
        function excluir(item) {
            if (confirm('Tem certeza que deseja excluir?')) {
                window.location = "dbCadCliente.php?action=delete&id=" + item;
            }
        }

        $("#btnFiltrar").on("click", function(e) {
            e.preventDefault();

            $("#frmFiltro").submit();
        })
    </script>
</body>

</html>