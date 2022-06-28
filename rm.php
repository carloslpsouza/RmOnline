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
    <title>RM Online - RM</title>
</head>
<?php
require_once("./dbscripts/config.php");
require_once("./dbscripts/connect.php");
require_once("./dbscripts/database.php");

$user = $_SESSION['user'];
$sw   = $_SESSION['sw']; 
$id_rm = $_GET['rm'];

//Valida usuário
$acesso = DBRead('funcionario', "WHERE email='$user' AND senha='$sw'");
if ($acesso == true){
	foreach ($acesso as $dt){
			$nome  = $dt['nome'];
			$email = $dt['email'];
            $id_func = $dt['id_func'];
            $id_setor = $dt['id_setor'];
		}
}

else{
	header("Refresh: 0;url=index.php");
	echo "<script>alert('Usuário ou senha inválidos')</script>";
}

####################################### FIM CABEÇALHO PADRÃO #############################################
?>

<body onload="removeButton()">

    <?php
    $busca_setor = DBRead('setor', "WHERE id_setor='$id_setor'");
    if ($busca_setor == true){
        foreach ($busca_setor as $dt_setor){
            $setor = $dt_setor['descricao'];
        }
    }


    $busca_rm = DBRead('rm', "WHERE id_rm='$id_rm'");
    //var_dump($busca_rm);
    if ($busca_rm == true){
        foreach ($busca_rm as $dt_rm){
    			
			if($dt_rm['tipo'] == 'Emergencial'){
				$tipo = "<div style='color:red'><strong>".$dt_rm['tipo']."</strong></div>";
			}else{
				$tipo = "<div style='color:black'><strong>".$dt_rm['tipo']."</strong></div>";
			}
    ?>

    <div class="conteiner">
    <table cellspacing="0" border="0">
	<colgroup width="38"></colgroup>
	<colgroup width="59"></colgroup>
	<colgroup width="46"></colgroup>
	<colgroup width="125"></colgroup>
	<colgroup width="348"></colgroup>
	<colgroup width="68"></colgroup>
	<colgroup width="103"></colgroup>
	<colgroup width="95"></colgroup>
	<colgroup width="110"></colgroup>
	<tr>
		<td style="border: 1px solid #000000;" colspan=5 height="59" align="center" valign=middle><img src="./img/logo-concer.png" width=88 height=50 hspace=28 vspace=5><b><font size=5 color="#000000">REQUISI&Ccedil;&Atilde;O DE MATERIAIS
		</font></b></td>
		<td style="border: 1px solid #000000;" colspan=4 align="center" valign=bottom><font color="#000000">PRIORIDADE:<?php print($tipo); ?></font></td>
		</tr>
	<tr>
		<td style="border: 1px solid #000000;" colspan=5 height="33" align="center" valign=middle><font color="#000000">N&ordm;.: <strong><?php print(str_pad($id_rm, 4, "0", STR_PAD_LEFT)); ?></strong></font></td>
		<td style="border: 1px solid #000000;" colspan=3 align="left" valign=middle><font color="#000000">CUSTO GERENCIAL: </font><strong><?php print($dt_rm['c_custo']); ?></strong></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><font color="#000000">DATA</font></td>
	</tr>
	<tr>
		<td style="border: 1px solid #000000;" colspan=4 height="34" align="left" valign=middle><font color="#000000">REQUISITANTE: </font><strong><?php print($nome); ?></strong></td>
		<td style="border: 1px solid #000000;" align="left" valign=middle><font color="#000000">&Aacute;REA: </font><strong><?php print($setor); ?></strong></td>
		<td style="border: 1px solid #000000;" colspan=3 align="left" valign=middle><font color="#000000">CUSTO CONTRATUAL</font></td>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><font color="#000000"><?php print($dt_rm['data']); ?></font></td>
	</tr>
	<tr>
		<td style="border: 1px solid #000000;" height="80" align="center" valign=middle><font color="#000000">ITEM</font></td>
		<td style="border: 1px solid #000000;" align="center" valign=middle><font color="#000000">QUANT.</font></td>
		<td style="border: 1px solid #000000;" align="center" valign=middle><font color="#000000">UNID.</font></td>
		<td style="border: 1px solid #000000;" align="center" valign=middle><font color="#000000">C&Oacute;DIGO</font></td>
		<td style="border: 1px solid #000000;" align="center" valign=middle><font color="#000000">DESCRI&Ccedil;&Atilde;O DO MATERIAL</font></td>
		<td style="border: 1px solid #000000;" align="center" valign=middle><font color="#000000">ENTREGA PARCIAL</font></td>
		<td style="border: 1px solid #000000;" align="center" valign=middle><font color="#000000">ASSINATURA REQUISITANTE</font></td>
		<td style="border: 1px solid #000000;" align="center" valign=middle><font color="#000000">ENTREGA SALDO TOTAL</font></td>
		<td style="border: 1px solid #000000;" align="center" valign=middle><font color="#000000">ASSINATURA REQUISITANTE</font></td>
	</tr>
    <?php
        $busca_itens = DBRead('solicita', "WHERE id_rm='$id_rm'");

            if ($busca_itens == true){
				$busca_ass = DBRead('assinatura', "WHERE id_rm='$id_rm' AND id_func='$id_func'");
                $assinatura_g = isset($busca_ass[0]['id_assinatura'])?"<div  style='text-align:center'><strong>".$busca_ass[0]['ass']."<strong></div>":' Não assinado';
				foreach ($busca_itens as $dt){
                    print('
                    
	<tr>
		<td style="border: 1px solid #000000;" height="27" align="center" valign=middle sdval="1" sdnum="1033;"><font color="#000000">1</font></td>
		<td style="border: 1px solid #000000;" height="27" align="center" valign=middle><font color="#000000"></font>'.$dt['qtde'].'</td>
		<td style="border: 1px solid #000000;" height="27" align="center" valign=middle ><font color="#000000"></font>'.$dt['unidade'].'</td>
		<td style="border: 1px solid #000000;" height="27" align="center" valign=middle ><font color="#000000"></font></td>
		<td style="border: 1px solid #000000;" height="27" align="center" valign=middle ><font color="#000000"></font>'.$dt['descricao'].'</td>
		<td style="border: 1px solid #000000;" height="27" align="center" valign=middle ><font color="#000000"></font></td>
		<td style="border: 1px solid #000000;" height="27" align="center" valign=middle ><font color="#000000"></font></td>
		<td style="border: 1px solid #000000;" height="27" align="center" valign=middle ><font color="#000000"></font></td>
		<td style="border: 1px solid #000000;" height="27" align="center" valign=middle ><font color="#000000"></font></td>
	</tr>
            ');
        }
    }
    ?>
	<tr>
		<td style="border: 1px solid #000000;" colspan=4 rowspan=2 height="54" align="left" valign=top><font color="#000000">ASS REQUISITANTE</font></td>
		<td style="border: 1px solid #000000;" rowspan=2 align="left" valign=top><font color="#000000">ASS AUTORIZA&Ccedil;&Atilde;O<br/><div id="ass"><?php print($assinatura_g." "); ?></div><button id="btn_ass" onclick="assinar(<?php echo($id_rm); ?>)"> Assinar</button></font></td>
		<td style="border: 1px solid #000000;" colspan=4 rowspan=2 align="left" valign=top><font color="#000000">ASS ALMOXARIFADO</font></td>
		</tr>
	<tr>
	</tr>
	<tr>
		<td height="10" align="left" valign=bottom><font color="#000000" style="font-size: 8px;">1&ordf; VIA (REQUISITANTE)</font></td>
		<td align="left" valign=bottom><font color="#000000" style="font-size: 8px;">2&ordf; VIA (ALMOXARIFADO)</font></td>
		<td align="left" valign=bottom><font color="#000000" style="font-size: 8px;">3&ordf; Via (COMPRAS)</font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><a href="#">histórico</a></font></td>
		<td align="left" valign=bottom><font color="#000000"><a href="./painel.php">voltar</a></font></td>
	</tr>
</table>

    <?php
            }
        }//foreach rm
    ?>

    </div>
	<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="./js/scripts.js"></script>

</body>
</html>