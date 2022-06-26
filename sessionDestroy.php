<?php
session_start();

if(isset($_GET['exclui'])){
    $idx = $_GET['idx'];
    $pag = $_GET['pag'];
    unset($_SESSION['itens'][$idx]);
    header('Location: ./'.$pag.'.php');
}

if(isset($_GET['logoff'])){
    $idx = $_GET['idx'];
    $pag = $_GET['pag'];
    unset($_SESSION['itens'][$idx]);
    header('Location: ./'.$pag.'.php');
}
//$_SESSION['carrinho']=NULL;
$_SESSION['itens']=NULL;
$_SESSION['cont']=NULL;
header('Location: ./novarm.php');
?>