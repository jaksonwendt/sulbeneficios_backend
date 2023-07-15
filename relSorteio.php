<?php
session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";

$sql = "select clientes.id, concat(trim(clientes.nome), ' ', trim(clientes.sobrenome)) as cliente, clientes.datacad, assinatura.status from clientes, assinatura where clientes.id = assinatura.cliente";


if (!empty($_REQUEST['fdatainicio']) && !empty($_REQUEST['fdatafinal'])) {
    $sql .= " and datacad between '" . $_REQUEST['fdatainicio'] . "' and '" . $_REQUEST['fdatafinal'] . "'";
}

if (!empty($_REQUEST['fvigencia']) && $_REQUEST['fvigencia'] != 'T') {
    $sql .= " and fim >= now()";
}

if (!empty($_REQUEST['fstatus']) && $_REQUEST['fstatus'] != 'T') {
    $sql .= " and status = '" . $_REQUEST['fstatus'] . "'";
}

$rs = $conn->query($sql);

if ($_REQUEST['fgerar'] == 'E') {

    require_once "bower_components/shuchkin/simplexlsxgen/src/SimpleXLSXGen.php";
    $filename = "sorteio_" . date('Ymd') . ".xlsx";

    $array = [];
    array_push($array, ['Cód. Cliente', 'Cliente', 'Data Cadastro', 'Status', 'Assinaturas Pagas', 'Valor Pago', 'Uso de Benefício', 'Perguntas', 'Prêmios']);

    $clientes = $rs->fetchAll(PDO::FETCH_ASSOC);
    foreach ($clientes as $cliente) {


        $id = $cliente['id'];

        $qtdeass = $conn->query("select * from assinatura where status = 'Pago' and cliente = $id")->rowCount();
        $valor = $conn->query("select sum(valor) as total from assinatura where status = 'Pago' and cliente = $id")->fetchColumn();
        $uso = $conn->query("select * from utilizacao where cliente = $id")->rowCount();
        $perguntas = $conn->query("select * from perguntas where cliente = $id")->rowCount();
        $sorteado = $conn->query("select * from sorteio where cliente = $id")->rowCount();


        array_push($array, [$id, $cliente['cliente'], $cliente['datacad'], $cliente['status'], $qtdeass, $valor, $uso, $perguntas, $sorteado]);
    }

    $xlsx = Shuchkin\SimpleXLSXGen::fromArray($array);
    $xlsx->downloadAs($filename);
} elseif ($_REQUEST['fgerar'] == 'T') {

?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Relatório</title>
        <style>
            body {
                font-family: "Lucida Console", Monaco, monospace;
            }

            table {
                border-collapse: collapse;
                width: 100%;
                font-size: 80%;
            }

            table th {
                background-color: #43AA5B;
                color: white;
                text-align: center;
                padding: 3px;
            }

            th,
            td {
                border: 1px solid #ddd;
                text-align: left;
                padding: 3px;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2
            }

            .text-center {
                text-align: center;
            }

            .text-right {
                text-align: right;
            }
        </style>
    </head>

    <body>

        <table>
            <thead>
                <tr>
                    <th>Cód. Cliente</th>
                    <th>Cliente</th>
                    <th>Data Cadastro</th>
                    <th>Status</th>
                    <th>Assinaturas Pagas</th>
                    <th>Valor Pago</th>
                    <th>Uso de benefício</th>
                    <th>Perguntas</th>
                    <th>Prêmios</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($rs->rowCount() > 0) {
                    $total = 0;
                    while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {
                        $id = $ln['id'];

                        $qtdeass = $conn->query("select * from assinatura where status = 'Pago' and cliente = $id")->rowCount();
                        $valor = $conn->query("select sum(valor) as total from assinatura where status = 'Pago' and cliente = $id")->fetchColumn();
                        $uso = $conn->query("select * from utilizacao where cliente = $id")->rowCount();
                        $perguntas = $conn->query("select * from perguntas where cliente = $id")->rowCount();
                        $sorteado = $conn->query("select * from sorteio where cliente = $id")->rowCount();

                        echo "<tr>";
                        echo "<td class='text-center'>" . $id . "</td>";
                        echo "<td class='text-center'>" . $ln['cliente'] . "</td>";
                        echo "<td class='text-center'>" . normalizaData($ln['datacad']) . "</td>";
                        echo "<td class='text-center'>" . $ln['status'] . "</td>";
                        echo "<td class='text-center'>" . $qtdeass . "</td>";
                        echo "<td class='text-right'>R$ " . moedaUsuario($valor) . "</td>";
                        echo "<td class='text-center'>" . $uso . "</td>";
                        echo "<td class='text-center'>" . $perguntas . "</td>";
                        echo "<td class='text-center'>" . $sorteado . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">Total: <?= $rs->rowCount() ?></td>
                </tr>
            </tfoot>
        </table>

    </body>

    </html>
<?php
}
?>