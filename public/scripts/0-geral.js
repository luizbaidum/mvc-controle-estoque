var dados = null;
/****************************************************/
$('#cancelar').on('click', () => {

    window.location.replace("/");
})
/****************************************************/
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
/****************************************************/
$('.listar-caixas').on('click', (e) => {

    //operação p/ capturar o innerText do botão que o usuário clica e transformar isso no modal que se quer abrir
    let pai = e.target.parentElement.parentElement.innerText;

    if(pai.indexOf('Apagar') == 0) {
        operacao = 'apagar';
    } else if(pai.indexOf('Editar') == 0) {
        operacao = 'editar';
    }

    $.ajax({
        method: "GET",
        url: "/todas_caixas",
        dataType: "json",
        data: {operacao: operacao},
        complete: function(response) {
            tratarDados(response);
        }
    })
})

function tratarDados(response) 
{
    dados_modal = response.responseText;
    abrirModal(dados_modal);
}

function abrirModal(conteudo) 
{
    $(".modal-content").html(conteudo);
    $('#id-modal-form').modal('show');
}
/****************************************************/