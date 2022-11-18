//CAIXAS
$(document).on('click', '#preparar-editar', () => {
        
    dados = $('#form-todas-caixas').serialize();

    if(dados.indexOf("caixa") <= 0) {
        alert('Por favor, selecione uma caixa para editar.');
    } else {
        $('#form-todas-caixas').submit();
    }   
})

$(document).on('submit', '#form-todas-caixas', (e) => {

    e.preventDefault();

    if($('#operacao').val() == 'editar') {

    $.ajax({
        method: "POST",
        url: "/preparar_caixa",
        dataType: "json",
        data: dados,
        complete: function(response) {
                tratarDadosModal(response)
            }
        });
    }      
});

function editarCaixa(dados)
{
    $.ajax({
        method: "POST",
        url: "/editar_caixa",
        processData: false,
        contentType: false,
        dataType: "json",
        data: dados,
        success: function(response) {
            if(response.resultado_operacao == true) {

                alert("Caixa ID " + response.id_operacao + " editada com sucesso!");
                window.location.href = "/";
            } else {
                alert("Erro no processo de editar Caixa ID " + response.id_operacao + ".");
            }
        }
    })
}

//PEÇAS
$('#prepara-edit-peca').click((e) => {

    dados = $('#form-index').serialize();

    if($("[type='checkbox']:checked").length != 1) {
        alert('Por favor, selecione UMA peça para editar.');
    } else {
        operacao = 'editar_peca';
        $('#form-index').submit();
    }
});

$('#form-index').submit((e) => {

    e.preventDefault();

    if(operacao == 'editar_peca') {

        $.ajax({
            method: "POST",
            url: "/prepara_edit_peca",
            dataType: "json",
            data: dados,
            complete: function(response) {
                tratarDadosPagina(response)
            }
        })
    }
})

function editarPeca(dados)
{
    $.ajax({
        method: "POST",
        url: "/editar_peca",
        processData: false,
        contentType: false,
        dataType: "json",
        data: dados,
        complete: function(response) {
            let resposta = response.responseJSON;
            if(resposta.resultado_operacao == true) {

                alert("Peça ID " + resposta.id_operacao + " editada com sucesso!");
                window.location.href = "/";
            } else {
                alert("Erro no processo de editar Peça ID " + resposta.id_operacao + ".");
            }
        }
    })
}

function baixarPeca(dados)
{
    $.ajax({
        method: "POST",
        url: "/baixar_peca",
        processData: false,
        contentType: false,
        dataType: "json",
        data: dados,
        complete: function(response) {
            let ids = response.responseJSON.id_operacao.toString();
            if(response.responseJSON.resultado_operacao == true) {
                alert("Peça(s) ID " + ids + " baixada(s) com sucesso!");
                window.location.href = "/";
            } else {
                alert("Erro no processo de baixar Peça(s) ID " + ids + ".");
            }
        }
    })
}