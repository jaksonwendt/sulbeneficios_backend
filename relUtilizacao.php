<?php
session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";

$sql = "select utilizacao.id, utilizacao.data, utilizacao.tipo, utilizacao.valor, concat(trim(clientes.nome), ' ', trim(clientes.sobrenome)) as cliente, comercio.nome as comercio from utilizacao, clientes, comercio where utilizacao.cliente = clientes.id and utilizacao.comercio = comercio.id";

if (!empty($_REQUEST['fcliente'])) {
    $sql .= " and concat(trim(clientes.nome), ' ', trim(clientes.sobrenome)) like '%" . $_REQUEST['fcliente'] . "%'";
}

if (!empty($_REQUEST['fcomercio']) && $_REQUEST['fcomercio'] != 'T') {
    $sql .= " and comercio.id = " . $_REQUEST['fcomercio'];
}

if (!empty($_REQUEST['fdatainicio']) && !empty($_REQUEST['fdatafinal'])) {
    $sql .= " and data between '" . $_REQUEST['fdatainicio'] . "' and '" . $_REQUEST['fdatafinal'] . "'";
}

$rs = $conn->query($sql);

if ($_REQUEST['fgerar'] == 'E') {

    require_once "bower_components/shuchkin/simplexlsxgen/src/SimpleXLSXGen.php";
    $filename = "beneficios_" . date('Ymd') . ".xlsx";

    $array = [];
    array_push($array, ['Comércio', 'Cliente', 'Data', 'Valor', 'Tipo']);

    $clientes = $rs->fetchAll(PDO::FETCH_ASSOC);
    foreach ($clientes as $cliente) {


        switch ($cliente['tipo']) {
            case 'D':
                $tipo = "<span class='label label-primary'>Desconto</span>";
                break;
            case 'P':
                $tipo = "<span class='label label-success'>Prêmio</span>";
                break;
        }


        array_push($array, [$cliente['comercio'], $cliente['cliente'], $cliente['data'], $cliente['valor'], $tipo]);
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
                    <th>Comércio</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($rs->rowCount() > 0) {
                    $total = 0;
                    while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {

                        switch ($ln['tipo']) {
                            case 'D':
                                $tipo = "<span class='label label-primary'>Desconto</span>";
                                break;
                            case 'P':
                                $tipo = "<span class='label label-success'>Prêmio</span>";
                                break;
                        }

                        $total += $ln['valor'];

                        echo "<tr>";
                        echo "<td class='text-center'>" . $ln['comercio'] . "</td>";
                        echo "<td class='text-center'>" . $ln['cliente'] . "</td>";
                        echo "<td class='text-center'>" . normalizaData($ln['data']) . "</td>";
                        echo "<td class='text-center'>" . $tipo . "</td>";
                        echo "<td class='text-right'>R$ " . moedaUsuario($ln['valor']) . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Total: <?= $rs->rowCount() ?></td>
                    <td class='text-right'>R$ <?= moedaUsuario($total) ?></td>
                </tr>
            </tfoot>
        </table>

    </body>

    </html>
<?php
}
?>