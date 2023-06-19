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
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <link rel="icon" href="assets\images\favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bower_components\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets\icon\feather\css\feather.css">
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
                    <?php
                    require_once "nav.php"
                    ?>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <div class="row">
                                            <!-- task, page, download counter  start -->
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-green f-w-600"><?= $conn->query("select count(*) from assinatura where fim >= now()")->fetchColumn() ?></h4>
                                                                <h6 class="text-muted m-b-0">Assinaturas ativas</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="feather icon-file-text f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-green">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">100% (30 dias)</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                                <i class="feather icon-trending-up text-white f-16"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-pink f-w-600"><?= $conn->query("select count(*) from assinatura where fim <= now()")->fetchColumn() ?></h4>
                                                                <h6 class="text-muted m-b-0">Assinaturas invativas</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="feather icon-file-text f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-pink">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">100% (30 dias)</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                                <i class="feather icon-trending-up text-white f-16"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-blue f-w-600">R$ <?= moedaUsuario($conn->query("select sum(valor) from sorteio")->fetchColumn()) ?></h4>
                                                                <h6 class="text-muted m-b-0">Em sorteios</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="feather icon-calendar f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-blue">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">100% (30 dias)</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                                <i class="feather icon-trending-up text-white f-16"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-yellow f-w-600">R$ <?= moedaUsuario($conn->query("select sum(valor) from utilizacao")->fetchColumn()) ?></h4>
                                                                <h6 class="text-muted m-b-0">Economia total</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="feather icon-bar-chart f-28"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-c-yellow">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <p class="text-white m-b-0">100% (30 dias)</p>
                                                            </div>
                                                            <div class="col-3 text-right">
                                                                <i class="feather icon-trending-up text-white f-16"></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- task, page, download counter  end -->

                                            <!-- visitor start -->
                                            <div class="col-xl-7 col-md-12">
                                                <div class="card">
                                                    <div class="card-block bg-c-green">
                                                        <span style="color: #FFF">Vencimento das próximas assinaturas</span>
                                                        <div id="grafico-mensal" style="height: 360px"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- visitor end -->
                                            <div class="col-xl-5 col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Assinaturas por Status</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <canvas id="grafico-status" height="250"></canvas>
                                                    </div>
                                                    <div class="card-footer ">
                                                        <div class="row text-center b-t-default">
                                                            <?php
                                                            $total = $conn->query("select count(*) from assinatura")->fetchColumn();

                                                            if ($total > 0) {
                                                                $ativas = $conn->query("select count(*) from assinatura where fim >= now()")->fetchColumn() / $total;
                                                                $inativas = $conn->query("select count(*) from assinatura where fim <= now()")->fetchColumn() / $total;
                                                            } else {
                                                                $ativas = 0;
                                                                $inativas = 0;
                                                            }
                                                            ?>
                                                            <div class="col-6 b-r-default m-t-15">
                                                                <h5><?= round($ativas * 100) ?>%</h5>
                                                                <p class="text-muted m-b-0">Ativas</p>
                                                            </div>
                                                            <div class="col-6 b-r-default m-t-15">
                                                                <h5><?= round($inativas * 100) ?>%</h5>
                                                                <p class="text-muted m-b-0">Inativas</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-7 col-md-12">
                                                <div class="card">
                                                    <div class="card-block bg-c-yellow">
                                                        <span style="color: #FFF">Faturamento</span>
                                                        <div id="grafico-faturamento" style="height: 360px"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- sale start -->
                                            <div class="col-xl-5 col-md-12">
                                                <div class="card table-card">
                                                    <div class="card-header">
                                                        <h5>Top 5 cidades (assinaturas)</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Cidade</th>
                                                                        <th class="text-center">Assinaturas</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $sql = "select cidade, count(*) as qtde from assinatura, clientes where clientes.id = assinatura.cliente group by cidade";
                                                                    $rs = $conn->query($sql);

                                                                    if ($rs->rowCount() > 0) {
                                                                        while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                                                                    ?>
                                                                            <tr>
                                                                                <td><?= $ln['cidade'] ?></td>
                                                                                <td class="text-center"><?= $ln['qtde'] ?></td>
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

                                            <div class="col-xl-4 col-md-12">
                                                <div class="card table-card">
                                                    <div class="card-header">
                                                        <h5>Top 5 cidades (Utilização)</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Cidade</th>
                                                                        <th class="text-center">Assinaturas</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $sql = "select cidades.cidade, count(*) as qtde from utilizacao, comercio, cidades where utilizacao.comercio = comercio.id and comercio.cidade = cidades.id";
                                                                    $rs = $conn->query($sql);

                                                                    if ($rs->rowCount() > 0) {
                                                                        while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                                                                    ?>
                                                                            <tr>
                                                                                <td><?= $ln['cidade'] ?></td>
                                                                                <td class="text-center"><?= $ln['qtde'] ?></td>
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

                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block text-center">
                                                        <i class="feather icon-mail text-c-lite-green d-block f-40"></i>
                                                        <h4 class="m-t-15"><span class="text-c-lite-green"><?= $conn->query("select count(*) from perguntas where status = 2")->fetchColumn() ?></span> Perguntas</h4>
                                                        <p class="m-b-10">Perguntas sem resposta</p>
                                                        <button class="btn btn-primary btn-sm btn-round" id="btnPergunta">Ver perguntas</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block text-center">
                                                        <i class="feather icon-mail text-c-green d-block f-40"></i>
                                                        <h4 class="m-t-15"><span class="text-c-blgreenue"><?= $conn->query("select count(*) from perguntas where status = 2")->fetchColumn() ?></span> Perguntas</h4>
                                                        <p class="m-b-10">Perguntas com respostas enviadas</p>
                                                        <button class="btn btn-success btn-sm btn-round" id="btnPergunta">Ver perguntas</button>
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

    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="../files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="../files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="../files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="bower_components\modernizr\js\modernizr.js"></script>
    <script type="text/javascript" src="bower_components\modernizr\js\css-scrollbars.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="bower_components\chart.js\js\Chart.js"></script>
    <!-- amchart js -->
    <script src="assets\pages\widget\amchart\amcharts.js"></script>
    <script src="assets\pages\widget\amchart\serial.js"></script>
    <script src="assets\pages\widget\amchart\light.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="assets\js\SmoothScroll.js"></script>
    <script src="assets\js\pcoded.min.js"></script>
    <script src="assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets\js\vartical-layout.min.js"></script>
    <script type="text/javascript" src="assets\pages\dashboard\analytic-dashboard.min.js"></script>
    <script type="text/javascript" src="assets\js\script.js"></script>

    <script>
        var chart = AmCharts.makeChart("grafico-mensal", {
            "type": "serial",
            "hideCredits": true,
            "theme": "light",
            "dataProvider": [
                <?php
                $sql = "select fim, count(*) as qtde from assinatura where fim >= now() group by fim";
                $rs = $conn->query($sql);

                if ($rs->rowCount() > 0) {
                    while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                ?> {
                            "type": "<?= normalizaData($ln['fim']) ?>",
                            "visits": <?= $ln['qtde'] ?>
                        },
                <?php
                    }
                }
                ?>
            ],
            "valueAxes": [{
                "gridAlpha": 0.3,
                "gridColor": "#fff",
                "axisColor": "transparent",
                "color": '#fff',
                "dashLength": 0
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "balloonText": "Assinaturas: <b>[[value]]</b>",
                "fillAlphas": 1,
                "lineAlpha": 1,
                "lineColor": "#fff",
                "type": "column",
                "valueField": "visits",
                "columnWidth": 0.5
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "type",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "axesAlpha": 0,
                "lineAlpha": 0,
                "fontSize": 12,
                "color": '#fff',
                "tickLength": 0
            },
            "export": {
                "enabled": false
            }

        });

        var chart = AmCharts.makeChart("grafico-faturamento", {
            "type": "serial",
            "hideCredits": true,
            "theme": "light",
            "dataProvider": [
                <?php
                $sql = "SELECT DATE_FORMAT(data, '%Y-%m') AS mes, SUM(valor) AS soma FROM assinatura GROUP BY mes";
                $rs = $conn->query($sql);

                if ($rs->rowCount() > 0) {
                    while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                ?> {
                            "type": "<?= normalizaData($ln['mes']) ?>",
                            "visits": <?= $ln['soma'] ?>
                        },
                <?php
                    }
                }
                ?>
            ],
            "valueAxes": [{
                "gridAlpha": 0.3,
                "gridColor": "#fff",
                "axisColor": "transparent",
                "color": '#fff',
                "dashLength": 0
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "balloonText": "Valor em R$: <b>[[value]]</b>",
                "fillAlphas": 1,
                "lineAlpha": 1,
                "lineColor": "#fff",
                "type": "column",
                "valueField": "visits",
                "columnWidth": 0.5
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "type",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "axesAlpha": 0,
                "lineAlpha": 0,
                "fontSize": 12,
                "color": '#fff',
                "tickLength": 0
            },
            "export": {
                "enabled": false
            }

        });




        var ctx = document.getElementById("grafico-status").getContext("2d");
        window.myDoughnut = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        <?=
                        $conn->query("select count(*) from assinatura where fim >= now()")->fetchColumn()
                        ?>,
                        <?=
                        $conn->query("select count(*) from assinatura where fim <= now()")->fetchColumn()
                        ?>
                    ],
                    backgroundColor: ["#fe9365", "#01a9ac", "#fe5d70"],
                    label: 'Dataset 1'
                }],
                labels: ["Ativas", "Vencidas"]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: "",
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });

        $("#btnPergunta").on("click", function(e) {
            e.preventDefault();

            window.location = 'listaPerguntas.php';
        })
    </script>
</body>

</html>