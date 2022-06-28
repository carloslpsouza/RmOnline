function assinar(rm){
    var cpf = prompt('Digite seu CPF: ');
    //confirm('Tem certeza que quer assinar esta RM?')
    var dados = cpf+rm.toString();
    $.ajax({
        url: './scripts/ajaxAss.php',
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

function criaRm(itens, rm){
    $.ajax({
        url: './ajaxInsert.php',
        method: 'GET',
        data: {dados:itens, id_rm:rm}
    }).done(function(resposta){
        console.log(resposta)
        location.reload();
    });
}

function excluiItem(variavel){
    $.ajax({
        url: './excluiItem.php',
        method: 'GET',
        data: {dados:variavel}
    }).done(function(resposta){
        console.log(resposta)
        location.reload();
    });
}
