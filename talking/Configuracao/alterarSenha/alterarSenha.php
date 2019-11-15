<!doctype html>
<html lang="PT-BR">
  <head>
    
    <!-- IMPORTS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- JQUERY -->
    <link rel="stylesheet" href="js/jquery-2.1.3.min.js">
    <link rel="stylesheet" href="js/bootstrap.min.js">

    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    

    <title>Alterar Senha</title>
  </head>

  <body>
    <div class="container">
     <form method="POST" action="../../php/metodos/alterarSenha.php">

        <div class="form-group">
          <label for="novaSenha">Nova senha</label>
          <input type="password" name="novaSenha" class="form-control" id="novaSenha" placeholder="Nova senha" required="required">
        </div>

        <input type="hidden" name="operacao" value="alterarSenha">
        <button type="submit" name="alterarSenha" class="btn btn-primary" data-dismiss="">Alterar Senha</button>
      </form>
    </div>
  </body>
 <!-- IMPORTANDO O JQUERY-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- IMPORTANDO JS E BOOTSTRAAP -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</html>