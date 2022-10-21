var dados = null;
var operacao = null;
/****************************************************/
$('#salvar').on('click', (e) => {    
    e.preventDefault();
    scriptDeSalvar();
})    

$(document).on('click','#salvar-do-modal', (e) => {    
    e.preventDefault();
    scriptDeSalvar();
})    

function scriptDeSalvar() 
{
    //VALIDAÇÃO DE CAMPOS REQUIRED----------
    let elementos = $('form').find('*');

    let requeridos = [];

    elementos.each(function(key, elemento) {
        
        if(elemento.hasAttribute('required')) {
            
            if(elemento.value == '' || elemento.value == undefined || elemento.value == null) {

                requeridos.push(elemento);
            }
        }
    });

    if(requeridos.length>0) {

        alert('Existem campos obrigatórios NÃO preenchidos.');
        return;
    }    

    let dados = $('form').serialize();

    if($('#operation').val() == 'nova_caixa') {
        novaCaixa(dados);
    } else if ($('#operation').val() == 'nova_peca') {
        novaPeca(dados);
    } else if($('#operation').val() == 'editar_caixa') {
        editarCaixa(dados);
    } else if($('#operation').val() == 'apagar_caixa') {
        apagarCaixa(dados);
    } else if($('#operation').val() == 'editar_peca') {
        editarPeca(dados);
    }
}
/****************************************************/
$('#cancelar').on('click', () => {

    window.location.href = "/";
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
            tratarDadosModal(response);
        }
    })
})
/****************************************************/
function tratarDadosModal(response) 
{
    dados_modal = response.responseText;
    abrirModal(dados_modal);
}

function abrirModal(conteudo) 
{
    $(".modal-content").html(conteudo);
    $('#id-modal-form').modal('show');
}

function tratarDadosPagina(response)
{
    dados_pagina = response.responseText;
    carregarPagina(dados_pagina);
}

function carregarPagina(conteudo) 
{
    $('body').html(conteudo);
}

function tratarDadosTable(response)
{
    dados_table = response.responseText;
    carregarTable(dados_table);
}

function carregarTable(conteudo) 
{
    $('tbody').html(conteudo);
}
/****************************************************/
$('#form-pesquisar').on('submit', (e) => {
    e.preventDefault();

    dados = $('#form-pesquisar').serialize();

    $.ajax({
        method: "POST",
        url: "/pesquisar",
        dataType: "json",
        data: dados,
        complete: function(response) {
            tratarDadosTable(response);
        }
    })
})

$('#sair-pesquisar').on('click', () => {
    window.location.href = "/";
})