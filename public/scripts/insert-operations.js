function novaCaixa(dados)
{
    $.ajax({
        method: "POST",
        url: "nova_caixa/insert",
        processData: false,
        contentType: false,
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
        success: function(response) {
            if(response.resultado_operacao == true) {

                alert("Peca ID " + response.id_operacao + " inserida com sucesso!");
                $('form')[0].reset();
            } else {
                alert("Erro no processo de inserir Peca ID " + response.id_operacao + ". Verifique se este ID já está cadastrado.");
            }
        }
    })
}