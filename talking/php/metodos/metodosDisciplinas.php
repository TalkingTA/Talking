<?php
session_start();
require_once '../classes/Funcoes.class.php';
$obj = new Funcoes();
$obj->setTabela("disciplina");

	


	// CADASTRAR DISCIPLINA
	if($_POST['operacao'] == "cadDisciplina"){

		if($obj->cadastrarDisciplina($_POST) == 'ok'){

			echo '<script type="text/javascript">
			alert("Disciplina cadastrada com sucesso!!");
			window.location="../../Cadastrar/disciplinas/disciplinas.php";
			</script>';
			
		}
		else{

			echo '<script type="text/javascript">
			alert("Disciplina não cadastrada!!");
			window.location="../../Cadastrar/disciplinas/disciplinas.php";
			</script>';

		}

	}

	// ALTERAR DISCIPLINA
	if(isset($_POST['alterarDisciplina'])){
		$acao = null;
		$dados = array();
		$where = "disciplina_id=" . $_POST['disciplina_id'];	 
		$dados["disciplina_descricao"]  =  	"'" . $_POST['descricao'] . "'";
		$obj->alterar($where,$dados);

		echo '<script type="text/javascript">
		alert("Disciplina alterada com sucesso!");
		window.location="../../Cadastrar/disciplinas/disciplinas.php";	
		</script>';

		
	}
	
	// EXCLUIR DISCIPLINA
	if(isset($_POST['excluirDisciplina'])){
		$where = "disciplina_id=" . $_POST['disciplina_id'];
		$dados  = $obj->excluir($where); 

		echo '<script type="text/javascript">
		alert("Disciplina excluida com sucesso!");
		window.location="../../Cadastrar/disciplinas/disciplinas.php";	
		</script>';
			

	}

	
?>