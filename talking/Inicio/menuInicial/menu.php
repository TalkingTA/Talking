<?php
  session_start();
  if(!isset($_SESSION['email']) and !isset($_SESSION['senha'])){
    header("location: ../../Configuracao/sair/sair.php");
  }  
?>

<!DOCTYPE html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/menu.ico"/>
    <title>Painel de controle</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
           
            <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastrar<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../../Cadastrar/alunos/alunos.php">Alunos</a></li>
                <li><a href="../../Cadastrar/disciplinas/disciplinas.php">Disciplinas</a></li>
                <li><a href="../../Cadastrar/pessoas/pessoas.php">Pessoas</a></li>
                <li><a href="../../Cadastrar/turmas/turmas.php">Turmas</a></li>
            
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../../Configuracao/sair/sair.php">Sair</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Meu Perfil <span class="caret"></span></a>
             <ul class="dropdown-menu">
                <li><a href="../../Configuracao/alterarSenha/alterarSenha.php">Alterar Senha</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        

        <div class="col-sm-3">
          <div class="card" align="center">
            <div class="card-body"><img src="images/icons/estudante.ico"></div>
            <div class="card-body"><a href="../../Cadastrar/alunos/alunos.php">Alunos</a></div>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="card" align="center">
            <div class="card-body"><img src="images/icons/dis.ico"></div>
            <div class="card-body"><a href="../../Cadastrar/disciplinas/disciplinas.php">Disciplinas</div>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="card" align="center">
            <div class="card-body"><img src="images/icons/docente.ico"></div>
            <div class="card-body"><a href="../../Cadastrar/pessoas/pessoas.php">Pessoas</div>
            
          </div>
        </div> 

        <div class="col-sm-3">
          <div class="card" align="center">
            <div class="card-body"><img src="images/icons/class.ico"></div>
            <div class="card-body"><a href="../../Cadastrar/turmas/turmas.php">Turmas</div>
          </div>
        </div>
   
    
     </div>
    </div>
   
      
   

    <!-- JQUERY-->
    <script src="js/jquery.min.js"></script>
    <!-- BOOTSTRAP-->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>