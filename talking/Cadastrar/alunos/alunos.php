<?php
  session_start();
  if(!isset($_SESSION['email']) and !isset($_SESSION['senha'])){
    header("location: ../../Inicio/sair/sair.php");
  }  
  else {
    require_once '../../php/classes/Funcoes.class.php';
    $obj  = new Funcoes();
    $obj1 = new Funcoes();
    $obj2 = new Funcoes();

    $obj1->setTabela("turma");
    $dados1 = $obj1->consultar();

    $obj2->setTabela("pessoa");
    $dados2 = $obj2->consultar();

    $obj->setTabela("aluno");
    $where = '';
    if(isset($_POST['pesquisarAluno']) && !empty($_POST['pesquisar'])){
      $where = "aluno_nome='" . $_POST['pesquisar']. "'";
    }
    $dados = $obj->consultar($where);
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/estudante.ico"/>
    <title>Alunos</title>

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

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="../../Inicio/menuInicial/menu.php">Início<span class="sr-only">(current)</span></a></li>
            <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastrar<span class="caret"></span></a>
              <ul class="dropdown-menu">
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
    <!-- FIM NAVBAR -->

    <!-- PESQUISAR ALUNO -->
    <div class="divPadding">
      <div class="container">
        <div class="col-sm-6 col-md-6">
          <form class="navbar-form navbar-left" role="search" method="POST" action="alunos.php">
            <div class="form-group">
              <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar por nome">
            </div>
            <button type="submit" name="pesquisarAluno" class="btn btn-primary">Buscar</button>
          </form>
        </div>
        <div class="col-sm-6 col-md-6">
          <!-- BOTÃO CADASTRAR ALUNO-->
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#MyModal">
            <i class="material-icons">&#xE147;</i> <span>Adicionar novo Aluno</span></a>
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
    <form method="POST" action="../../php/metodos/metodosAlunos.php">
      <div class="container">
        <table class="table table-borderless">
          <thead>
            <tr>
              <th class="thAlinhada">Nome</th>
              <th class="thAlinhada">RA</th>
              <th class="thAlinhada">Turma</th>
              <th class="thAlinhada">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php $primeiro = false; } ?>
            <input type="hidden" name="aluno_id" value="<?= $dados[$i]['aluno_id'] ?>">
            <tr>   
              <td><?php echo $dados[$i]['aluno_nome']?></td>  
              <td><?php echo $dados[$i]['aluno_ra']?></td>  
              <td><?php echo $dados[$i]['turma_id']?></td>  
               

              <td nowrap>   
                <button type="button" name="visualizar" class="btn btn-primary" data-toggle="modal" data-target="#ModalVisualizar<?php echo $dados[$i]['aluno_id']; ?>">   Visualizar
                </button>
               
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalAlterar<?php echo $dados[$i]['aluno_id']; ?>">Alterar</button>
              
                <button type="button" name="excluir" class="btn btn-danger" data-toggle="modal" data-target="#ModalExcluir<?php echo $dados[$i]['aluno_id']; ?>">Excluir</button>
              </td>
            </tr>

            <!-- MODAL VISUALIZAR ALUNO -->
            <div class="modal fade" id="ModalVisualizar<?php echo $dados[$i]['aluno_id']; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <!-- MODAL TITULO -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Dados do Aluno</h4>
                  </div>
                  <!-- MODAL TITULO -->
                  <div class="modal-body">
                    <p>Código:        <?php echo $dados[$i]['aluno_id']?></p> 
                    <p>Nome Completo: <?php echo $dados[$i]['aluno_nome']?></p> 
                    <p>RA:            <?php echo $dados[$i]['aluno_ra']?></p>  
                    <p>Idade:         <?php echo $dados[$i]['aluno_idade']?></p>  
                    <p>Sexo:          <?php echo $dados[$i]['aluno_sexo']?></p>  
                    <p>Responsável:   <?php echo $dados[$i]['pessoa_id']?></p> 
                    <p>Turma:         <?php echo $dados[$i]['turma_id']?></p>  
                    <p>Status:        <?php echo $dados[$i]['aluno_status']?></p> 
                    
                  </div>
                  <!-- MODAL BUTTONS -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL ALTERAR ALUNO -->
            <div class="modal fade" id="ModalAlterar<?php echo $dados[$i]['aluno_id']; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <!-- MODAL TITULO -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Alterar dados do Aluno</h4>
                  </div>
                  <!-- MODAL CORPO -->
                  <div class="modal-body">

                    <span class="label-input100">Nome completo</span>
                    <input class="input100" type="text" name="nomeAluno" value="<?= $dados[$i]['aluno_nome']?>">

                    <span class="label-input100">RA</span>
                    <input class="input100" type="text" name="ra" value="<?= $dados[$i]['aluno_ra']?>">

                    <span class="label-input100">Idade</span>
                    <input class="input100" type="number" min="0" oninput="this.value = Math.abs(this.value)" name="idade" value="<?= $dados[$i]['aluno_idade']?>">

                    <span class="label-input100">Sexo</span>
                    <select name="sexo" class="input100">
                      <option value="M">Masculino</a>  
                      <option value="F">Feminino</a>
                    </select>

                    <span class="label-input100">Status</span>
                    <select name="status" class="input100">
                      <option value="A">Ativo</a>  
                      <option value="I">Inativo</a>
                    </select>

                    
                  </div>
                  <!-- MODAL BUTTONS -->
                  <div class="modal-footer">
                    <button type="submit" name="alterarAluno" class="btn btn-warning">Salvar Alterações</button>
                    <button type="button" name="" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL EXCLUIR ALUNO -->
            <div class="modal fade" id="ModalExcluir<?php echo $dados[$i]['aluno_id']; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <!-- MODAL TITULO -->
                  <div class="modal-header">
                    <h4 class="modal-title">Excluir Aluno</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- MODAL CORPO -->
                  <div class="modal-body">
                    Deseja realmente excluir esse Aluno?
                  </div>
                  <!-- MODAL BUTTONS -->
                  <div class="modal-footer">
                    <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
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
       if(document.getElementById('nomeAluno').value!=""){
          document.getElementById('nomeAluno').value="";
          document.getElementById('raAluno').value="";
          document.getElementById('idadeAluno').value="";
          document.getElementById('sexoAluno').value="";
          document.getElementById('responsavelAluno').value="";
          document.getElementById('turmaAluno').value="";
          document.getElementById('statusAluno').value="";
          
        }  
      }
    </script>
   

    <!-- MOLDAL COMEÇO -->
    <form method="POST" action="../../php/metodos/metodosAlunos.php">
      <!-- MOLDAL CADASTRAR ALUNOS -->
      <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
        
            <div class="modal-body">
                    
              <span class="label-input100">Nome completo</span>
              <input class="input100" type="text" name="nomeAluno" id="nomeAluno" placeholder="Digite o nome do Aluno" required>

              <span class="label-input100">RA</span>
              <input class="input100" type="text" name="ra" id="raAluno" placeholder="Digite o ra do Aluno" required>

              <span class="label-input100">Idade</span>
              <input class="input100" type="number" name="idade" id="idadeAluno" min="0" oninput="this.value = Math.abs(this.value)" placeholder="Digite a idade do Aluno">

              <span class="label-input100">Sexo</span>
              <select name="sexo" id="sexoAluno" class="input100" placeholder="Escolha o sexo do Aluno" required>
                <option value="">---</option>
                <option value="M">Masculino</a>  
                <option value="F">Feminino</a>
              </select>

              <span class="label-input100">Responsável do Aluno</span>
              <select name="pessoa_id" class="input100" required>
                <option value="">---</option>
                  <?php for($i=0;$i<count($dados2);$i++){ ?>
                <option value="<?php echo $dados2[$i]['pessoa_id']; ?>"><?php echo $dados2[$i]['pessoa_nome'];?></a>
                <?php } ?>  
              </select> 

              <span class="label-input100">Turma</span>
              <select name="turma_id" class="input100" required>
                <option value="">---</option>
                  <?php for($i=0;$i<count($dados1);$i++){ ?>
                <option value="<?php echo $dados1[$i]['turma_id']; ?>"><?php echo $dados1[$i]['turma_id'];?></a>
                <?php } ?>  
              </select> 

              <span class="label-input100">Status</span>
              <select name="statusAluno" id="statusAluno" class="input100" placeholder="Escolha o status do Aluno" required>
                <option value="">---</option>
                <option value="A">Ativo</a>  
                <option value="I">Inativo</a>
              </select>
                    
            </div>
            <div class="modal-footer">
              <!-- BOTÃO CADASTRAR-->
              <button type="submit" name="cadAluno" class="btn btn-primary" data-dismiss="">Cadastrar</button>
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