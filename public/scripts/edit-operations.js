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

//CAIXAS
$('#prepara-edit-peca').click((e) => {

    dados = $('#form-index').serialize();

    if($("[type='checkbox']:checked").length != 1) {
        alert('Por favor, selecione UMA peça para editar.');
    } else {
        $('#form-index').submit();
    }
});

$('#form-index').submit((e) => {

    e.preventDefault();

    $.ajax({
        method: "POST",
        url: "/prepara_edit_peca",

        //continuar daqui passar os dados e chamar a pagina
        dataType: "json",
        data: dados,
        success: function(response) {
            if(response.resultado_operacao == true) {

                alert('Peça(s) ID(s) '+ response.ids_operacao +' excluída(s) com sucesso!')
                window.location.href = "/";
            } else {

                alert('Erro ao excluir Peça(s) ID(s) '+ response.ids_operacao + '. Por favor, tente novamente');
            }
        }
    })
})