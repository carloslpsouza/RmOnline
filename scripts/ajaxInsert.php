<?php
session_start();

require_once("../dbscripts/config.php");
require_once("../dbscripts/connect.php");
require_once("../dbscripts/database.php");

$user  = $_SESSION['user'];
$sw    = $_SESSION['sw'];

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
if(isset($_GET['grava'])){
	$dados_rm = array('tipo' => $_POST['tipo'], 'estado' =>  'Solicitado', 'c_custo' => $_POST['c_custo'], 'id_func' =>  $_POST['id_func'], 'id_setor' =>  $_POST['id_setor'] );
	$id_nova_rm = DBGrava('rm', $dados_rm, true);
	

	$itens = $_SESSION['itens'];
	foreach($itens as $its){
		$its['id_rm'] = $id_nova_rm;
		DBGrava('solicita', $its);
	}
	echo("<script>alert('Gravado com sucesso')</script>");
	header('Location: ./limpaItens.php');
}
echo('sucesso');
?>