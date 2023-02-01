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

                modalAlerta("Sucesso", "Caixa ID " + response.responseJSON.id_operacao + " inserida com sucesso!", "alerta");
                $('form')[0].reset();
            } else {
                modalAlerta("Erro", "Erro no processo de inserir Caixa ID " + response.responseJSON.id_operacao + ". Verifique se este ID já está cadastrado.", "alerta");
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
            console.log(response);
            if(response.responseJSON.resultado_operacao == true) {

                modalAlerta("Sucesso", "Peca ID " + response.responseJSON.id_operacao + " inserida com sucesso!", "alerta");
                $('form')[0].reset();
            } else {
                modalAlerta("Erro", "Erro no processo de inserir Peca ID " + response.responseJSON.id_operacao + ". Verifique se este ID já está cadastrado.", "alerta");
            }
        }
    })
}