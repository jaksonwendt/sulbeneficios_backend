
<?php
//PHP 7 : composer require "mercadopago/dx-php:2.5.3"
//PHP 5 : composer require "mercadopago/dx-php:1.12.5"

require_once '../vendor/autoload.php';
require_once '../lib/conexao.php';
require_once '../lib/functions.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header('Content-Type: application/json');

    //POST
    $nome = anti_injection($_POST['nome']);
    $sobrenome = anti_injection($_POST['sobrenome']);
    $datanasc = inverteData($_POST['datanasc']);
    $cpf = anti_injection($_POST['cpf']);
    $genero = anti_injection($_POST['genero']);
    $whatsapp = anti_injection($_POST['whatsapp']);
    $cep = anti_injection($_POST['cep']);
    $indicado = anti_injection($_POST['indicado']);

    //CAPTURA ENDEREÇO
    $url = "https://viacep.com.br/ws/{$cep}/json/";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $endereco = json_decode($response);
    if ($endereco) {
        $logradouro = $endereco->logradouro;
        $bairro = $endereco->bairro;
        $cidade = $endereco->localidade;
        $uf = $endereco->uf;
    }

	//GERA SENHA
	$pass = gerarSenha(6, false, false, true, false);
    $senha = md5($pass);
	
	//Consulta CPF
	$sql = "select * from clientes where cpf = '$cpf'";
	$rs = $conn->query($sql);
	
	if ($rs->rowCount() > 0){
		$retorno = array();
        $retorno['status'] = "existe";
        $retorno['id'] = "";
        $retorno['hash'] = "";
		
		echo json_encode($retorno, JSON_PRETTY_PRINT);
	}else{

		//INSERE CLIENTE
		$sql = "insert into clientes (nome, sobrenome, datanasc, cpf, genero, whatsapp, cep, endereco, numero, complemento, bairro, cidade, estado, ativo, datacad, local, password, indicado) values ('$nome', '$sobrenome', '$datanasc', '$cpf', '$genero', '$whatsapp', '$cep', '$logradouro', '0', '$bairro', '', '$cidade', '$uf', 'S', now(), 'APP', '$senha', '$indicado')";
		if ($conn->query($sql)){
			$texto = "Olá $nome, sua senha para acessar o aplicativo é $pass.";
			disparaWhatsApp($whatsapp, $texto);
			
			$id = $conn->lastInsertId();
			
			$retorno = array();
			$retorno['status'] = "continue";
			$retorno['id'] = md5($id);
			$retorno['hash'] = md5($cpf);
			
			echo json_encode($retorno, JSON_PRETTY_PRINT);
		}else{
			$retorno = array();
			$retorno['status'] = "error";
			$retorno['id'] = "";
			$retorno['hash'] = "";
			
			echo json_encode($retorno, JSON_PRETTY_PRINT);
		}
	
	}

