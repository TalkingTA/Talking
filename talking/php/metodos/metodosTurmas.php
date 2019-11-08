<?php
session_start();
require_once '../classes/Funcoes.class.php';
$obj = new Funcoes();
$obj->setTabela("turma");

	


	// CADASTRAR TURMA
	if($_POST['operacao'] == "cadTurma"){

		if($obj->cadastrarTurma($_POST) == 'ok'){

			echo '<script type="text/javascript">
			alert("Turma cadastrada com sucesso!!");
			window.location="../../Cadastrar/turmas/turmas.php";
			</script>';
			
		}
		else{

			

		}

	}

	// ALTERAR TURMA
	if(isset($_POST['alterarTurma'])){
		$acao = null;
		$dados = array();
		$where = "turma_id=" . $_POST['turma_id'];	 
		$dados["turma_serie"]  	   =  "'" . $_POST['serie'] . "'";
		$dados["turma_descricao"]  =  "'" . $_POST['descricao'] . "'";
		$dados["turma_periodo"]    =  "'" . $_POST['periodo'] . "'";
		$obj->alterar($where,$dados);

		echo '<script type="text/javascript">
		alert("Turma alterada com sucesso!");
		window.location="../../Cadastrar/turmas/turmas.php";
		</script>';

		
	}
	
	// EXCLUIR TURMA
	if(isset($_POST['excluirTurma'])){
		$where = "turma_id=" . $_POST['turma_id'];
		$dados  = $obj->excluir($where); 

		echo '<script type="text/javascript">
		alert("Turma excluida com sucesso!");
		window.location="../../Cadastrar/turmas/turmas.php";	
		</script>';
			

	}

	
?>