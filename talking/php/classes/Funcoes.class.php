<?php

include_once ("db.class.php");

class Funcoes {
    
    private $con;
    private $obj;


    //PESSOA
    private $idPessoa;
    private $nomePessoa;
    private $cpfPessoa;
    private $emailPessoa;
    private $celularPessoa;
    private $imagemPessoa;
    private $senhaPessoa;
    private $tipoPessoa;

    //DISCIPLINA
    private $disciplinaDescricao;

    // TURMA
    private $serieTurma;
    private $descricaoTurma;
    private $periodoTurma;

  
    //ALUNO
    //private $id_aluno;
   	//private $nomeAluno;
    //private $ra;
    //private $responsavel_aluno;
    //private $turma;
    //private $serie;
   
	private $tabela;
    
    public function __construct(){
        $db = new Conexao();
		$this->con = $db->conectar();
       
    }


    // LOGIN PESSOA
	public function logar($dados){
		
		$this->emailPessoa = $dados['email'];
		$this->senhaPessoa = $dados['senha'];
		
		try{
			
			// BUSCANDO SE EXISTE O EMAIL E SENHA DO USUARIO CASO EXISTE VAI RETORNAR SUCESSO
			$sql = $this->con->prepare("SELECT 'sucesso' as sucesso, pessoa_id FROM pessoa WHERE pessoa_email = :email AND pessoa_senha = :senha;");
			
			$sql->bindParam(":email", $this->emailPessoa, PDO::PARAM_STR);
			$sql->bindParam(":senha", md5($this->senhaPessoa), PDO::PARAM_STR);
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
    public function cadastrarPessoa($dados){

        try{

        	$this->nomePessoa 		= $dados['nomePessoa'];
       	 	$this->cpfPessoa		= $dados['cpfPessoa'];
        	$this->emailPessoa		= $dados['emailPessoa'];
        	$this->celularPessoa  	= $dados['celularPessoa'];
        	$this->imagemPessoa		= $dados['imagemPessoa'];
        	$this->senhaPessoa 		= md5($dados['senhaPessoa']);
        	$this->tipoPessoa  		= $dados['tipo_id'];

       
        	$sql = $this->con->prepare("INSERT INTO pessoa (pessoa_nome, pessoa_CPF, pessoa_email, pessoa_celular, pessoa_imagem, pessoa_senha, tipo_id)VALUES (:nomePessoa, :cpfPessoa, :emailPessoa, :celularPessoa, :imagemPessoa, :senhaPessoa, :tipoPessoa);");

			// USADO BINDPARAM PARA VINCULAR A VARIÁVEL
			//PDO(PHP Data Objects) É UM MÓDULO DE PHP MONTADO SOB O PARADIGMA OO, COM OBJETIVO DE PATRONIZAR A COMUNICAÇÃO DO PHP COM UM BANCO DE DADOS RELACIONAL
			
            $sql->bindParam(":nomePessoa", 		$this->nomePessoa, PDO::PARAM_STR);
            $sql->bindParam(":cpfPessoa", 		$this->cpfPessoa, PDO::PARAM_STR);
            $sql->bindParam(":emailPessoa", 	$this->emailPessoa, PDO::PARAM_STR);
            $sql->bindParam(":celularPessoa", 	$this->celularPessoa, PDO::PARAM_STR);
            $sql->bindParam(":imagemPessoa", 	$this->imagemPessoa, PDO::PARAM_STR);
            $sql->bindParam(":senhaPessoa", 	$this->senhaPessoa, PDO::PARAM_STR);
            $sql->bindParam(":tipoPessoa",      $this->tipoPessoa, PDO::PARAM_STR);
            
            
            
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
            $this->periodoTurma   = $dados['periodo'];

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
