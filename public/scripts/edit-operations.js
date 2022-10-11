//CAIXAS
$(document).on('click', '#salvar-editar', () => {

    dados = $('#form-editar-caixas').serialize();

    if(dados == '' || dados == null) {
        alert('Por favor, selecione ao menos uma caixa para editar.');
    } else {
        $('#form-editar-caixas').submit();
    } 
})

$(document).on('submit', '#form-editar-caixas', (e) => {
    
    e.preventDefault();

    $.ajax({
        method: "POST",
        url: "/editar_caixa",
        dataType: "json",
        data: dados,
        //success: /function(response) {
            /*if(response.resultado_operacao == true) {

                alert('Caixa(s) ID(s) '+ response.ids_operacao +' excluída(s) com sucesso!')
                window.location.href = "/";
            } else {

                alert('Erro ao excluir Caixas(s) ID(s) '+ response.ids_operacao + '. Por favor, tente novamente');
            }
        }
    */ });
});

//atenção: a pagina q exibe as infos da caixa é uma coisa e a function q edita a caixa no bd é outra coisa. arrumar isso