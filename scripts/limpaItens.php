<?php
session_start();
$_SESSION['itens']=NULL;
$_SESSION['cont']=NULL;
header('Location: ../novarm.php');
?>