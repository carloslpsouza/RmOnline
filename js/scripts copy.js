function montaArray(){
    var qtde = document.getElementById('qtde').innerText;
    var unidade = document.getElementById('unidade').value;
    var cod = document.getElementById('cod').innerText;
    var desc = document.getElementById('desc').innerText;
    item_linha = [qtde, unidade, cod, desc];
    abrecampo(item_linha);
}

var cont = 0;
const itens_rm = [];
function abrecampo(itens){
    itens_rm.push(itens);
    console.log(itens_rm);
    escreveHtml(itens_rm);
}

var todosCampos = []
function escreveHtml(itens){
    var temp = document.getElementById('temp');
    var item = (cont+1).toString().padStart(4, '0');
    var campos = "<div class='linha'><div class='coluna' style='width: 50px;'>"+item+"</div><div class='coluna' style='width: 50px;'>"+itens[cont][0]+"</div><div class='coluna' style='width: 100px;'>"+itens[cont][1]+"</div><div class='coluna' style='width: 100px;'>"+itens[cont][2]+"</div><div class='coluna' style='width: 400px;'>"+itens[cont][3]+"</div></div>";
    
    $("#add_campos").click(function(){
        $("#temp").html(campos);
    });
    todosCampos.push(campos);
    temp.style.removeProperty = 'display';
    cont += 1;
}

function assinar(rm){
    var cpf = prompt('Digite seu CPF: ');
    //confirm('Tem certeza que quer assinar esta RM?')
    var dados = cpf+rm.toString();
    $.ajax({
        url: './ajaxAss.php',
        method: 'GET',
        data: {chave:dados, id_rm:rm}
    }).done(function(resposta){
        console.log(resposta)
        location.reload();
    });
}

function removeButton(){
    var assinatura = document.getElementById('ass').innerText;
    if(assinatura != 'Não assinado'){
        var botao = document.getElementById('btn_ass');
        botao.remove();
    }
    
}

function insereItem(itens, rm){
    $.ajax({
        url: './ajaxInsert.php',
        method: 'GET',
        data: {dados:itens, id_rm:rm}
    }).done(function(resposta){
        console.log(resposta)
        location.reload();
    });
}