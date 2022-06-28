<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <title>RM Online - Painel</title>
</head>
<?php
require_once("./dbscripts/config.php");
require_once("./dbscripts/connect.php");
require_once("./dbscripts/database.php");
require_once("./icons.php");

$user        = $_SESSION['user'];
$sw          = $_SESSION['sw'];
$tipo_sessao = $_SESSION['tipo'];



//Valida usuário
$acesso = DBRead('funcionario', "WHERE email='$user' AND senha='$sw'");
if ($acesso == true){
	foreach ($acesso as $dt){
		$nome     = $dt['nome'];
		$email    = $dt['email'];
        $id_func  = $dt['id_func'];
        $id_setor = $dt['id_setor'];
        $tipo     = $dt['tipo'];
	}
    $setor = DBRead('setor', "WHERE id_setor='$id_setor'", 'descricao');

}else{
	header("Refresh: 0;url=./index.php");
	echo "<script>alert('Usuário ou senha inválidos')</script>";
}

####################################### FIM CABEÇALHO PADRÃO #############################################
?>

<body>
    <div class="conteiner">
        <div class="minhas_rms"><legend>Rms em aberto - <?php print($setor[0]['descricao']." - ".$nome." - "); ?><a href="./logout.php">Sair</a><hr></legend>
            <?php
                //$busca_rm = DBRead('gerencia g', "JOIN funcionario f ON f.id_func = g.id_func JOIN setor s ON s.id_setor = g.id_setor JOIN rm r ON r.id_setor = g.id_setor JOIN assinatura ass WHERE g.id_func = ".$id_func." ");
                $busca_rm = DBRead('rm r', "WHERE id_setor = '$id_setor'");
                if ($busca_rm == true){
                    print("<div class='linha'><div class='titulo_coluna' style='width: 25px;'> RM </div><div class='titulo_coluna' style='width: 200px;'> Data </div><div class='titulo_coluna' style='width: 200px;'> Centro de custo </div><div class='titulo_coluna' style='width: 100px;'> Tipo </div><div class='titulo_coluna' style='width: 200px;'> Aprovação </div><div class='titulo_coluna' style='width: 100px;'> Estado </div></div>");
                    //var_dump($busca_rm);
                    foreach ($busca_rm as $dt){
                        $busca_assinatura = DBRead('assinatura', "WHERE id_rm = ".$dt['id_rm']);
                        if(!$busca_assinatura){
                            if($dt['tipo'] == 'Emergencial'){
                                $tipo_rm = "<div style='color:red'><strong>".$dt['tipo']."</strong></div>";
                            }else{
                                $tipo_rm = "<div style='color:black'>".$dt['tipo']."</div>";
                            }
                            print("<div class='linha'><div class='coluna' style='width: 25px;'><a href='./rm.php?rm=".$dt['id_rm']."'>".$dt['id_rm']."</a></div><div class='coluna' style='width: 200px;'>".$dt['data']."</div><div class='coluna' style='width: 200px;'>".$dt['c_custo']."</div><div class='coluna' style='width: 100px;'>".$tipo_rm."</div><div class='coluna' style='width: 200px;'>Não assinado</div><div class='coluna' style='width: 100px;'> ".$dt['estado']."</div><div class='coluna'>".$trash."</div><div class='coluna'>".$edit."</div></div>");
                        }                        
                    }
                }
                else{
                    print('<div class="linha">Você ainda não possui Rms em aberto</div>');
                }
            ?>
            <div class='linha' style='background-color:#fff'><a href='./novarm.php'><button class="btn btn-success">Nova RM</button></a></div>
            </div>        
        
        <div class="minhas_rms"><legend>Rms assinadas<hr></legend>
        <?php
                $busca_rm = DBRead('rm', "JOIN assinatura as ass ON rm.id_rm = ass.id_rm WHERE rm.id_setor");
                //var_dump($busca_rm);
                if ($busca_rm == true){
                    print("<div class='linha'><div class='titulo_coluna' style='width: 25px;'> RM </div><div class='titulo_coluna' style='width: 200px;'> Data </div><div class='titulo_coluna' style='width: 200px;'> Centro de custo </div><div class='titulo_coluna' style='width: 100px;'> Tipo </div><div class='titulo_coluna' style='width: 200px;'> Aprovação </div><div class='titulo_coluna' style='width: 100px;'> Estado </div></div>");
                    
                    foreach ($busca_rm as $dt){
                        $assinatura_g = isset($dt['ass'])?'Assinado':' Não assinado';
                        if($dt['tipo'] == 'Emergencial'){
                            $tipo_rm = "<div style='color:red'><strong>".$dt['tipo']."</strong></div>";
                        }else{
                            $tipo_rm = "<div style='color:black'>".$dt['tipo']."</div>";
                        }
                        print("<div class='linha'><div class='coluna' style='width: 25px;'><a href='rm.php?rm=".$dt['id_rm']."'>".$dt['id_rm']."</a></div><div class='coluna' style='width: 200px;'>".$dt['data']."</div><div class='coluna' style='width: 200px;'>".$dt['c_custo']."</div><div class='coluna' style='width: 100px;'>".$tipo_rm."</div><div class='coluna' style='width: 200px;'> ".$assinatura_g."</div><div class='coluna' style='width: 100px;'> ".$dt['estado']."</div><div class='coluna'>".$trash."</div><div class='coluna'>".$edit."</div></div>");
                    }
                }else{
                    print('<div class="linha">Você ainda não possui Rms assinadas</div>');
                }
            ?>
        </div>
    </div>
</body>
</html>