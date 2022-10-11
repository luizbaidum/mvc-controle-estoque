var dados = null;
//PEÇAS 
$('#del-peca').click(function() {
    
    dados = $('#form-index').serialize();

    if(dados == '' || dados == null) {
        alert('Por favor, selecione ao menos uma peça para excluir.');
    } else {
        $('#form-index').submit();
    }
});

$('#form-index').submit((e) => {

    e.preventDefault();

    $.ajax({
        method: "POST",
        url: "/delete_peca",
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

//CAIXAS
$(document).on('click', '#salvar-apagar', () => {

    dados = $('#form-apagar-caixas').serialize();

    if(dados == '' || dados == null) {
        alert('Por favor, selecione ao menos uma caixa para excluir.');
    } else {
        $('#form-apagar-caixas').submit();
    } 
})

$(document).on('submit', '#form-apagar-caixas', (e) => {
    
    e.preventDefault();

    $.ajax({
        method: "POST",
        url: "/delete_caixa",
        dataType: "json",
        data: dados,
        success: function(response) {
            if(response.resultado_operacao == true) {

                alert('Caixa(s) ID(s) '+ response.ids_operacao +' excluída(s) com sucesso!')
                window.location.href = "/";
            } else {

                alert('Erro ao excluir Caixas(s) ID(s) '+ response.ids_operacao + '. Por favor, tente novamente');
            }
        }
    });
});