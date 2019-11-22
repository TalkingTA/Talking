<?php

include_once ("db.class.php");

class Funcoes {
    
    private $con;
    private $obj;

    // ADMINISTRADOR
    private $idAdministrador;
    private $nomeAdministrador;
    private $cpfAdministrador;
    private $emailAdministrador;
    private $celularAdministrador;
    private $senhaAdministrador;
    private $tipoPessoa;

    // ALUNO
    private $idAluno;
    private $nomeAluno;
    private $raAluno;
    private $idadeAluno;
    private $sexoAluno;
    private $responsavelAluno;
    private $statusAluno;
    private $turmaAluno;


    // DISCIPLINA
    private $disciplinaDescricao;

    // PESSOA
    private $idPessoa;
    private $nomePessoa;
    private $cpfPessoa;
    private $emailPessoa;
    private $celularPessoa;
    private $statusPessoa;
    private $senhaPessoa;
    private $tipoPessoaPessoa;

    // TURMA
    private $serieTurma;
    private $descricaoTurma;
    private $periodoTurma;

    // ALTERAR SENHA
    private $novaSenha;


    // RECUPERAR SENHA
    private $emailDestinatario;

    
   
	private $tabela;
    
    public function __construct(){
        $db = new Conexao();
		$this->con = $db->conectar();
       
    }


    // LOGIN PESSOA
	public function logar($dados){
		
		$this->emailAdministrador = $dados['email'];
		$this->senhaAdministrador = $dados['senha'];
		
		try{
			
			// BUSCANDO SE EXISTE O EMAIL E SENHA DO USUARIO CASO EXISTE VAI RETORNAR SUCESSO
			$sql = $this->con->prepare("SELECT 'sucesso' as sucesso, administrador_id FROM administrador WHERE administrador_email = :email AND administrador_senha = :senha;");
			
			$sql->bindParam(":email", $this->emailAdministrador, PDO::PARAM_STR);
			$sql->bindParam(":senha", md5($this->senhaAdministrador), PDO::PARAM_STR);
			$sql->execute();
			$reg = $sql->fetch(PDO::FETCH_ASSOC);

			if($reg['sucesso'] == 'sucesso'){
				// SE REGISTRO FOR ENCONTRADO RETORNA SUCESSO E O USUARIO PODE ACESSAR
				return "ok";
			}

		}
			catch(PDOException $ex){
			return 'error '.$ex->getMessage();
		}
	}

