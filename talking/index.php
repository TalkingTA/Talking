<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Talking</title>
	<meta charset="UTF-8">
	<!-- IMPORTS DE BOOTSTRAP -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- IMPORTS -->

	<!-- ICONE -->
	<link rel="icon" type="image/png" href="Inicio/login/images/icons/img-01.png"/>

	<!-- FONTS -->
	<link rel="stylesheet" type="text/css" href="Inicio/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<!-- BOOTSTRAP-->
	<link rel="stylesheet" type="text/css" href="Inicio/login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Inicio/login/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="Inicio/login/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="Inicio/login/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="Inicio/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="Inicio/login/css/main.css">
</head>
<body>
	
	<div class="limiter">

		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="Inicio/login/images/img-01.png" alt="IMG">
				</div>

				
				<!-- TITULO DO CARD -->
				<form class="login100-form validate-form" method="POST" action="php/metodos/metodos.php">
					<span class="login100-form-title">
						Talking
					</span>
					
					
						<!-- INPUT EMAIL -->
						<div class="wrap-input100 validate-input"">
							<input class="input100" type="text" name="email" id="email" autocomplete="off" placeholder="E-mail" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>
					
						<!-- INPUT SENHA -->
						<div class="wrap-input100 validate-input">
							<input class="input100" type="password" name="senha" id="senha" autocomplete="off" placeholder="Senha" required>
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
							<input type="hidden" name="operacao" value="logar">
							<input type="submit" name="logar" class="login100-form-btn">
						</div>
					
					
						<!-- TXT ESQUECEU SENHA -->
						<div class="text-center p-t-12">
							<a class="txt1" href="Configuracao/recuperarSenha/recuperarSenha.php">
								Esqueceu sua senha?
							</a>
							<br>
							<br>
							<br>
							<!-- TXT CADASTRAR -->
							<a class="txt1" href="Cadastrar/cadastroADM/cad.php">
								Clique para se cadastrar
								<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
							</a>
						</div>
					</form>
				
			</div>
		</div>
	</div>
	
	</form>

	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="js/main.js"></script>

</body>
</html>