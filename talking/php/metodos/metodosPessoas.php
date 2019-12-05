<?php
session_start();
require_once '../classes/Funcoes.class.php';
$obj = new Funcoes();
$obj->setTabela("pessoa");

	


	// CADASTRAR PESSOA
	if(isset($_POST['cadPessoa'])){

		$senha  		= $_POST['senhaPessoa'];
		$senhaConfirma  = $_POST['confirmarSenha'];

		$teste1 = strlen($senha);
		$teste2 = strlen($senhaConfirma);

		if($senha <> $senhaConfirma){

			$_SESSION['msg'] = " <p class='alert alert-danger'>As senhas não coincidente!</p>";
			header('location:../../Cadastrar/pessoas/pessoas.php');

		}
		elseif($teste1 <8 and $teste2 <8){

			$_SESSION['msg'] = " <p aling='center' class='alert alert-danger'>As senhas deve ter no minimo 8 caracteres!</p>";
			header('location:../../Cadastrar/pessoas/pessoas.php');
		}

		else{

			if($obj->cadastrarPessoa($_POST) == 'ok'){

				//$obj->enviarEmailPessoa($_REQUEST);
				echo '<script type="text/javascript">
				alert("Pessoa cadastrada com sucesso!!");
				window.location="../../Cadastrar/pessoas/pessoas.php";
				</script>';
			
			}
			else{

				echo '<script type="text/javascript">
				alert("Pessoa não cadastrada!!");
				window.location="../../Cadastrar/pessoas/pessoas.php";
				</script>';

			}

		}	

	}

	// ALTERAR PESSOA
	if(isset($_POST['alterarPessoa'])){
		$acao = null;
		$dados = array();
		$where = "turma_id=" . $_POST['turma_id'];	 
		$dados["turma_serie"]  	   =  "'" . $_POST['serie'] . "'";
		$dados["turma_descricao"]  =  "'" . $_POST['descricao'] . "'";
		$dados["turma_periodo"]    =  "'" . $_POST['periodo'] . "'";
		$obj->alterar($where,$dados);

		echo '<script type="text/javascript">
		alert("Pessoa alterada com sucesso!!");
		window.location="../../Cadastrar/pessoas/pessoas.php";
		</script>';

		
	}
	
	// EXCLUIR PESSOA
	if(isset($_POST['excluirPessoa'])){
		$where = "turma_id=" . $_POST['turma_id'];
		$dados  = $obj->excluir($where); 

		echo '<script type="text/javascript">
		alert("Pessoa excluida com sucesso!!");
		window.location="../../Cadastrar/pessoas/pessoas.php";
		</script>';
			

	}


	
?>