<?php
session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";
require_once "lib/phpqrcode/qrlib.php";


$id = anti_injection($_REQUEST['id']);

$sql = "SELECT clientes.nome, clientes.sobrenome, sorteio.premio, sorteio.id FROM sorteio, clientes where sorteio.cliente = clientes.id and sorteio.id = $id";
$rs = $conn->query($sql);

if ($rs->rowCount() > 0) {
    $return = $rs->fetch(PDO::FETCH_ASSOC);

    $dados = md5($return['id']);

    $arquivoQR = 'qrcode/' . $dados . '.png';

    $tamanho = 300;
    $corQR = array(0, 0, 0);
    $corFundo = array(255, 255, 255);
    QRcode::png($dados, $arquivoQR, QR_ECLEVEL_L, $tamanho, 2, false, $corQR, $corFundo);
?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sul Benefícios</title>

        <style>
            * {
                font-family: 'Trebuchet MS';
                text-align: center;
            }

            p {
                line-height: 2;
            }

            body {
                background: #EFEFEF;
                margin: 0;
                padding: 0;

                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 50px 50px;
                box-sizing: border-box;

            }

            .container {
                max-width: 980px;
                background: #FFF;
                border-radius: 20px;
                padding: 60px;
                box-sizing: border-box;

                display: flex;
                flex-direction: column;
                align-items: center;

            }

            #qrcode {
                max-width: 500px;
            }

            @media print {
                #imprimir {
                    display: none;
                }
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1><?= $return['nome'] ?> <?= $return['sobrenome'] ?></h1>
            <h1><?= $return['premio'] ?></h1>
            <p>Aponte a câmera do seu celular para o QR code e aguarde até que o código seja reconhecido. Em seguida, você Receberá seu prêmio.</p>
            <img id="qrcode" src="<?= $arquivoQR ?>" alt="QR Code">

            <a href="#" id="imprimir">imprimir</a>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $("#imprimir").on("click", function(e) {
            e.preventDefault();

            print();
        })
    </script>

    </html>


<?php
}
