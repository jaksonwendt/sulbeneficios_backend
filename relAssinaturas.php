<?php
session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";

$sql = "select assinatura.id, assinatura.data, assinatura.inicio, assinatura.fim, assinatura.status, assinatura.valor, concat(trim(clientes.nome), ' ', trim(clientes.sobrenome)) as cliente from clientes, assinatura where assinatura.cliente = clientes.id";

if (!empty($_REQUEST['fcliente'])) {
    $sql .= " and concat(trim(clientes.nome), ' ', trim(clientes.sobrenome)) like '%" . $_REQUEST['fcliente'] . "%'";
}

if (!empty($_REQUEST['fdatainicio']) && !empty($_REQUEST['fdatafinal'])) {
    $sql .= " and data between '" . $_REQUEST['fdatainicio'] . "' and '" . $_REQUEST['fdatafinal'] . "'";
}

if (!empty($_REQUEST['fvigencia']) && $_REQUEST['fvigencia'] != 'T') {
    $sql .= " and fim >= now()";
}

$rs = $conn->query($sql);

if ($_REQUEST['fgerar'] == 'E') {

    require_once "bower_components/shuchkin/simplexlsxgen/src/SimpleXLSXGen.php";
    $filename = "assinaturas_" . date('Ymd') . ".xlsx";

    $array = [];
    array_push($array, ['Cliente', 'Contratação', 'Início', 'Término', 'Vigência', 'Status', 'Valor']);

    $clientes = $rs->fetchAll(PDO::FETCH_ASSOC);
    foreach ($clientes as $cliente) {


        if (strtotime($cliente['fim']) >= strtotime(date("Y-m-d"))) {
            $vigencia = "<span class='label label-success'>Vigente</span>";
        } else {
            $vigencia = "<span class='label label-danger'>Encerrada</span>";
        }


        array_push($array, [$cliente['cliente'], $cliente['data'], $cliente['inicio'], $cliente['fim'], $vigencia, $cliente['status'], $cliente['valor']]);
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
                    <th>Cliente</th>
                    <th>Contratação</th>
                    <th>Início</th>
                    <th>Término</th>
                    <th>Vigência</th>
                    <th>Status</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($rs->rowCount() > 0) {
                    $total = 0;
                    while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {

                        if (strtotime($ln['fim']) >= strtotime(date("Y-m-d"))) {
                            $vigencia = "<span class='label label-success'>Vigente</span>";
                        } else {
                            $vigencia = "<span class='label label-danger'>Encerrada</span>";
                        }

                        $total += $ln['valor'];

                        echo "<tr>";
                        echo "<td class='text-center'>" . $ln['cliente'] . "</td>";
                        echo "<td class='text-center'>" . normalizaData($ln['data']) . "</td>";
                        echo "<td class='text-center'>" . normalizaData($ln['inicio']) . "</td>";
                        echo "<td class='text-center'>" . normalizaData($ln['fim']) . "</td>";
                        echo "<td class='text-center'>" . $vigencia . "</td>";
                        echo "<td class='text-center'>" . $ln['status'] . "</td>";
                        echo "<td class='text-right'>R$ " . moedaUsuario($ln['valor']) . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">Total: <?= $rs->rowCount() ?></td>
                    <td class='text-right'>R$ <?= moedaUsuario($total) ?></td>
                </tr>
            </tfoot>
        </table>

    </body>

    </html>
<?php
}
?>