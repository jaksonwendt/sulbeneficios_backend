<?php
function anti_injection($campo, $adicionaBarras = false)
{
	$campo = preg_replace("/(from|alter table|select|insert|delete|update|were|drop table|show tables|#|\*|--|\\\\)/i", "", $campo);
	$campo = trim($campo);
	$campo = strip_tags($campo);
	if ($adicionaBarras || !get_magic_quotes_gpc())
		$campo = addslashes($campo);
	return $campo;
}

function inverteData($data, $separador = "/")
{
	$nova_data = implode("" . $separador . "", array_reverse(explode("" . $separador . "", $data)));
	$nova_data = str_replace('/', '-', $nova_data);
	return $nova_data;
}

function normalizaData($data, $separador = "-")
{
	$nova_data = implode("" . $separador . "", array_reverse(explode("" . $separador . "", $data)));
	$nova_data = str_replace('-', '/', $nova_data);
	if ($nova_data == '01/01/1900') {
		return;
	} else {
		return $nova_data;
	}
}

function normalizaDataHora($data, $separador = "-")
{
	$data = substr($data, 0, 10);
	$nova_data = implode("" . $separador . "", array_reverse(explode("" . $separador . "", $data)));
	$nova_data = str_replace('-', '/', $nova_data);
	if ($nova_data == '01/01/1900') {
		return;
	} else {
		return $nova_data;
	}
}

function horaUsuario($hora)
{
	$partes = explode(":", $hora);
	$formatado = $partes[0] . ":" . $partes[1];

	return $formatado;
}

function locationTo($url)
{
	echo "<script>window.location='$url'</script>";
}

function moedaBanco($moeda)
{
	$valor = str_replace('.', '', $moeda);
	$valor = str_replace(',', '.', $valor);

	return $valor;
}

function moedaUsuario($moeda)
{
	return number_format($moeda, 2, ',', '');
}

function incDay($data, $dias)
{
	$ndata = strtotime("+$dias day", strtotime($data));
	return date("Y-m-d", $ndata);
}

function diferencaData($data1, $data2)
{
	$data_inicial = $data1;
	$data_final = $data2;

	if ($data_inicial == '0000-00-00' || $data_final == '0000-00-00') {
		return 0;
	} else {

		// Calcula a diferença em segundos entre as datas
		$diferenca = strtotime($data_final) - strtotime($data_inicial);

		//Calcula a diferença em dias
		$dias = floor($diferenca / (60 * 60 * 24));

		return $dias;
	}
}

function getDestino($str)
{
	return $str == '_self' ? 'Aba Atual' : 'Nova Aba';
}

function setDestino($str)
{
	return $str == 'Aba Atual' ? '_self' : '_blanck';
}

function tirarAcentos($string)
{
	return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
}

function trocaEspacos($string)
{
	return str_replace(' ', '_', $string);
}

function imagemBanco($file, $folder, $width, $height)
{
	$arquivo = $file;

	if ($arquivo['name'] == "") :
		return "";
	else :
		$permitidos = array('png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG');
		$posPonto = strrpos($arquivo['name'], '.');
		$tamanho = strlen($arquivo['name']);
		$ext = substr($arquivo['name'], $posPonto + 1, $tamanho);

		if (in_array($ext, $permitidos)) :
			$nome = md5(uniqid(time())) . "." . $ext;
			$caminho = $folder . "/" . $nome;

			copy($arquivo['tmp_name'], $caminho);

			$image = WideImage::load($caminho);
			$largura = $width;
			$altura = $height;
			$image = $image->resize($largura, $altura, 'fill');
			$image->saveToFile($caminho);

			return $caminho;
		else :
			return "";
		endif;
	endif;
}

function gerarSenha($tamanho, $usaLetras = true, $usaLetrasMaiusculas = true, $usaNumeros = true, $usaSimbolos = true)
{
	$letrasMinusculas = 'abcdefghijklmnopqrstuvwxyz';
	$letrasMaiusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$numeros = '0123456789';
	$simbolos = '!@#$%^&*()_-=+;:,.?';

	$caracteres = '';
	$senha = '';

	if ($usaLetras) {
		$caracteres .= $letrasMinusculas;
	}
	if ($usaLetrasMaiusculas) {
		$caracteres .= $letrasMaiusculas;
	}
	if ($usaNumeros) {
		$caracteres .= $numeros;
	}
	if ($usaSimbolos) {
		$caracteres .= $simbolos;
	}

	$tamanhoCaracteres = strlen($caracteres);

	for ($i = 0; $i < $tamanho; $i++) {
		$senha .= $caracteres[rand(0, $tamanhoCaracteres - 1)];
	}

	return $senha;
}


function disparaWhatsApp($numero, $texto)
{

	$numero = removerNaoNumericos($numero);

	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.z-api.io/instances/3BE5ED1D39B62070FC239633137BF331/token/15F6C2471F9E8ED80E2743BF/send-text",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "{\"phone\": \"55$numero\", \"message\": \"$texto\"}",
		CURLOPT_HTTPHEADER => array(
			"content-type: application/json"
		),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		return "cURL Error #:" . $err;
	} else {
		return "Tudo ok" . $response;
	}
}

function removerNaoNumericos($string)
{
	$apenasNumeros = preg_replace("/[^0-9]/", "", $string);
	return $apenasNumeros;
}

function obterMesAbreviado($numeroMes)
{
	$mesesAbreviados = array(
		'Jan',
		'Fev',
		'Mar',
		'Abr',
		'Mai',
		'Jun',
		'Jul',
		'Ago',
		'Set',
		'Out',
		'Nov',
		'Dez'
	);

	if ($numeroMes >= 1 && $numeroMes <= 12) {
		return $mesesAbreviados[$numeroMes - 1];
	} else {
		return 'Mês inválido';
	}
}
