function novaCaixa(dados)
{
    $.ajax({
        method: "POST",
        url: "nova_caixa/insert",
        processData: false,
        contentType: false,
        dataType: "json",
        data: dados,
        complete: function(response) {
            if(response.responseJSON.resultado_operacao == true) {

                alert("Caixa ID " + response.responseJSON.id_operacao + " inserida com sucesso!");
                $('form')[0].reset();
            } else {
                alert("Erro no processo de inserir Caixa ID " + response.responseJSON.id_operacao + ". Verifique se este ID já está cadastrado.");
            }
        }
    })
}     

function novaPeca()
{
    $.ajax({
        method: "POST",
        url: "nova_peca/insert",
        processData: false,
        contentType: false,
        dataType: "json",
        data: dados,
        complete: function(response) {
            if(response.responseJSON.resultado_operacao == true) {

                alert("Peca ID " + response.responseJSON.id_operacao + " inserida com sucesso!");
                $('form')[0].reset();
            } else {
                alert("Erro no processo de inserir Peca ID " + response.responseJSON.id_operacao + ". Verifique se este ID já está cadastrado.");
            }
        }
    })
}