<?php
session_start();
require_once '../classes/Funcoes.class.php';
$obj = new Funcoes();
$obj->setTabela("tipo_pessoa");


	
	

	// LOGANDO 
	if($_POST['operacao'] == "logar"){
		if($obj->logar($_POST) == 'ok'){
			// CRIANDO UMA SESSION ASSIM QUE O USUARIO LOGAR

			$email = $_POST['email'];
			$senha = $_POST['senha'];
			
			$_SESSION['email'] 	  = $email;
			$_SESSION['senha']    = $senha;
			
			// REDIRECIONANDO PARA O PAINEL DE CONTROLE
			header('location:../../Inicio/menuInicial/menu.php');


		}
		else{
			// DANDO UM UNSET NAS VARIAVEIS CASO O USUARIO NÃO TENHA CONTA PARA LIMPAR AS INFORMAÇÕES DA MEMORIA DO SERVIDOR
			
  			$_SESSION['msg'] = " <p class='alert alert-danger'>Login ou senha incorreto!</p>";
			header('location:../../Inicio/login/index.php');


		}

	}


	// CADASTRAR PESSOA
	if($_POST['operacao'] == "cadastrar"){

		if($obj->cadastrarPessoa($_POST) == 'ok'){

			$obj->enviarCadastro($_POST);

			header('location:../../Inicio/login/index.php');
			
		}
		else{

			header('location:../../Inicio/login/index.php');

		}

	}
	
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
		$where = "id_aluno=" . $_POST['id_aluno'];	 
		$dados["nome_aluno"]     		=  	"'" . $_POST['nomeAluno'] . "'";
		$dados["ra_aluno"]        		=  	"'" . $_POST['ra'] . "'";
		$dados["responsavel_aluno"] 	=  	"'" . $_POST['responsavel_aluno'] . "'";
		$dados["serie_aluno"]       	=  	"'" . $_POST['serie'] . "'";
		$dados["turma_aluno"]      		=  	"'" . $_POST['turma'] . "'";
		$obj->alterar($where,$dados);

		echo '<script type="text/javascript">
		alert("Aluno alterado com sucesso!");
		window.location="../../Cadastrar/alunos/alunos.php";	
		</script>';
		
	}
	
	// EXCLUIR ALUNO
	if(isset($_POST['excluir'])){
		$where = "id_aluno=" . $_POST['id_aluno'];
		$dados  = $obj->excluir($where); 

		echo '<script type="text/javascript">
		alert("Aluno excluido com sucesso!");
		window.location="../../Cadastrar/alunos/alunos.php";	
		</script>';
			

	}

	



	// ALTERAR SENHA
	if($_POST['operacao'] == "alterarSenha"){
		$acao = null;
		$dados = array();
		$where = "id_adm=" . $_POST['id_adm'];	 
		$dados["senha_adm"]  =  	"'" . $_POST['confirmarSenha'] . "'";
		$obj->alterar($where,$dados);
	
	}


?>