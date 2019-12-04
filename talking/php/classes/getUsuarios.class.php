<?php 
include 'db.class.php';
header('Content-Type: text/html; charset=utf8');

  $response = $arrayName = array();
  $response["erro"] = true;

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    file_put_contents("Rastrear", " 1 ");
    $obj = new Conexao();
    $con = $obj->conectar();
      

    $login = "'".$_POST['usuario_email']."'";
    $senha = MD5($_POST['usuario_senha']);
    $senha = "'".$senha."'";
    	

    $sql = "SELECT * FROM administrador WHERE administrador_email = $login AND administrador_senha = $senha";
    
    $result = $con->query($sql)->fetchAll();
    if (count($result) > 0) {
      foreach ($result as $registro) {
        file_put_contents("Rastrear", " 4 ", FILE_APPEND);
        $response["linhas"] = count($result);
        $response["erro"]   = false;
        $response["login"]  = $registro['administrador_email'];
        $response["senha"]  = $registro['administrador_senha'];
        $response["perfil"] = $registro['tipo_id'];
      }

    }else{
      $response["mensagem"] = "Usuário Não Existe";
    }
      
    echo json_encode($response); 

        
 }

 ?>