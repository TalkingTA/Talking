<?php
session_start();
require_once '../classes/Funcoes.class.php';
$obj = new Funcoes();
$obj->setTabela("aluno");


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
			
  			$_SESSION['msg'] = " <p aling='center' class='alert alert-danger'>Login ou senha incorreto!</p>";
			header('location:../../Inicio/login/index.php');


		}

	}


	// CADASTRAR ADMINISTRADOR
	if($_POST['operacao'] == "cadastrar"){

		$senha  		= $_POST['senhaAdministrador'];
		$senhaConfirma  = $_POST['confirmarSenha'];
		// FUNÇÃO SRTLEN USADA PARA SABER A QUANTIDADE DE CARACTERES DENTRO DA VARIAVEL
		$teste1 = strlen($senha);
		$teste2 = strlen($senhaConfirma);

		// VERIFICANDO SE ESTÃO DIFERENTES
		if($senha <> $senhaConfirma){

			$_SESSION['msg'] = " <p aling='center' class='alert alert-danger'>As senhas não coincidente!</p>";
			header('location:../../Cadastrar/cadastroADM/cad.php');

		}
		// VERIFICANDO SE É MAIOR QUE 8 OS DIGITOS DA SENHA
		elseif($teste1 <8 and $teste2 <8){

			$_SESSION['msg'] = " <p aling='center' class='alert alert-danger'>As senhas deve ter no minimo 8 caracteres!</p>";
			header('location:../../Cadastrar/cadastroADM/cad.php');
		}
		else{

			if($obj->cadastrarAdministrador($_POST) == 'ok'){

				$obj->enviarEmail($_REQUEST);

				echo '<script type="text/javascript">
				alert("Administrador cadastrado com sucesso!!!");
				window.location="../../index.php";
				</script>';
			}
			else {

				echo '<script type="text/javascript">
				alert("Administrador não cadastrado!!");
				window.location="../../Cadastrar/cadastroADM/cad.php";
				</script>';

			}
			
		}

	}
	

	if(isset($_POST['enviarSenha'])){

		if($obj->enviarSenha($_POST)== 'ok'){

			$_SESSION['msg'] = " <p class='alert alert-primary'>E-mail com nova senha enviado!</p>";
			header('location:../../Configuracao/recuperarSenha/recuperarSenha.php');
		}else {

			$_SESSION['msg'] = " <p class='alert alert-danger'>E-mail não cadastrado!</p>";
			header('location:../../Configuracao/recuperarSenha/recuperarSenha.php');

		}
	}

?>