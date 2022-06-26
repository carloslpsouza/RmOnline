<?php

session_start();

$usuario = $_POST['username'];
$senha = md5($_POST['password']);


require_once("../dbscripts/config.php");
require_once("../dbscripts/connect.php");
require_once("../dbscripts/database.php");


$_SESSION['user'] =  $_POST['username'];
$_SESSION['sw']   = md5($_POST['password']);

	$user = $_SESSION['user'];
	$sw   = $_SESSION['sw']; 

//Valida usuário
$acesso = DBRead('funcionario', "WHERE email='$user' AND senha='$sw'");
if ($acesso == true){
    //var_dump($acesso);
	foreach ($acesso as $dt){
		$tipo    = $dt['tipo'];
	}// foreach
	if ($tipo == 'user'){
		header("Refresh: 0;url=../u");
	}elseif ($tipo == 'suprimentos'){
		header("Refresh: 0;url=../s");
	}elseif ($tipo == 'gerente'){
		header("Refresh: 0;url=../g");
	}
	$_SESSION['tipo'] = $tipo;
}else{
	header("Refresh: 0;url=index.php");
	echo "<script>alert('Usuário ou senha inválidos')</script>";
}//else
	
?>