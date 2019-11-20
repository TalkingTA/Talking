<?php
	session_start();
    require_once '../../php/classes/Funcoes.class.php';
    $obj = new Funcoes();
    $obj->setTabela("tipo_pessoa");
    $dados = $obj->consultar();
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<title>Cadastro de Administrador</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- IMPORTS -->

    <!-- ICONES -->
	<link rel="icon" type="image/png" href="images/icons/adm.ico"/>

	<!-- FONTES-->
	<link rel="stylesheet" type="text/css" href="fonts/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css">
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<!-- IMPORTANDO JQUERY PARA UTILIZAR AS MASCARA-->
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.mask.min.js"></script>

	<!-- CRIANDO AS MASCARA -->
	<script type="text/javascript">
		//SÓ VAI INSERIR QUANDO O FORMULARIO FOR CARREGADO
		$(document).ready(function(){
			$("#cpf").mask("000.000.000-00")
			$("#celular").mask("(00) 00000-0000")

			$("#rg").mask("99.999.999-W", {
				translation: {
					'W': {
						pattern: /[X0-9]/
					}
				},
				reverse: true
			})
		})
		

	</script>
</head>
<body>
	
	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="POST" action="../../php/metodos/metodos.php">
				
				<!-- NOME -->
				<div class="wrap-input100 validate-input bg1">
					<span class="label-input100">Nome Completo</span>
					<input class="input100" type="text" name="nomeAdministrador" id="nome" autocomplete="off" placeholder="Digite seu nome" required>
				</div>
				
	
				<!-- CPF -->
				<div class="wrap-input100 bg1 rs1-wrap-input100">
					<span class="label-input100">CPF</span>
					<input class="input100" type="text" name="cpfAdministrador" id="cpf" autocomplete="off" placeholder="Digite seu CPF" required>
				</div>
				
				<!-- EMAIL -->
				<div class="wrap-input100 validate-input bg1 rs1-wrap-input100">
					<span class="label-input100">Email</span>
					<input class="input100" type="text" name="emailAdministrador" id="email" autocomplete="off" placeholder="Digite seu e-mail" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
				</div>
				
				<!-- CELULAR -->
				<div class="wrap-input100 bg1 rs1-wrap-input100">
					<span class="label-input100">Celular</span>
					<input class="input100" type="text" name="celularAdministrador" id="celular" autocomplete="off" placeholder="Digite seu número" required>
				</div>

				<!-- TIPO ADMINISTRADOR -->
				<div class="wrap-input100 bg1 rs1-wrap-input100">
					<span class="label-input100">Tipo de Administrador</span>
					<select name="tipo_id" class="form-control" required>
						<option value="">---</option>
						<?php for($i=0;$i<count($dados);$i++){ ?>
							<option value="<?php echo $dados[$i]['tipo_id']; ?>"><?php echo $dados[$i]['tipo_pessoa'];?></a>
					   	<?php } ?>  
					</select>
				</div>
				
				 
				<!-- SENHA -->
				<div class="wrap-input100 validate-input bg1">
					<span class="label-input100">Senha</span>
					<input class="input100" type="password" name="senhaAdministrador" id="senha" autocomplete="off" placeholder="Digite sua senha" required>
				</div>

				<div class="wrap-input100 validate-input bg1">
					<span class="label-input100">Confirmar senha</span>
					<input class="input100" type="password" name="confirmarSenha" id="senha" autocomplete="off" placeholder="Confirme sua senha" required>
				</div>

				<div>
				<?php
					if(isset($_SESSION['msg'])){
						echo $_SESSION['msg'];
						unset($_SESSION['msg']);
					}
					
				?>
				</div>
				<!-- BOTÃO CADASTRAR -->
				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						<span>
							<input type="hidden" name="operacao" value="cadastrar">
							<button="submit" name="cadastrar" class="login100-form-btn">CADASTRAR</button>
						</span>
					</button>
				</div>
		
				<!-- POSSUI CONTA -->
				<div class="contact100-form validate-form">
					<span class="contact100-form-title">
					
						<a class="a" href="../../Inicio/login/index.php">
							Possui uma conta?
	
						</a>
					</span>
				<div>		
			</form>

		</div>
	</div>

	
	
	<!-- SCRIPT BOOTSTRAP -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
