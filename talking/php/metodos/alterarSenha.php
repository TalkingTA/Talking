<?php
session_start();
require_once '../classes/Funcoes.class.php';
$obj = new Funcoes();
$obj->setTabela("administrador");

	// ALTERAR SENHA
	if(isset($_POST['alterarSenha'])){
		
		$senha  		= $_POST['novaSenha'];
		$senhaConfirma  = $_POST['confirmarSenha'];

		if($senha <> $senhaConfirma){

			$_SESSION['msg'] = " <p class='alert alert-danger'>As senhas não coincidente!</p>";
			header('location:../../Configuracao/alterarSenha/alterarSenha.php');
			
		}
		else{

			$email = $_POST['email'];
			$_SESSION['email'] = $email;
		
			$obj->alterarSenha($_POST) and ($_SESSION);
			header('location:../../Configuracao/alterarSenha/alterarSenha.php');
			
		}
	
	}


?>