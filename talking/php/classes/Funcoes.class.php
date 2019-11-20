<?php

include_once ("db.class.php");

class Funcoes {
    
    private $con;
    private $obj;


    //PESSOA
    private $idAdministrador;
    private $nomeAdministrador;
    private $cpfAdministrador;
    private $emailAdministrador;
    private $celularAdministrador;
    private $senhaAdministrador;
    private $tipoPessoa;

    //DISCIPLINA
    private $disciplinaDescricao;

    // TURMA
    private $serieTurma;
    private $descricaoTurma;
    private $periodoTurma;

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

    // CADASTRO DE PESSOA
    public function cadastrarAdministrador($dados){

        try{

        	$this->nomeAdministrador	= $dados['nomeAdministrador'];
       	 	$this->cpfAdministrador		= $dados['cpfAdministrador'];
        	$this->emailAdministrador	= $dados['emailAdministrador'];
        	$this->celularAdministrador = $dados['celularAdministrador'];
        	$this->senhaAdministrador 	= md5($dados['senhaAdministrador']);
        	$this->tipoPessoa  		    = $dados['tipo_id'];

       
        	$sql = $this->con->prepare("INSERT INTO administrador (administrador_nome, administrador_CPF, administrador_email, administrador_celular, administrador_senha, tipo_id)VALUES (:nomeAdministrador, :cpfAdministrador, :emailAdministrador, :celularAdministrador, :senhaAdministrador, :tipoPessoa);");

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

    // CADASTRAR TURMA
    public function cadastrarTurma($dados){

        try{
            
            $this->serieTurma     = $dados['serie'];
            $this->descricaoTurma = $dados['descricao'];
            $this->periodoTurma   = $dados['turma_periodo'];

            $sql = $this->con->prepare("INSERT INTO turma (turma_serie, turma_descricao, turma_periodo) values (:serieTurma, :descricaoTurma, :periodoTurma);");
            $sql->bindParam(":serieTurma", $this->serieTurma, PDO::PARAM_STR);
            $sql->bindParam(":descricaoTurma", $this->descricaoTurma, PDO::PARAM_STR);
            $sql->bindParam(":periodoTurma", $this->periodoTurma, PDO::PARAM_STR);

         
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

        	$this->nomeAluno 		 = $dados['nomeAluno'];
        	$this->ra				 = $dados['ra'];
       	 	$this->responsavel_aluno = $dados['responsavel_aluno'];
        	$this->turma			 = $dados['turma'];
        	$this->serie			 = $dados['serie'];
        	

        	$sql = $this->con->prepare("INSERT INTO aluno (nome_aluno, ra_aluno, responsavel_aluno, turma_aluno, serie_aluno)VALUES (:nomeAluno, :ra, :responsavel_aluno, :turma, :serie);");

			
            $sql->bindParam(":nomeAluno", 		  $this->nomeAluno, PDO::PARAM_STR);
            $sql->bindParam(":ra", 				  $this->ra, PDO::PARAM_STR);
            $sql->bindParam(":responsavel_aluno", $this->responsavel_aluno, PDO::PARAM_STR);
            $sql->bindParam(":turma", 			  $this->turma, PDO::PARAM_STR);
            $sql->bindParam(":serie", 		      $this->serie, PDO::PARAM_STR);
       
            
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

                $query  = "UPDATE administrador SET senha_administrador = '$senhaNova' WHERE email_administrador = '$emailEnviar'";
                $sql = $mysqli->query($query) or die($mysqli->error);
                header('location:../../recuperarSenha/recuperarSenha.php');

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
