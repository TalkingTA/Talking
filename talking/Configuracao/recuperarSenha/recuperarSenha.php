
<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<title>Recuperar senha</title>
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
					<form class="contact100-form validate-form" action="../../php/metodos/enviarSenha.php" method="POST">
						<span class="contact100-form-title">
							Recuperar Senha
						</span>
				
						<!-- INPUT EMAIL -->
						<div class="wrap-input100 validate-input"">
							<input class="input100" type="text" name="email" id="email" autocomplete="off" placeholder="Digite seu E-mail" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>
					
					
						<!-- BTN LOGAR -->
						<div class="container-login100-form-btn">
							<input type="hidden" name="operacao" value="logar">
							<input type="submit" name="enviarSenha" class="login100-form-btn">
						</div>

						<!-- POSSUI CONTA -->
						<div class="contact100-form validate-form">
							<span class="contact100-form-title">
								<a class="a" href="../../Inicio/login/index.php">
									Home
			
								</a>
							</span>
						<div>	
				
					</form>
				
				</div>
			</div>
		</div>

	

</body>
</html>