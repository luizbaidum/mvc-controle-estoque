//CAIXAS
$(document).on('click', '#ir-editar', () => {
        
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
        url: "/prepara_caixa",
        dataType: "json",
        data: dados,
        complete: function(response) {
            tratarDadosPagina(response)
        }
        });
    }      
});

//EDITAR CAIXA----------------------------
$('#salvar').on('click', (e) => {

    if($('#operation').val() == 'editar_caixa') {

        console.log('aqui porra')

        /*$.ajax({
            method: "POST",
            url: "nova_caixa/insert",
            dataType: "json",
            data: dados,
            success: function(response) {
                if(response.resultado_operacao == true) {

                    alert("Caixa ID " + response.id_operacao + " inserida com sucesso!");
                    $('form')[0].reset();
                } else {
                    alert("Erro no processo de inserir Caixa ID " + response.id_operacao + ". Verifique se este ID já está cadastrado.");
                }
            }
        })*/
    };
})