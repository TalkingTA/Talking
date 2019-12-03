<?php
  session_start();
  if(!isset($_SESSION['email']) and !isset($_SESSION['senha'])){
    header("location: ../../Inicio/sair/sair.php");
  }  
  else {
    require_once '../../php/classes/Funcoes.class.php';
    $obj  = new Funcoes();
    $obj1 = new Funcoes();

    $obj->setTabela("pessoa");
    $dados = $obj->consultar();

    $obj1->setTabela("tipo_pessoa");
    $dados1 = $obj1->consultar();
  }
?>

<!DOCTYPE html>
<html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/pessoa.ico"/>
    <title>Pessoas</title>

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

    <!-- PESQUISAR PESSOA-->
    <div class="divPadding">
      <div class="container">
        <div class="col-sm-6 col-md-6">
          <form class="navbar-form navbar-left" role="search" method="GET" action="../../php/metodos/metodosPessoas.php">
            <div class="form-group">
              <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar">
            </div>
            <button type="submit" name="buscarPessoa" class="btn btn-primary">Buscar</button>
          </form>
        </div>
        <div class="col-sm-6 col-md-6">
          <!-- BOTÃO CADASTRAR PESSOA -->
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#MyModal">
            <i class="material-icons">&#xE147;</i> <span>Adicionar Pessoa</span></a>
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
    <form  method="POST" action="../../php/metodos/metodosPessoas.php">
      <div class="container">
       
        <table class="table table-borderless">
          <thead>
            <tr>
              <th id="thAlinhada" class="col-sm-2">Nome</th>
              <th id="thAlinhada" class="col-sm-2">E-mail</th>
              <th id="thAlinhada" class="col-sm-2">Status</th>
              <th id="thAlinhada" class="col-sm-2">Ação</th>
              
            </tr>
          </thead>
          <tbody>
            <?php $primeiro = false; } ?>
            <input type="hidden" name="pessoa_id" value="<?= $dados[$i]['pessoa_id'] ?>">
            <tr>   
              <td><?php echo $dados[$i]['pessoa_nome']?></td>  
              <td><?php echo $dados[$i]['pessoa_email']?></td>  
              <td><?php echo $dados[$i]['pessoa_status']?></td>  
              

              <td nowrap>   
                <button type="button" name="visualizar" class="btn btn-primary" data-toggle="modal" data-target="#ModalVisualizar<?php echo $dados[$i]['pessoa_id']; ?>">   Visualizar
                </button>
               
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalAlterar<?php echo $dados[$i]['pessoa_id']; ?>">Alterar</button>
                <button type="button" name="excluir" class="btn btn-danger" data-toggle="modal" data-target="#ModalExcluir<?php echo $dados[$i]['pessoa_id']; ?>">Excluir</button>
              </td>
            </tr>

            <!-- MODAL VISUALIZAR PESSOA-->
            <div class="modal fade" id="ModalVisualizar<?php echo $dados[$i]['pessoa_id']; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <!-- MODAL TITULO -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Dados da Pessoa</h4>
                  </div>
                  <!-- MODAL TITULO -->
                  <div class="modal-body">
                    <p>Código:    <?php echo $dados[$i]['pessoa_id']?></p> 
                    <p>Nome:      <?php echo $dados[$i]['pessoa_nome']?></p>  
                    <p>CPF:       <?php echo $dados[$i]['pessoa_CPF']?></p>
                    <p>E-mail:    <?php echo $dados[$i]['pessoa_email']?></p>
                    <p>Celular:   <?php echo $dados[$i]['pessoa_celular']?></p>
                    <p>Status:    <?php echo $dados[$i]['pessoa_status']?></p>
                  </div>
                  <!-- MODAL BUTTONS -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL ALTERAR PESSOA -->
            <div class="modal fade" id="ModalAlterar<?php echo $dados[$i]['pessoa_id']; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <!-- MODAL TITULO -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Alterar dados da Pessoa</h4>
                  </div>
                  <!-- MODAL CORPO -->
                  <div class="modal-body">
                   
                    <label class="label-input100">Nome:</label>
                    <input type="text" class="input100" name="descricao" value="<?= $dados[$i]['pessoa_nome']  ?>"> 

                    <label class="label-input100">CPF:</label>
                    <input type="text" class="input100" name="descricao" value="<?= $dados[$i]['pessoa_CPF']  ?>"> 

                    <label class="label-input100">E-mail:</label>
                    <input type="text" class="input100" name="descricao" value="<?= $dados[$i]['pessoa_email']  ?>"> 

                    <label class="label-input100">Celular:</label>
                    <input type="text" class="input100" name="descricao" value="<?= $dados[$i]['pessoa_celular']  ?>"> 

                    <label class="label-input100">Status:</label>
                    <input type="text" class="input100" name="descricao" value="<?= $dados[$i]['pessoa_status']  ?>"> 

                    <label class="label-input100">Senha:</label>
                    <input type="text" class="input100" name="descricao" value="<?= $dados[$i]['pessoa_senha']  ?>"> 
                    
                  </div>
                  <!-- MODAL BUTTONS -->
                  <div class="modal-footer">
                    <button type="submit" name="alterarPessoa" class="btn btn-warning">Salvar Alterações</button>
                    <button type="button" name="" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL EXCLUIR PESSOA -->
            <div class="modal fade" id="ModalExcluir<?php echo $dados[$i]['pessoa_id']; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <!-- MODAL TITULO -->
                  <div class="modal-header">
                    <h4 class="modal-title">Excluir Pessoa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- MODAL CORPO -->
                  <div class="modal-body">
                    Deseja realmente excluir essa pessoa?
                  </div>
                  <!-- MODAL BUTTONS -->
                  <div class="modal-footer">
                    <button type="submit" name="excluirPessoa" class="btn btn-danger">Excluir</button>
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
    <form method="POST" action="../../php/metodos/metodosPessoas.php">
      <!-- MOLDAL CADASTRAR PESSOA -->
      <div id="MyModal" class="modal fade">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
        
            <div class="modal-body">
                    
              <label class="label-input100">Nome:</label>
              <input type="text" class="input100" name="nomePessoa" id="nome" placeholder="Digite o nome da Pessoa">

              <label class="label-input100">CPF:</label>
              <input type="number" class="input100" name="cpfPessoa" id="cpf" placeholder="Digite o CPF da Pessoa">

              <label class="label-input100">E-mail:</label>
              <input type="text" class="input100" name="emailPessoa" id="email" placeholder="Digite o e-mail da Pessoa">

              <label class="label-input100">Celular:</label>
              <input type="numbertext" class="input100" name="celularPessoa" id="celular" placeholder="Digite o celular da Pessoa">

              <span class="label-input100">Status</span>
              <select name="statusPessoa" id="status" class="form-control" placeholder="Escolha o status do Aluno" required>
                <option value="">---</option>
                <option value="A">Ativo</a>  
                <option value="I">Inativo</a>
              </select>

              <span class="label-input100">Tipo pessoa</span>
              <select name="tipoPessoaPessoa" class="form-control" required>
                <option value="">---</option>
                  <?php for($i=0;$i<count($dados1);$i++){ ?>
                <option value="<?php echo $dados1[$i]['tipo_id']; ?>"><?php echo $dados1[$i]['tipo_pessoa'];?></a>
                <?php } ?>  
              </select> 

              <label class="label-input100">Senha:</label>
              <input type="password" class="input100" name="senhaPessoa" id="senha" placeholder="Digite a senha da Pessoa">

              <label class="label-input100">Confirmar Senha:</label>
              <input type="password" class="input100" name="confirmarSenha" id="confirmarSenha" placeholder="Digite a senha novamente">

              <?php
                if(isset($_SESSION['msg'])){
                  echo $_SESSION['msg'];
                  unset($_SESSION['msg']);
                }
              ?>
                  
            </div>
            <div class="modal-footer">
              <!-- BOTÃO CADASTRAR-->
              <input type="hidden" name="operacao" value="cadPessoa">
              <button type="submit" name="cadPessoa" class="btn btn-primary" data-dismiss="">Cadastrar</button>
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