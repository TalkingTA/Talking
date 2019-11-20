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


	// CADASTRAR ADMINISTRADOR
	if($_POST['operacao'] == "cadastrar"){

		$senha  		= $_POST['senhaAdministrador'];
		$senhaConfirma  = $_POST['confirmarSenha'];

		if($senha <> $senhaConfirma){

			$_SESSION['msg'] = " <p class='alert alert-danger'>As senhas não coincidente!</p>";
			header('location:../../Cadastrar/cadastroADM/cad.php');

		}
		else{

			if($obj->cadastrarAdministrador($_POST) == 'ok'){

				$obj->enviarEmail($_REQUEST);

				header('location:../../Inicio/login/index.php');
			}
			else {

				echo '<script type="text/javascript">
				alert("Administrador não cadastrado!!");
				window.location="../../Cadastrar/cadastroADM/cad.php";
				</script>';

			}
			
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

	if(isset($_POST['enviarSenha'])){

		if($obj->enviarSenha($_POST)== 'ok'){

			$_SESSION['msg'] = " <p class='alert alert-primary'>As senhas não coincidente!</p>";
			header('location:../../Configuracao/recuperarSenha/recuperarSenha.php');
		}else {

			$_SESSION['msg'] = " <p class='alert alert-danger'>E-mail não cadastrado!</p>";
			header('location:../../Configuracao/recuperarSenha/recuperarSenha.php');

		}
	}

?>