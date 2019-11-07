<?php
	session_start();
	session_unset();
	session_destroy();
	unset($_SESSION['email']);
	unset($_SESSION['senha']);
	header('location:../../Inicio/login/index.php');

?>