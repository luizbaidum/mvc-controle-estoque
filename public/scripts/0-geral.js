$('#cancelar').on('click', () => {

    window.location.replace("/");
})

//Formata valores para br_R$
$('#vlrCompraPeca').on('keyup', () => {

    let valor = $('#vlrCompraPeca').val();

    valor = valor + '';
    valor = parseInt(valor.replace(/[\D]+/g, ''));
    valor = valor + '';
    valor = valor.replace(/([0-9]{2})$/g, ",$1");

    if (valor.length > 6) valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

    $('#vlrCompraPeca').val(valor);
    if(valor == 'NaN') $('#vlrCompraPeca').val('');
})

$('#del-caixa').on('click', () => {

    $.ajax({
        method: "POST",
        url: "/todas_caixas",
        dataType: "json",
        complete: function(response) {
            tratarDados(response);
        }
    })
})

function tratarDados(response) {

    dados_modal = response.responseText;

    abrirModal(dados_modal);
}

function abrirModal(conteudo) 
{
    $(".modal-content").html(conteudo);
    $('#id-modal-form').modal('show');
}