    // CADASTRO DE ADMINISTRADOR
    public function cadastrarAdministrador($dados){

        try{

        	$this->nomeAdministrador	= $dados['nomeAdministrador'];
       	 	$this->cpfAdministrador		= $dados['cpfAdministrador'];
        	$this->emailAdministrador	= $dados['emailAdministrador'];
        	$this->celularAdministrador = $dados['celularAdministrador'];
        	$this->senhaAdministrador 	= md5($dados['senhaAdministrador']);
        	$this->tipoPessoa  		    = $dados['tipo_id'];

       
        	$sql = $this->con->prepare("INSERT INTO administrador (administrador_nome, administrador_CPF, administrador_email, administrador_celular, administrador_senha, tipo_id) VALUES (:nomeAdministrador, :cpfAdministrador, :emailAdministrador, :celularAdministrador, :senhaAdministrador, :tipoPessoa);");

			// USADO BINDPARAM PARA VINCULAR A VARIÁVEL
			//PDO(PHP Data Objects) É UM MÓDULO DE PHP MONTADO SOB O PARADIGMA OO, COM OBJETIVO DE PATRONIZAR A COMUNICAÇÃO DO PHP COM UM BANCO DE DADOS RELACIONAL
			
            $sql->bindParam(":nomeAdministrador", 	$this->nomeAdministrador, PDO::PARAM_STR);
            $sql->bindParam(":cpfAdministrador", 	$this->cpfAdministrador, PDO::PARAM_STR);
            $sql->bindParam(":emailAdministrador", 	$this->emailAdministrador, PDO::PARAM_STR);
            $sql->bindParam(":celularAdministrador",$this->celularAdministrador, PDO::PARAM_STR);
            $sql->bindParam(":senhaAdministrador", 	$this->senhaAdministrador, PDO::PARAM_STR);
            $sql->bindParam(":tipoPessoa",          $this->tipoPessoa, PDO::PARAM_STR);
            
            
            
            if($sql->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    // CADASTRO DE ALUNO
    public function cadastrarAluno($dados){

        try{

            $this->nomeAluno            = $dados['nomeAluno'];
            $this->raAluno              = $dados['ra'];
            $this->idadeAluno           = $dados['idade'];
            $this->sexoAluno            = $dados['sexo'];
            $this->responsavelAluno     = $dados['responsavelAluno'];
            $this->statusAluno          = $dados['statusAluno'];
            $this->turmaAluno           = $dados['turmaAluno'];
            

            $sql = $this->con->prepare("INSERT INTO aluno (aluno_nome, aluno_ra, aluno_idade, aluno_sexo, aluno_responsavel, status_aluno, turma_id) VALUES (:nomeAluno, :ra, :idade, :sexo :responsavelAluno, :statusAluno, :turmaAluno);");

            
            $sql->bindParam(":nomeAluno",           $this->nomeAluno, PDO::PARAM_STR);
            $sql->bindParam(":raAluno",             $this->raAluno, PDO::PARAM_STR);
            $sql->bindValue(":idadeAluno",          $this->idadeAluno, PDO::PARAM_STR);
            $sql->bindParam(":sexoAluno",           $this->sexoAluno, PDO::PARAM_STR);
            $sql->bindParam(":responsavelAluno",    $this->responsavelAluno, PDO::PARAM_STR);
            $sql->bindParam(":statusAluno",         $this->statusAluno, PDO::PARAM_STR);
            $sql->bindParam(":turmaAluno",          $this->turmaAluno, PDO::PARAM_STR);
            
           if($sql->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }



    // CADASTRO DE DISCIPLINA
    public function cadastrarDisciplina($dados){

    	try{
    		$this->disciplinaDescricao = $dados['descricao'];

    		$sql= $this->con->prepare("INSERT INTO disciplina (disciplina_descricao) values (:disciplinaDescricao);");

    		$sql->bindParam(":disciplinaDescricao", $this->disciplinaDescricao, PDO::PARAM_STR);
    	
    	 
            if($sql->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

        // CADASTRO DE PESSOA
    public function cadastrarPessoa($dados){

        try{

            $this->nomePessoa       = $dados['nomePessoa'];
            $this->cpfPessoa        = $dados['cpfPessoa'];
            $this->emailPessoa      = $dados['emailPessoa'];
            $this->celularPessoa    = $dados['celularPessoa'];
            $this->statusPessoa     = $dados['statusPessoa'];
            $this->senhaPessoa      = md5($dados['senhaPessoa']);
            $this->tipoPessoaPessoa = $dados['tipoPessoaPessoa'];

       
            $sql = $this->con->prepare("INSERT INTO pessoa (pessoa_nome, pessoa_CPF, pessoa_email, pessoa_celular, pessoa_senha, status_pessoa, tipo_id) VALUES (:nomePessoa, :cpfPessoa, :emailPessoa, :celularPessoa, :statusPessoa, :senhaPessoa, :tipoPessoaPessoa);");

            // USADO BINDPARAM PARA VINCULAR A VARIÁVEL
            //PDO(PHP Data Objects) É UM MÓDULO DE PHP MONTADO SOB O PARADIGMA OO, COM OBJETIVO DE PATRONIZAR A COMUNICAÇÃO DO PHP COM UM BANCO DE DADOS RELACIONAL
            
            $sql->bindParam(":nomePessoa",          $this->nomePessoa, PDO::PARAM_STR);
            $sql->bindParam(":cpfPessoa",           $this->cpfPessoa, PDO::PARAM_STR);
            $sql->bindParam(":emailPessoa",         $this->emailPessoa, PDO::PARAM_STR);
            $sql->bindParam(":celularPessoa",       $this->celularPessoa, PDO::PARAM_STR);
            $sql->bindParam(":statusPessoa",        $this->statusPessoa, PDO::PARAM_STR);
            $sql->bindParam(":senhaPessoa",         $this->senhaPessoa, PDO::PARAM_STR);
            $sql->bindParam(":tipoPessoaPessoa",    $this->tipoPessoaPessoa, PDO::PARAM_STR);
            
            
            
            if($sql->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    // CADASTRAR TURMA
    public function cadastrarTurma($dados){

        try{
            
            $this->serieTurma     = $dados['serie'];
            $this->descricaoTurma = $dados['descricao'];
            $this->periodoTurma   = $dados['turma_periodo'];

            $sql = $this->con->prepare("INSERT INTO turma (turma_serie, turma_descricao, turma_periodo) values (:serieTurma, :descricaoTurma, :periodoTurma);");
            $sql->bindParam(":serieTurma",      $this->serieTurma, PDO::PARAM_STR);
            $sql->bindParam(":descricaoTurma",  $this->descricaoTurma, PDO::PARAM_STR);
            $sql->bindParam(":periodoTurma",    $this->periodoTurma, PDO::PARAM_STR);

         
            if($sql->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }
	

	
    // ENVIAR EMAIL APOS SE CADASTRAR
    public function enviarEmail($dados){

        $nome  = $_REQUEST['nomeAdministrador'];
        $to    = $_REQUEST['emailAdministrador'];

        $origem = "TalkingTA@hotmail.com";
        $msg    ="Seja bem vindo a TalkingTA!";
        //$header = "MIME-Version: 1.0";
        $header = "Content-type: text/html; charset='iso-8859-1'";
        $header = "From: $origem Replay-to: $to";

        $header = "Olá $nome \n";
        $header   ="Seu cadastro foi realizado com sucesso!";

        mail($to, $msg, $header);
        
    }

    public function enviarSenha($dados){

        try{

            $emailEnviar    = $_REQUEST['emailEnviar'];
        
            $novasenha = substr(md5(time()), 0, 6);
            $senhaNova = md5(md5($novasenha));

            $origem = "TalkingTA@hotmail.com";
            $msg    ="Estamos enviando sua nova senha";
            //$header = "MIME-Version: 1.0";
            $header = "Content-type: text/html; charset='iso-8859-1'";
            $header = "From: $origem Replay-to: $emailEnviar";
            //$header = "Ola $emailEnviar \n";
        
        
            if(mail($emailEnviar, $msg, $header, "Sua nova senha foi redefinida para: ".$novasenha)){

                $query  = "UPDATE administrador SET administrador_senha = '$senhaNova' WHERE administrador_email = '$emailEnviar'";
                $sql = $mysqli->query($query) or die($mysqli->error);

                if($sql->execute()){
                    return 'ok';
                }else{
                    return 'erro';
                }
            }


        }catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
        
    }

    public function alterarSenha($dados){

        try{

            $this->novaSenha      = $dados['novaSenha'];
            
            $senhaNova = md5($dados['novaSenha']);

            $origem = "TalkingTA@hotmail.com";
            $msg    ="Ola, \n";
            //$header = "MIME-Version: 1.0";
            $header = "Content-type: text/html; charset='iso-8859-1'";
            $header = "From: $origem Replay-to: $emailEnviar";
            $header = "Sua senha foi alterada com sucesso!";
        
            if(mail($emailEnviar, $msg, $header)){

                $query  = "UPDATE administrador SET administrador_senha = '$senhaNova' WHERE email_administrador = '" . $_SESSION["email"] . "'";
                $sql = $mysqli->query($query) or die($mysqli->error);
               
                if($sql->execute()){
                    return 'ok';
                }else{
                    return 'erro';
                }
            }


        }catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
        
    }


    

    // ALTERAR
	public function alterar($where = null,$dados = null){                 
		if(!is_null($where)){
			$valores = array();
			foreach($dados as $key=>$value){
				$valores[] = $key."=".$value;
			}
			$valores = implode(',',$valores);
			$query = "UPDATE ".$this->tabela." SET ".
			$valores." WHERE ".$where;
			return $this->executaSQL($query);
		} 
		else {
         return false;
		}
	}
  
  	// EXCLUIR
	public function excluir($where = null){
		if(!is_null($where)){
			$query = "DELETE FROM ".$this->tabela." WHERE ".$where;
			return $this->executaSQL($query);
		}
		else{
			return false;
		}
	} 


	public function consultar($where="",$campos="*"){
		$sql = "SELECT " . $campos . " FROM " . $this->tabela;

		if ($where != "") {
			$sql = $sql . " WHERE " . $where;	
		}
		return $this->executaSQL($sql);
	}



	public function getConexao(){
		return $this->con;
	}
		
		
	public function setTabela($tabela){
		$this->tabela = $tabela;
	}
		
	public function executaSQL($sql){
		$dados = array();
		$sql = trim($sql);

		try{
			$this->con->beginTransaction();
			$resultado = $this->con->query($sql);
			$this->con->commit();
		}catch(PROException $e){
			$this->con->rollBack();
			$resultado = NULL;
			$mensagem = $e->getMessage();
			file_put_contents("erro.log", $mensagem);
		}
		if($resultado){
				
			while($row=$resultado->fetch(PDO::FETCH_ASSOC)){
				$dados[] = $row;
			}
			return $dados;
		}
	}	

	
	
}
?>
