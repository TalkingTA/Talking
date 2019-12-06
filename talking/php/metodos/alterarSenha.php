<?php
session_start();
require_once '../classes/Funcoes.class.php';
$obj = new Funcoes();
$obj->setTabela("administrador");

	// ALTERAR SENHA
	if(isset($_POST['alterarSenha'])){
		
		$senha  		= $_POST['novaSenha'];
		$senhaConfirma  = $_POST['confirmarSenha'];

		// FUNÇÃO SRTLEN USADA PARA SABER A QUANTIDADE DE CARACTERES DENTRO DA VARIAVEL
		$teste1 = strlen($senha);
		$teste2 = strlen($senhaConfirma);

		// VERIFICANDO SE ESTÃO DIFERENTES
		if($senha <> $senhaConfirma){

			$_SESSION['msg'] = " <p aling='center' class='alert alert-danger'>As senhas não coincidente!</p>";
			header('location:../../Configuracao/alterarSenha/alterarSenha.php');

		}
		// VERIFICANDO SE É MAIOR QUE 8 OS DIGITOS DA SENHA
		elseif($teste1 <8 and $teste2 <8){

			$_SESSION['msg'] = " <p aling='center' class='alert alert-danger'>As senhas deve ter no minimo 8 caracteres!</p>";
			header('location:../../Configuracao/alterarSenha/alterarSenha.php');
		}
		else{

			$novaSenha = MD5($_POST['novaSenha']);
    		$senha = "'".$novaSenha."'";

			$acao = null;
			$dados = array();
			$where = "administrador_email='" . $_POST['email'] . "'";	 
			$dados["administrador_senha"]  =   ($senha);
			$obj->alterar($where,$dados);

			echo '<script type="text/javascript">
			alert("Senha alterada com sucesso!");
			window.location="../../Configuracao/alterarSenha/alterarSenha.php";	
			</script>';
			
		}
	
	}


?>