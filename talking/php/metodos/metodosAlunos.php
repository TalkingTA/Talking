<?php
session_start();
require_once '../classes/Funcoes.class.php';
$obj = new Funcoes();
$obj->setTabela("aluno");


	
	// CADASTRAR ALUNO
	if($_POST['operacao'] == "cadAluno"){

		if($obj->cadastrarAluno($_POST) == 'ok'){

			echo '<script type="text/javascript">
			alert("Aluno cadastrado com sucesso!!");
			window.location="../../Cadastrar/alunos/alunos.php";
			</script>';
			
		}
		else{

			echo '<script type="text/javascript">
			alert("Aluno não cadastrado!!");
			window.location="../../Cadastrar/alunos/alunos.php";
			</script>';

		}

	}

	// ALTERAR ALUNO
	if(isset($_POST['alterar'])){
		$acao = null;
		$dados = array();
		$where = "aluno_id=" . $_POST['aluno_id'];	 
		$dados["aluno_nome"]     	=  	"'" . $_POST['nomeAluno'] . "'";
		$dados["aluno_ra"]        	=  	"'" . $_POST['ra'] . "'";
		$dados["aluno_idade"]       =  	"'" . $_POST['idade'] . "'";
		$dados["aluno_sexo"]       	=  	"'" . $_POST['sexo'] . "'";
		$dados["status"]       		=  	"'" . $_POST['status'] . "'";
		$obj->alterar($where,$dados);

		echo '<script type="text/javascript">
		alert("Aluno alterado com sucesso!");
		window.location="../../Cadastrar/alunos/alunos.php";	
		</script>';
		
	}
	
	// EXCLUIR ALUNO
	if(isset($_POST['excluir'])){
		$where = "aluno_id=" . $_POST['aluno_id'];
		$dados  = $obj->excluir($where); 

		echo '<script type="text/javascript">
		alert("Aluno excluido com sucesso!");
		window.location="../../Cadastrar/alunos/alunos.php";	
		</script>';
			

	}


?>