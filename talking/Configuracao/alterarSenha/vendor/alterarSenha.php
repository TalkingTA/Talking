<?php session_start() ?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<title>Alterar senha</title>
	<meta charset="UTF-8">
	<!-- IMPORTS DE BOOTSTRAP -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- IMPORTS -->

	<!-- ICONE -->
	<link rel="icon" type="image/png" href="images/icons/key.ico"/>

	<!-- FONTS -->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<!-- BOOTSTRAP-->
	
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	
		
		<div class="container-login100">

			<div class="wrap-login100">
				
				<div class="wrap-contact100">
					<form class="contact100-form validate-form" action="../../php/metodos/alterarSenha.php" method="POST">
						<span class="contact100-form-title">
							Alterar Senha
						</span>
				
						<div class="wrap-input100 validate-input">
							<input class="input100" type="password" name="novaSenha" id="senha" autocomplete="off" placeholder="Nova senha" required>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100 validate-input">
							<input class="input100" type="password" name="confirmarSenha" id="senha" autocomplete="off" placeholder="Confirmar Nova senha" required>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>
						<?php
							if(isset($_SESSION['msg'])){
								echo $_SESSION['msg'];
								unset($_SESSION['msg']);
							}
					
						?>
					
						<!-- BTN LOGAR -->
						<div class="container-login100-form-btn">
							<input type="submit" name="alterarSenha" value="Alterar" class="login100-form-btn">
						</div>
						<br>
						<div class="text-center p-t-12">
							<a class="txt1" href="../../Configuracao/recuperarSenha/recuperarSenha.php">
								Esqueceu sua senha?
							</a>
						</div>


				
					</form>
				
				</div>
			</div>
		</div>

	

</body>
</html>