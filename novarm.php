<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <title>RM Online - Nova RM</title>
</head>
<?php
require_once("./dbscripts/config.php");
require_once("./dbscripts/connect.php");
require_once("./dbscripts/database.php");
require_once("./icons.php");

$user = $_SESSION['user'];
$sw   = $_SESSION['sw'];
//if(isset($_GET['rm'])){
//    $id_rm = $_GET['rm'];
//}

//Valida usuário
$acesso = DBRead('funcionario', "WHERE email='$user' AND senha='$sw'");
if ($acesso == true){
	foreach ($acesso as $dt){
			$nome     = $dt['nome'];
			$email    = $dt['email'];
            $id_func  = $dt['id_func'];
            $id_setor = $dt['id_setor'];
		}
}

else{
	header("Refresh: 0;url=index.php");
	echo "<script>alert('Usuário ou senha inválidos')</script>";
}

####################################### FIM CABEÇALHO PADRÃO #############################################

if(!isset($_SESSION['cont'])){
    $_SESSION['cont'] = 0;
}

if(isset($_POST['unidade'])){
    $qtde  = $_POST['qtde'];
    $unid  = $_POST['unidade'];
    $cod   = $_POST['codigo'];
    $desc  = $_POST['descricao'];
    $id_rm = '';
    $_SESSION['itens'][$_SESSION['cont']] = array('qtde' => $qtde, 'unidade' => $unid, 'codigo' => $cod, 'descricao' => $desc, 'id_rm' =>'0');
    if($_SESSION['cont']>=0){
        $_SESSION['cont']+=1;
    }
}
//var_dump($_SESSION['itens']);
?>
<body>
<div class="conteiner">
    <form action="" method="post" class="form-itens-rm">
        <input type="number" id="qtde" name="qtde" placeholder="Quantidade" required/>
        <select id="unidade" name="unidade" required>
            <option value="UN">UN</option>
            <option value="pct">Pacote</option>
            <option value="m">Metros</option>
        </select>
        <input type="number" name="codigo" placeholder="codigo"/>
        <input type="text" id="descricao" name="descricao" placeholder="descrição" required/>
        <button class="btn btn-success">Salvar</button>
        
        
    </form>    
        <div  class="tabela flexivel">
        <div class="linha" style="background-color:#fff">
            <div class="titulo_coluna" style='width: 50px;'>ITEM</div>
            <div class="titulo_coluna" style='width: 50px;'>QTDE</div>
            <div class="titulo_coluna" style='width: 100px;'>UNID.</div>
            <div class="titulo_coluna" style='width: 100px;'>CÓDIGO</div>
            <div class="titulo_coluna" style='width: 400px;'>DESCRIÇÃO</div>
            <div class="coluna"><a href="./u">voltar</a></div>
        </div>
        <hr>
        <?php
        
        if(isset($_SESSION['itens'])){
            foreach($_SESSION['itens'] as $key => $it){
                //var_dump($key);
            ?>
            <div class="linha">
                <div class="coluna" id="item" style='width: 50px;'><?php echo($key) ?></div>
                <div class="coluna" id="qtde" style='width: 50px;'><?php echo($it['qtde']) ?></div>
                <div class="coluna" id="Unid" style='width: 100px;'><?php echo($it['unidade']) ?></div>
                <div class="coluna" id="cod"  style='width: 100px;'><?php echo($it['codigo']) ?></div>
                <div class="coluna" id="desc" style='width: 400px;'><?php echo($it['descricao']) ?></div>
                <div class='coluna'><a href="./scripts/excluiItens.php?exclui=true&idx=<?php echo($key);?>&pag=novarm"><?php print($trash); ?></a></div>
            </div>
        <?php

            }
        }
        
        ?>
        <hr>
        <form form action="./scripts/ajaxInsert.php?grava=true" method="post" >
            <div class="linha" style="background-color:#fff;">
                <div class="coluna">
                    <label for="radio-normal" class="radio-inline">
                    <input type="radio" id="radio-normal" name="tipo" value="Normal" style="margin-top:-2px" required/>
                    Normal</label>
                </div>
                <div class="coluna">
                    <label for="radio-emerg" class="radio-inline">
                    <input type="radio" id="radio-emerg" name="tipo" value="Emergencial" style="margin-top:-2px"  required/>
                    Emergencial</label>        
                </div>
                <div class="coluna">
                <label for="c_custo"  style="margin-top:-20px">Centro de custo: 
                <select id="c_custo" name="c_custo" style="margin-top:20px" required  class="radio-inline">
                <?php
                    $busca_ccusto = DBRead('setor');
                    foreach($busca_ccusto as $cc){
                        print("<option value=".$cc['c_custo'].">".$cc['c_custo']."</option>");
                    }
                ?>
                </select></label>
                </div>
                <input type="text" style="display:none" name="id_func" value="<?php print($id_func); ?>"/>
                <input type="text" style="display:none" name="id_setor" value="<?php print($id_setor); ?>"/>
                
                <div class="coluna"><a href="ajaxInsert.php?grava=true"  ><button class="btn btn-success">Gravar</button></a><a href="sessionDestroy.php"><button class="btn btn-danger">Cancelar</button></a></div>
            </div>
        </form>
    </div>
</div>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>