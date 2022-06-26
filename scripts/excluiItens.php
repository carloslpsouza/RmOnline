<?php
session_start();

if(isset($_GET['exclui'])){
    $idx = $_GET['idx'];
    $pag = $_GET['pag'];
    if($_SESSION['cont'] > 0){
        $_SESSION['cont']    -=1;
    }    
    unset($_SESSION['itens'][$idx]);
    print_r($_SESSION);
    header('Location: ../'.$pag.'.php');
}


?>