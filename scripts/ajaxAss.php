<?php
session_start();

require_once("../dbscripts/config.php");
require_once("../dbscripts/connect.php");
require_once("../dbscripts/database.php");

$user = $_SESSION['user'];
$sw   = $_SESSION['sw']; 

//Valida usuário
$acesso = DBRead('funcionario', "WHERE email='$user' AND senha='$sw'");
if ($acesso == true){
	foreach ($acesso as $dt){
			$nome  = $dt['nome'];
			$email = $dt['email'];
            $id_func = $dt['id_func'];
		}
}

else{
	header("Refresh: 0;url=index.php");
	echo "<script>alert('Usuário ou senha inválidos')</script>";
}

####################################### FIM CABEÇALHO PADRÃO #############################################

$id_rm = $_GET['id_rm'];
$chave = array('id_rm'=>$id_rm, 'id_func'=>$id_func ,'ass' => md5($_GET['chave']));
//$assinar = DBUpdate('rm', $chave, "id_rm = $id_rm");
$assinar = DBGrava('assinatura', $chave);
echo('sucesso');
?>