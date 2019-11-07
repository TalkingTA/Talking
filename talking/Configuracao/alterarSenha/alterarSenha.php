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
      <form>
          
        <div class="form-group">
          <label for="senhaAtual">Senha atual</label>
          <input type="password" name="senhaAtual" class="form-control" id="senhaAtual" placeholder="Digite sua senha atual" required="required">
        </div>

        <div class="form-group">
          <label for="novaSenha">Nova senha</label>
          <input type="password" name="novaSenha" class="form-control" id="novaSenha" placeholder="Nova senha" required="required">
        </div>
        <div class="form-group">
          <label for="confirmarSenha">Confirmar nova senha</label>
          <input type="password" name="confirmarSenha" class="form-control" id="confirmarSenha" placeholder="Confirmar nova senha" required="required">
        </div>

        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#MyModal">Alterar</button>

        <!-- MOLDAL CONFIRMAR ALTERAÇÃO DA SENHA -->
        <div id="MyModal" class="modal fade">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </div>
              <div class="modal-body">
                Deseja realmente alterar sua senha?
              </div>
              <div class="modal-footer">
                <!-- BOTÃO ALTERAR-->
                <input type="hidden" name="operacao" value="alterarSenha">
                <button type="submit" name="alterarSenha" class="btn btn-primary" data-dismiss="">Sim</button>
                 <!-- BOTÃO CADASTRAR-->
                <button type="submit" name="fecharModal" class="btn btn-primary" data-dismiss="modal">Não</button>
               
              </div>
            </div>
          </div>
       </div>
      </form>
    </div>
  </body>
 <!-- IMPORTANDO O JQUERY-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- IMPORTANDO JS E BOOTSTRAAP -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</html>