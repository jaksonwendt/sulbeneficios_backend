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
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <h4 class="text-c-green f-w-600"><?= $conn->query("select distinct nome, cpf from clientes, assinatura where clientes.id = assinatura.cliente and fim >= now() and status = 'Pago'")->rowCount() ?></h4>
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
                                                                <h4 class="text-c-pink f-w-600"><?= $conn->query("select distinct nome, cpf as qtde from clientes, assinatura where clientes.id = assinatura.cliente and fim <= now() and status = 'Pago' and clientes.id not in (select distinct clientes.id from clientes, assinatura where clientes.id = assinatura.cliente and fim >= now() and status = 'Pago')")->rowCount() ?></h4>
                                                                <h6 class="text-muted m-b-0">Assinaturas inativas</h6>
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
                                                                <h4 class="text-c-blue f-w-600"><?= $conn->query("select distinct nome, cpf as qtde from clientes, assinatura where clientes.id = assinatura.cliente and clientes.id not in (select distinct clientes.id from clientes, assinatura where clientes.id = assinatura.cliente and status = 'Pago')")->rowCount() ?></h4>
                                                                <h6 class="text-muted m-b-0">Nunca pagaram</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <i class="feather icon-file-text f-28"></i>
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
                                            <div class="col-md-12 col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Faturamento</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <canvas id="faturamentolinha"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Faixa de idade</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <canvas id="faixadeidade"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Pessoas por cidade (Assinaturas ativas)</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <canvas id="graficocidade"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Uso por comércio</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <canvas id="graficocomercio"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Gênero (Assinaturas ativas)</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <canvas id="graficogeneros"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card">
                                                    <div class="card-block text-center">
                                                        <i class="feather icon-mail text-c-lite-green d-block f-40"></i>
                                                        <h4 class="m-t-15"><span class="text-c-lite-green"><?= $conn->query("select count(*) from perguntas, clientes where clientes.id = perguntas.cliente and status = 1")->fetchColumn() ?></span> Perguntas</h4>
                                                        <p class="m-b-10">Perguntas sem resposta</p>
                                                        <button class="btn btn-primary btn-sm btn-round" id="btnPergunta">Ver perguntas</button>
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
        /*  FATURAMENTO LINHA */
        <?php

        $sql = "SELECT MONTH(data) AS mes, YEAR(data) AS ano, SUM(valor) AS total FROM assinatura WHERE status = 'Pago' AND data >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) GROUP BY YEAR(data), MONTH(data) ORDER BY YEAR(data), MONTH(data)";
        $rs = $conn->query($sql);

        if ($rs->rowCount() > 0) {
            $dados = $rs->fetchAll(PDO::FETCH_ASSOC);

        ?>
            var data = {
                labels: [
                    <?php
                    foreach ($dados as $mes) {
                        echo "'" . obterMesAbreviado($mes['mes']) . "',";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'R$',
                    data: [
                        <?php
                        foreach ($dados as $mes) {
                            echo "'" . $mes['total'] . "',";
                        }
                        ?>
                    ],
                    backgroundColor: 'rgba(10, 194, 130, 0.2)',
                    borderColor: 'rgba(10, 194, 130, 1)',
                    borderWidth: 2
                }]
            };

            var options = {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                legend: {
                    display: false
                },
            };

            var ctx = document.getElementById('faturamentolinha').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: options
            });
        <?php
        }
        ?>

        /* FAIXA DE IDADE */

        <?php

        $sql = "SELECT
        CASE
          WHEN TIMESTAMPDIFF(YEAR, datanasc, CURDATE()) BETWEEN 16 AND 24 THEN '16-24'
          WHEN TIMESTAMPDIFF(YEAR, datanasc, CURDATE()) BETWEEN 25 AND 35 THEN '25-35'
          WHEN TIMESTAMPDIFF(YEAR, datanasc, CURDATE()) BETWEEN 36 AND 45 THEN '36-45'
          WHEN TIMESTAMPDIFF(YEAR, datanasc, CURDATE()) BETWEEN 46 AND 55 THEN '46-55'
          ELSE '56+'
        END AS faixa_etaria,
        COUNT(*) AS quantidade
      FROM
        clientes, assinatura
      WHERE
          clientes.id = assinatura.cliente and
          assinatura.fim >= now() and
          assinatura.status = 'Pago'
      GROUP BY
        faixa_etaria
      ORDER BY
        faixa_etaria;";
        $rs = $conn->query($sql);

        if ($rs->rowCount() > 0) {
            $dados = $rs->fetchAll(PDO::FETCH_ASSOC);

        ?>

            var ctx = document.getElementById('faixadeidade').getContext('2d');

            var data = {
                labels: [
                    <?php
                    foreach ($dados as $faixa) {
                        echo "'" . $faixa['faixa_etaria'] . "',";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Quantidade de Pessoas',
                    data: [
                        <?php
                        foreach ($dados as $faixa) {
                            echo "'" . $faixa['quantidade'] . "',";
                        }
                        ?>
                    ],
                    backgroundColor: 'rgba(10, 194, 130, 0.2)',
                    borderColor: 'rgba(10, 194, 130, 1)',
                    borderWidth: 1
                }]
            };

            var options = {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                },
                legend: {
                    display: false
                },
            };

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });

        <?php
        }
        ?>

        /* CIDADE*/

        <?php

        $sql = "SELECT
                cidade,
                COUNT(*) AS quantidade
                FROM
                clientes, assinatura
                WHERE
                clientes.id = assinatura.cliente and
                assinatura.fim >= now() and
                assinatura.status = 'Pago'
                GROUP BY
                cidade
                ORDER BY
                cidade;";
        $rs = $conn->query($sql);

        if ($rs->rowCount() > 0) {
            $dados = $rs->fetchAll(PDO::FETCH_ASSOC);

        ?>

            var ctx = document.getElementById('graficocidade').getContext('2d');

            var data = {
                labels: [
                    <?php
                    foreach ($dados as $cidade) {
                        echo "'" . $cidade['cidade'] . "',";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Quantidade de Pessoas',
                    data: [
                        <?php
                        foreach ($dados as $cidade) {
                            echo "'" . $cidade['quantidade'] . "',";
                        }
                        ?>
                    ],
                    backgroundColor: 'rgba(10, 194, 130, 0.2)',
                    borderColor: 'rgba(10, 194, 130, 1)',
                    borderWidth: 1
                }]
            };

            var options = {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                },
                legend: {
                    display: false
                },
            };

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });

        <?php
        }
        ?>

        /* GÊNERO */

        <?php

        $sql = "SELECT
                    genero,
                COUNT(*) AS quantidade
                FROM
                clientes, assinatura
                WHERE
                    clientes.id = assinatura.cliente and
                    assinatura.fim >= now() and
                    assinatura.status = 'Pago'
                GROUP BY
                genero
                ORDER BY
                genero desc";
        $rs = $conn->query($sql);

        if ($rs->rowCount() > 0) {
            $dados = $rs->fetchAll(PDO::FETCH_ASSOC);

        ?>

            var ctx = document.getElementById('graficogeneros').getContext('2d');

            // Dados do gráfico
            var data = {
                labels: [<?php
                            foreach ($dados as $faixa) {
                                echo "'" . $faixa['genero'] . "',";
                            }
                            ?>],
                datasets: [{
                    data: [<?php
                            foreach ($dados as $faixa) {
                                echo "'" . $faixa['quantidade'] . "',";
                            }
                            ?>],
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(192, 75, 75, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(192, 75, 75, 1)'],
                    borderWidth: 1
                }]
            };

            // Opções do gráfico
            var options = {
                responsive: true
            };

            // Criar o gráfico de pizza
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: data,
                options: options
            });
        <?php
        }
        ?>

        /* COMÉRCIO*/

        <?php

        $sql = "select comercio.nome, count(*) as qtde from utilizacao, comercio, clientes where utilizacao.cliente = clientes.id and utilizacao.comercio = comercio.id group by comercio.nome";
        $rs = $conn->query($sql);

        if ($rs->rowCount() > 0) {
            $dados = $rs->fetchAll(PDO::FETCH_ASSOC);
        ?>

            var ctx = document.getElementById('graficocomercio').getContext('2d');

            var data = {
                labels: [
                    <?php
                    foreach ($dados as $comercio) {
                        echo "'" . $comercio['nome'] . "',";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Quantidade de Pessoas',
                    data: [

                        <?php
                        foreach ($dados as $comercio) {
                            echo "'" . $comercio['qtde'] . "',";
                        }
                        ?>

                    ],
                    backgroundColor: 'rgba(10, 194, 130, 0.2)',
                    borderColor: 'rgba(10, 194, 130, 1)',
                    borderWidth: 1
                }]
            };

            var options = {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                legend: {
                    display: false
                },
            };

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });

        <?php
        }
        ?>

        $("#btnPergunta").on("click", function(e) {
            e.preventDefault();

            window.location = 'listaPerguntas.php';
        })
    </script>
</body>

</html>