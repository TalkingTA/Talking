<?php
session_start();
require_once '../classes/Funcoes.class.php';
$obj = new Funcoes();
$obj->setTabela("pessoa");

	


	// CADASTRAR PESSOA
	if(isset($_POST['cadPessoa'])){

		$senha  		= $_POST['senhaPessoa'];
		$senhaConfirma  = $_POST['confirmarSenha'];

		if($senha <> $senhaConfirma){

			$_SESSION['msg'] = " <p class='alert alert-danger'>As senhas não coincidente!</p>";
			header('location:../../Cadastrar/pessoas/pessoas.php');

		}

		else{

			if($obj->cadastrarPessoa($_POST) == 'ok'){

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

	// PESQUISAR PESSOA
	if(isset($_POST['pesquisarPessoa'])){
		$where = "pessoa_nome=" . $_POST['pesquisar'];
		$dados  = $obj->consultar($where); 

	}

	
?>