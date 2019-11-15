<?php
  session_start();
  if(!isset($_SESSION['email']) and !isset($_SESSION['senha'])){
    header("location: ../../Inicio/sair/sair.php");
  }  
  else {
    require_once '../../php/classes/Funcoes.class.php';
    $obj = new Funcoes();
    $obj->setTabela("disciplina");
    $dados = $obj->consultar();
  }
?>

<!DOCTYPE html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/dis.ico"/>
    <title>Disciplinas</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

  </head>
 <body>

    <!-- INICIO NAVBAR -->
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


        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="../../Inicio/menuInicial/menu.php">Início<span class="sr-only">(current)</span></a></li>
            <li><a href="#">Confirmar Usuários<span class="sr-only">(current)</span></a></li>
            <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastrar<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../../Cadastrar/alunos/alunos.php">Alunos</a></li>
                <li><a href="../../Cadastrar/disciplinas/disciplinas.php">Disciplinas</a></li>
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
    <!-- FIM NAVBAR -->

    <!-- PESQUISAR DISCIPLINA -->
    <div class="divPadding">
      <div class="container">
        <div class="col-sm-6 col-md-6">
          <form class="navbar-form navbar-left" role="search" method="GET" action="../../php/metodos/metodosDisciplas.php">
            <div class="form-group">
              <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar">
            </div>
            <button type="submit" name="buscarDisciplina" class="btn btn-primary">Buscar</button>
          </form>
        </div>
        <div class="col-sm-6 col-md-6">
          <!-- BOTÃO CADASTRAR DISCIPLINA-->
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#MyModal">
            <i class="material-icons">&#xE147;</i> <span>Adicionar nova Disciplina</span></a>
          </button>
        </div>
      </div>
    </div>
    <br>

    <!-- COMEÇO DO CRUD -->
    <?php 
      $primeiro = true;
      for($i=0;$i<count($dados);$i++){ ?>
    <?php if($primeiro){ ?>
    <form  method="POST" action="../../php/metodos/metodosDisciplinas.php">
      <div class="container">
       
        <table class="table table-borderless">
          <thead>
            <tr>
              <th id="thAlinhada" class="col-sm-2">Código</th>
              <th id="thAlinhada" class="col-sm-2">Descrição</th>
              
            </tr>
          </thead>
          <tbody>
            <?php $primeiro = false; } ?>
            <input type="hidden" name="disciplina_id" value="<?= $dados[$i]['disciplina_id'] ?>">
            <tr>   
              <td><?php echo $dados[$i]['disciplina_id']?></td>  
              <td><?php echo $dados[$i]['disciplina_descricao']?></td>  
              

              <td nowrap>   
                <button type="button" name="visualizar" class="btn btn-primary" data-toggle="modal" data-target="#ModalVisualizar<?php echo $dados[$i]['disciplina_id']; ?>">   Visualizar
                </button>
               
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalAlterar<?php echo $dados[$i]['disciplina_id']; ?>">Alterar</button>
                <button type="button" name="excluir" class="btn btn-danger" data-toggle="modal" data-target="#ModalExcluir<?php echo $dados[$i]['disciplina_id']; ?>">Excluir</button>
              </td>
            </tr>

            <!-- MODAL VISUALIZAR DISCIPLINA -->
            <div class="modal fade" id="ModalVisualizar<?php echo $dados[$i]['disciplina_id']; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <!-- MODAL TITULO -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Dados da Disciplina</h4>
                  </div>
                  <!-- MODAL TITULO -->
                  <div class="modal-body">
                    <p>Código:    <?php echo $dados[$i]['disciplina_id']?></p> 
                    <p>Descrição: <?php echo $dados[$i]['disciplina_descricao']?></p>  
                  </div>
                  <!-- MODAL BUTTONS -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL ALTERAR DISCIPLINA -->
            <div class="modal fade" id="ModalAlterar<?php echo $dados[$i]['disciplina_id']; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <!-- MODAL TITULO -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Alterar dados da Disciplina</h4>
                  </div>
                  <!-- MODAL CORPO -->
                  <div class="modal-body">
                   
                    <label class="label-input100">Descrição:</label>
                    <input type="text" class="input100" name="descricao" value="<?= $dados[$i]['disciplina_descricao']  ?>"> 
                    
                  </div>
                  <!-- MODAL BUTTONS -->
                  <div class="modal-footer">
                    <button type="submit" name="alterarDisciplina" class="btn btn-warning">Salvar Alterações</button>
                    <button type="button" name="" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL EXCLUIR DISCIPLINA -->
            <div class="modal fade" id="ModalExcluir<?php echo $dados[$i]['disciplina_id']; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <!-- MODAL TITULO -->
                  <div class="modal-header">
                    <h4 class="modal-title">Excluir Disciplina</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- MODAL CORPO -->
                  <div class="modal-body">
                    Deseja realmente excluir essa disciplina?
                  </div>
                  <!-- MODAL BUTTONS -->
                  <div class="modal-footer">
                    <button type="submit" name="excluirDisciplina" class="btn btn-danger">Excluir</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>

                </div>
              </div>
            </div>
            <?php }
            if(!$primeiro) { ?>  
          </tbody>
        </table>
      </div>
    </form>
    <?php } ?>
    

    <!-- FUNÇÃO PARA LIMPAR OS CAMPOS -->
    <script>
      function limpa() {
       if(document.getElementById('disciplinaDescricao').value!=""){
          document.getElementById('disciplinaDescricao').value="";
          
        }  
      }
    </script>

    <!-- MOLDAL COMEÇO -->
    <form method="POST" action="../../php/metodos/metodosDisciplinas.php">
      <!-- MOLDAL CADASTRAR DISCIPLINA -->
      <div id="MyModal" class="modal fade">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
        
            <div class="modal-body">
                    
              <!-- DESCRIÇÃO DA DISCIPLINA-->
              <span class="label-input100">Descrição</span>
              <input class="input100" type="text" name="descricao" id="disciplinaDescricao" placeholder="Digite a descrição" required>
                  
            </div>
            <div class="modal-footer">
              <!-- BOTÃO CADASTRAR-->
              <input type="hidden" name="operacao" value="cadDisciplina">
              <button type="submit" name="cadDisciplina" class="btn btn-primary" data-dismiss="">Cadastrar</button>
              <!-- BOTÃO LIMPAR-->
              <input type="button" class="btn btn-default" value="Limpar campos" onClick="limpa()">
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- MOLDAL FIM-->


    <!-- IMPORTANDO O JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <!-- IMPORTANDO JS E BOOTSTRAAP -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>