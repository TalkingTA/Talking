<?php
	
$erro = array();

$mysqli = mysqli_connect("localhost","root","","talking");

	if($_POST['operacao'] == "enviarSenha"){

		
		$email = $mysqli->escape_string($_POST['email']);

		if(filter_var($email, FILTER_VALIDADE_EMAIL)){
			$erro[] = "E-mail inválido ou não está cadastrado.";
		}



		if(count($erro) == 0){

			$novasenha = substr(md5(time()), 0, 6);
			$senhaNova = md5(md5($novasenha));


			if(mail($email, "Sua nova senha", "Sua nova senha foi redefinida para: ".$novasenha)){

				$sql_code = "UPDATE administrador SET senha_adm = '$senhaNova' WHERE email_adm = '$email'";
				$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
				header('location:../../recuperarSenha/recuperarSenha.php');
			}
		}


	}




?>