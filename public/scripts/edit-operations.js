//CAIXAS
$(document).on('click', '#preparar-editar', () => {
        
    dados = $('#form-todas-caixas').serialize();

    if(dados.indexOf("caixa") <= 0) {
        alert('Por favor, selecione ao menos uma caixa para editar.');
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