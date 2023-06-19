<?php

    require_once "conexao.php";
    require_once "functions.php";

    $sql = "select * from empresa where idempresa = 1";
    $rs = $conn->query($sql);

    if ($rs->rowCount()>0){
        $dados = $rs->fetch(PDO::FETCH_ASSOC);
        
        DEFINE('CONST_EMPRESA', $dados['nome']);
        DEFINE('CONST_RAZAOSOCIAL', $dados['razaosocial']);
        DEFINE('CONST_CNPJ', $dados['cnpj']);
        DEFINE('CONST_IM', $dados['im']);
        DEFINE('CONST_IE', $dados['ie']);
        DEFINE('CONST_ENDERECO', $dados['endereco']);
        DEFINE('CONST_BAIRRO', $dados['bairro']);
        DEFINE('CONST_CIDADE', $dados['cidade']);
        DEFINE('CONST_ESTADO', $dados['estado']);
        DEFINE('CONST_CEP', $dados['cep']);
        DEFINE('CONST_TELEFONE1', $dados['telefone1']);
        DEFINE('CONST_TELEFONE2', $dados['telefone2']);
        DEFINE('CONST_EMAIL', $dados['email']);
        DEFINE('CONST_SITE', $dados['site']);
        DEFINE('CONST_LOGO', $dados['logo']);
    }

	
?>