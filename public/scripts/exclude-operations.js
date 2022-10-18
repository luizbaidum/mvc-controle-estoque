//PEÇAS 
$('#del-peca').click(function() {
    
    dados = $('#form-index').serialize();

    if(dados == '' || dados == null) {
        alert('Por favor, selecione ao menos uma peça para excluir.');
    } else {
        operacao = 'deletar_peca';
        $('#form-index').submit();
    }
});

$('#form-index').submit((e) => {

    e.preventDefault();

    if(operacao == 'deletar_peca') {
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
    }
})
//CAIXAS
$(document).on('click', '#salvar-apagar', () => {

    dados = $('#form-todas-caixas').serialize();

    if(dados.indexOf("caixa") <= 0) {
        alert('Por favor, selecione ao menos uma caixa para apagar.');
    } else {
        $('#form-todas-caixas').submit();
    }
})

$(document).on('submit', '#form-todas-caixas', (e) => {

    e.preventDefault();

    if($('#operacao').val() == 'apagar') {

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
    }
});