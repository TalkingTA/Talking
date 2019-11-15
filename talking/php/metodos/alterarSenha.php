<?php
session_start();
require_once '../classes/Funcoes.class.php';
$obj = new Funcoes();
$obj->setTabela("administrador");

	// ALTERAR SENHA
	if($_POST['operacao'] == "alterarSenha"){
		$acao = null;
		$dados = array();
		$where = "administrador_id=" . $_POST['administrador_id'];	 
		$dados["administrador_senha"]  =  	"'" . $_POST['novaSenha'] . "'";
		$obj->alterar($where,$dados);
	
	}


?>