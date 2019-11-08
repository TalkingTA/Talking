<?php
  session_start();
  if(!isset($_SESSION['email']) and !isset($_SESSION['senha'])){
    header("location: ../../Inicio/sair/sair.php");
  }  
  else {
    require_once '../../php/classes/Funcoes.class.php';
    $obj = new Funcoes();
    $obj->setTabela("turma");
    $dados = $obj->consultar();
  }
?>

<!DOCTYPE html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/class.ico"/>
    <title>Turmas</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">

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

    <!-- PESQUISAR TURMAS -->
    <div class="divPadding">
      <div class="container">
        <div class="col-sm-6 col-md-6">
          <form class="navbar-form navbar-left" role="search" method="GET" action="../../php/metodos/metodos.php">
            <div class="form-group">
              <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar">
            </div>
            <button type="submit" name="buscarTurma" class="btn btn-primary">Buscar</button>
          </form>
        </div>
        <div class="col-sm-6 col-md-6">
          <!-- BOTÃO CADASTRAR TURMA-->
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#MyModal">
            <i class="material-icons">&#xE147;</i> <span>Adicionar nova Turma</span></a>
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
    <form  method="POST" action="../../php/metodos/metodosTurmas.php">
      <div class="container">
       
        <table class="table table-borderless">
          <thead>
            <tr>
              <th id="thAlinhada" class="col-sm-2">Série</th>
              <th id="thAlinhada" class="col-sm-2">Descrição</th>
              <th id="thAlinhada" class="col-sm-2">Período</th>
              <th id="thAlinhada" class="col-sm-2">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php $primeiro = false; } ?>
            <input type="hidden" name="turma_id" value="<?= $dados[$i]['turma_id'] ?>">
            <tr>   
              <td><?php echo $dados[$i]['turma_serie']?></td>  
              <td><?php echo $dados[$i]['turma_descricao']?></td>  
              <td><?php echo $dados[$i]['turma_periodo']?></td> 

              <td nowrap>   
                <button type="button" name="visualizar" class="btn btn-primary" data-toggle="modal" data-target="#ModalVisualizar<?php echo $dados[$i]['turma_id']; ?>">   Visualizar
                </button>
               
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalAlterar<?php echo $dados[$i]['turma_id']; ?>">Alterar</button>
                <button type="button" name="excluir" class="btn btn-danger" data-toggle="modal" data-target="#ModalExcluir<?php echo $dados[$i]['turma_id']; ?>">Excluir</button>
              </td>
            </tr>

            <!-- MODAL VISUALIZAR TURMA -->
            <div class="modal fade" id="ModalVisualizar<?php echo $dados[$i]['turma_id']; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <!-- MODAL TITULO -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Dados da Turma</h4>
                  </div>
                  <!-- MODAL TITULO -->
                  <div class="modal-body">
                    <p>Código:    <?php echo $dados[$i]['turma_id']?></p> 
                    <p>Série:     <?php echo $dados[$i]['turma_serie']?></p> 
                    <p>Descrição: <?php echo $dados[$i]['turma_descricao']?></p>  
                    <p>Período:   <?php echo $dados[$i]['turma_periodo']?></p> 
                    
                  </div>
                  <!-- MODAL BUTTONS -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL ALTERAR TURMA -->
            <div class="modal fade" id="ModalAlterar<?php echo $dados[$i]['turma_id']; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <!-- MODAL TITULO -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Alterar dados da Turma</h4>
                  </div>
                  <!-- MODAL CORPO -->
                  <div class="modal-body">
                    <label class="label-input100">Série:</label>
                    <input type="text" class="input100" name="serie" value="<?= $dados[$i]['turma_serie']  ?>">
                    <label class="label-input100">Descrição:</label>
                    <input type="text" class="input100" name="descricao" value="<?= $dados[$i]['turma_descricao']  ?>"> 
                    <label class="label-input100">Período:</label>
                    <input type="text" class="input100" name="periodo" value="<?= $dados[$i]['turma_periodo']  ?>"> 
                    
                  
                  </div>
                  <!-- MODAL BUTTONS -->
                  <div class="modal-footer">
                    <button type="submit" name="alterarTurma" class="btn btn-warning">Salvar Alterações</button>
                    <button type="button" name="" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL EXCLUIR TURMA -->
            <div class="modal fade" id="ModalExcluir<?php echo $dados[$i]['turma_id']; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <!-- MODAL TITULO -->
                  <div class="modal-header">
                    <h4 class="modal-title">Excluir Turma</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- MODAL CORPO -->
                  <div class="modal-body">
                    Deseja realmente excluir essa Turma?
                  </div>
                  <!-- MODAL BUTTONS -->
                  <div class="modal-footer">
                    <button type="submit" name="excluirTurma" class="btn btn-danger">Excluir</button>
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
       if(document.getElementById('turmaSerie').value!=""){
          document.getElementById('turmaSerie').value="";
          document.getElementById('turmaDescricao').value="";
          document.getElementById('turmaPeriodo').value="";
        }  
      }
    </script>

    <!-- MOLDAL COMEÇO -->
    <form method="POST" action="../../php/metodos/metodosTurmas.php">
      <!-- MOLDAL CADASTRAR TURMA -->
      <div id="MyModal" class="modal fade">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
        
            <div class="modal-body">
                    
              <!-- SERIE TURMA-->
              <span class="label-input100">Série</span>
              <input class="input100" type="text" name="serie" id="turmaSerie" placeholder="Digite a Série" required>
                    
              <!-- DESCRIÇÃO DA TURMA-->
              <span class="label-input100">Turma</span>
              <input class="input100" type="text" name="descricao" id="turmaDescricao" placeholder="Digite a Turma (Exemplo A)" required>
                   

              <!-- PERIODO TURMA -->
              <span class="label-input100">Período</span>
              <select name="turma_periodo" class="form-control" placeholder="Escolha um período" required>
              <option value="">---</option>
              <option value="Manha">Manha</a>  
              <option value="Tarde">Tarde</a>
              </select>
        
                
                    
            </div>
            <div class="modal-footer">
              <!-- BOTÃO CADASTRAR-->
              <input type="hidden" name="operacao" value="cadTurma">
              <button type="submit" name="cadTurma" class="btn btn-primary" data-dismiss="">Cadastrar</button>
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