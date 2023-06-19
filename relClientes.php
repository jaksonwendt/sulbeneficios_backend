<?php
session_start();

require_once "session.php";
require_once "lib/conexao.php";
require_once "lib/functions.php";

$sql = "select *, concat(trim(clientes.nome), ' ', trim(clientes.sobrenome)) as nome from clientes where 1 = 1";

if (!empty($_REQUEST['fcliente'])) {
    $sql .= " and concat(trim(clientes.nome), ' ', trim(clientes.sobrenome)) like '%" . $_REQUEST['fcliente'] . "%'";
}

if (!empty($_REQUEST['fcidade'])) {
    $sql .= " and clientes.cidade like '%" . $_REQUEST['fcidade'] . "%'";
}

if (!empty($_REQUEST['fcpf'])) {
    $sql .= " and clientes.cpf = '" . $_REQUEST['fcpf'] . "'";
}


if (!empty($_REQUEST['flocal']) && $_REQUEST['flocal'] != 'T') {
    $sql .= " and clientes.local = '" . $_REQUEST['flocal'] . "'";
}

if (!empty($_REQUEST['fdatainicio']) && !empty($_REQUEST['fdatafinal'])) {
    $sql .= " and datacad between '" . $_REQUEST['fdatainicio'] . "' and '" . $_REQUEST['fdatafinal'] . "'";
}

$rs = $conn->query($sql);

if ($_REQUEST['fgerar'] == 'E') {

    require_once "bower_components/shuchkin/simplexlsxgen/src/SimpleXLSXGen.php";
    $filename = "clientes_" . date('Ymd') . ".xlsx";

    $array = [];
    array_push($array, ['Id', 'Nome', 'Data Nasc', 'Gênero', 'WhatsApp', 'CEP', 'Endereço', 'Número', 'Complemento', 'Bairro', 'Cidade', 'Estado', 'Ativo', 'Data Cadastro', 'Local']);

    $clientes = $rs->fetchAll(PDO::FETCH_ASSOC);
    foreach ($clientes as $cliente) {

        array_push($array, [$cliente['id'], $cliente['nome'], $cliente['datanasc'], $cliente['genero'], $cliente['whatsapp'], $cliente['cep'], $cliente['endereco'], $cliente['numero'], $cliente['complemento'], $cliente['bairro'], $cliente['cidade'], $cliente['estado'], $cliente['ativo'], $cliente['datacad'], $cliente['local']]);
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
        </style>
    </head>

    <body>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data Nasc.</th>
                    <th>CPF</th>
                    <th>Gênero</th>
                    <th>WhatsApp</th>
                    <th>CEP</th>
                    <th>Endereço</th>
                    <th>Número</th>
                    <th>Complemento</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Ativo</th>
                    <th>Data Cad.</th>
                    <th>Local</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($rs->rowCount() > 0) {
                    while ($ln = $rs->fetch(PDO::FETCH_ASSOC)) {

                        echo "<tr>";
                        echo "<td class='text-center'>" . $ln['id'] . "</td>";
                        echo "<td class='text-center'>" . $ln['nome'] . "</td>";
                        echo "<td class='text-center'>" . normalizaData($ln['datanasc']) . "</td>";
                        echo "<td class='text-center'>" . $ln['cpf'] . "</td>";
                        echo "<td class='text-center'>" . $ln['genero'] . "</td>";
                        echo "<td class='text-center'>" . $ln['whatsapp'] . "</td>";
                        echo "<td class='text-center'>" . $ln['cep'] . "</td>";
                        echo "<td class='text-center'>" . $ln['endereco'] . "</td>";
                        echo "<td class='text-center'>" . $ln['numero'] . "</td>";
                        echo "<td class='text-center'>" . $ln['complemento'] . "</td>";
                        echo "<td class='text-center'>" . $ln['bairro'] . "</td>";
                        echo "<td class='text-center'>" . $ln['cidade'] . "</td>";
                        echo "<td class='text-center'>" . $ln['estado'] . "</td>";
                        echo "<td class='text-center'>" . $ln['ativo'] . "</td>";
                        echo "<td class='text-center'>" . $ln['datacad'] . "</td>";
                        echo "<td class='text-center'>" . $ln['local'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="16">Total: <?= $rs->rowCount() ?></td>
                </tr>
            </tfoot>
        </table>

    </body>

    </html>
<?php
}
?>