<?php
require_once '../vendor/autoload.php';
require_once '../lib/conexao.php';
require_once '../lib/functions.php';

//MercadoPago\SDK::setAccessToken("APP_USR-6188932688013057-021412-6937ef9e8cc3daceb3499806642c7c79-1015014769");
MercadoPago\SDK::setAccessToken("APP_USR-6506092667463422-060807-77e18ed3d04e9c5d77ca704633fa3284-1383492123"); //Winderson

$merchant_order = null;

switch ($_GET["topic"]) {
	case "payment":
		$payment = MercadoPago\Payment::find_by_id($_GET["id"]);
		$merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);
		break;
}

if ($payment->status == 'approved') {
	$id = $_GET["id"];
	if (!empty($id)) {
		$conn->query("update assinatura set status = 'Pago' where mercadopago = '$id'");

		$sql = "select cliente from assinatura where mercadopago = '$id'";
		$rs = $conn->query($sql);
		if ($rs->rowCount() > 0) {
			$cliente = $rs->fetchColumn();

			$sql = "select nome, whatsapp from clientes where id = $cliente";
			$rs = $conn->query($sql);

			if ($rs->rowCount() > 0) {
				$dados = $rs->fetch(PDO::FETCH_ASSOC);

				//Verificar se é cadastro novo ou renovação
				$sql = "select * from assinatura where cliente = $cliente and status = 'Pago'";
				$rs = $conn->query($sql);

				if ($rs->rowCount() == 1) {
					$texto = "Olá " . $dados['nome'] . ", seu pagamento foi confirmado. Faça login e aproveite todos os benefícios do aplicativo.";
					disparaWhatsApp($dados['whatsapp'], $texto);

					//Credita pontos no primeiro cadastro
					$sqlPontos = "select * from pontos where cliente = $cliente and descricao = 'Cadastro completo com sucesso'";
					$rsPontos = $conn->query($sqlPontos);

					if ($rsPontos->rowCount() == 0) {
						$texto = utf8_decode("Cadastro completo com sucesso");
						$sql = "insert into pontos (cliente, descricao, data, pontos, tipo) values ($cliente, '$texto', now(), '10', 'C')";
						$conn->query($sql);
					}

					//Verificar se foi indicado por alguém e creditar os pontos - 2 pontos para indicante
					$sqlIndicado = "select indicado from clientes where id = $cliente";
					$rsIndicado = $conn->query($sqlIndicado);

					if ($rsIndicado->rowCount() > 0) {
						$indicado = $rsIndicado->fetchColumn();

						if (!empty($indicado)) {
							$sqlValida = "select * from pontos where descricao like '%#$cliente#%'";
							$rsValida = $conn->query($sqlValida);

							if ($rsValida->rowCount() == 0) {
								$textoIndicado = utf8_decode("Indicação #" . $cliente . "# " . $dados['nome']);
								$sqlPontuar = "insert into pontos (cliente, descricao, data, pontos, tipo) values ($indicado, '$textoIndicado', now(), '2', 'C')";
								$conn->query($sqlPontuar);
							}
						}
					}
				} else {
					$texto = "Olá " . $dados['nome'] . ", seu pagamento foi confirmado.";
					disparaWhatsApp($dados['whatsapp'], $texto);

					//Verifica renovação antes do vencimento - 2 pontos
					$sqlRenovacao = "select * from assinatura where cliente = $cliente and status = 'Pago' and mercadopago <> '$id' order by data desc limit 0, 1";
					$rsRenovacao = $conn->query($sqlRenovacao);

					if ($rsRenovacao->rowCount() > 0) {
						$dadosRenovacao = $rsRenovacao->fetchAll(PDO::FETCH_ASSOC);

						$ultimoVencimento = $dadosRenovacao[0]['fim'];

						if (date("Y-m-d") < $ultimoVencimento) {
							//Pontua
							$texto = utf8_decode("Pagamento antes do vencimento");
							$sql = "insert into pontos (cliente, descricao, data, pontos, tipo) values ($cliente, '$texto', now(), '2', 'C')";
							$conn->query($sql);

							//Ajusta data vencimento
							$novoVencimento = incDay($ultimoVencimento, 30);
							$conn->query("update assinatura set fim = '$novoVencimento' where mercadopago = '$id'");
						}
					}

					//Verifica pagamento de 6 meses sem atrasos - 10 pontos
				}
			}
		}
	}
}
