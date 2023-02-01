var dados = null;
var operacao = null;
var pesquisa_item = null;
var pesquisa_obj = null; 
/****************************************************/
$('#salvar').on('click', (e) => {    
    e.preventDefault();
    scriptDeSalvar();
})    

$(document).on('click','#salvar-editar', (e) => {    
    e.preventDefault();
    let modal = $('#form-editar-caixa');
    scriptDeSalvar(modal);
})    
/****************************************************/
function scriptDeSalvar(modal) 
{
    let elementos = null;

    let formulario = null;

    elementos = $('form').find('*');

    formulario = document.querySelector('form');

    if(modal != undefined) {
        elementos = modal.find('*');
        formulario = document.getElementById('form-editar-caixa');
    }

    //VALIDAÇÃO DE CAMPOS REQUIRED----------
    let requeridos = [];

    elementos.each(function(key, elemento) {

        if(elemento.hasAttribute('required')) {

            if(elemento.value == '' || elemento.value == undefined || elemento.value == null) {
                requeridos.push(elemento);
            }
        }
    });

    if(requeridos.length>0) {
        modalAlerta('Atenção', 'Existem campos obrigatórios NÃO preenchidos', 'alerta');
        return;
    }   

    dados = new FormData(formulario);

    if($('#operation').val() == 'nova_caixa') {
        novaCaixa(dados);
    } else if ($('#operation').val() == 'nova_peca') {
        novaPeca(dados);
    } else if($('#operation').val() == 'editar_caixa') {
        editarCaixa(dados);
    } else if($('#operation').val() == 'editar_peca') {
        editarPeca(dados);
    } else if($('#operation').val() == 'baixar_peca') {
        baixarPeca(dados);
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

    if(pai.indexOf('Apagar') == 0)
        operacao = 'apagar';

     else if(pai.indexOf('Editar') == 0) 
        operacao = 'preparar-editar';

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
    $("#id-modal-form .modal-content").html(conteudo);
    $('#id-modal-form').modal('show');
    aplicarR$();
}

function tratarDadosPagina(response)
{
    dados_pagina = response.responseText;
    carregarPagina(dados_pagina);
}

function carregarPagina(conteudo) 
{
    $('body').html(conteudo);
    aplicarR$();
}

function tratarDadosTable(response)
{
    dados_table = response.responseText;
    carregarTable(dados_table);
}

function carregarTable(conteudo) 
{
    $('tbody').html(conteudo);
    aplicarR$();
}
/****************************************************/
$('#form-pesquisar').on('submit', (e) => {

    e.preventDefault();

    dados = $('#form-pesquisar').serialize();

    pesquisa_item = $('select[name="base-pesquisa"]').prop('value');
    pesquisa_obj = $('input[name="item-pesquisa"]').prop('value');

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
/****************************************************/
$('.ordenar').click((e) => {

    dados = {
        order_by: $(e.target).text(),
        pesquisa_item: pesquisa_item,
        pesquisa_obj: pesquisa_obj
    };

    $.ajax({
        method: "POST",
        url: "/ordenar",
        dataType: "json",
        data: dados,
        complete: function(response) {
            tratarDadosTable(response);
        }
    })
})
/****************************************************/
$('#baixar').click(() => {

    dados = $('#form-index').serialize();

    if($("[type='checkbox']:checked").length < 1)
        modalAlerta('Erro', 'Por favor, selecione pelo menos uma peça para baixar.', 'alerta');
    else
        prepararBaixa(dados);
});

function prepararBaixa()
{
    $.ajax({
        method: "GET",
        url: "/preparar_baixa",
        dataType: "json",
        data: dados,
        complete: function(response) {
            tratarDadosPagina(response)
        }
    })
}
/****************************************************/
$('.input-data').keyup((e) => {

    var v=e.target.value.replace(/\D/g,"");

    v=v.replace(/(\d{2})(\d)/,"$1/$2");
    v=v.replace(/(\d{2})(\d)/,"$1/$2");
    e.target.value = v;
})
/****************************************************/
$(document).on('click', '.carregar-foto', (e) => {

    let id_peca = $(e.target).closest('tr').find('.pecas').val();

    let nome_foto = $(e.target).closest('tr').find('.foto-peca').val();

    $.ajax({
        method: "POST",
        url: "/carregar_foto_peca",
        dataType: "json",
        data: {
            peca: id_peca,
            foto: nome_foto
        },

        complete: function(response) {
            tratarDadosModal(response);
        }
    })
})
/****************************************************/
$(document).ready(function() {
    aplicarR$();
    $('.select2').select2();
})

function aplicarR$()
{
    $(document).find('.vlr-compra-peca').each((index, item) => {

        let vlr1 = $(item).text();
        let vlr2 = vlr1.replace('.',',').replace('R$ ', '');
        $(item).text('R$ '+vlr2);
    });
}
/****************************************************/
function modalAlerta(titulo, texto, tipo)
{
    $('#id-modal-alerta').modal('show');

    $('#modal-alerta-content .modal-title').text(titulo);
    $('#modal-alerta-content .modal-body').text(texto);

    if (tipo == "alerta")
        $('#modal-alerta-content #response').remove();

    if (tipo == "response")
        $('#modal-alerta-content #alerta').remove();
}

$("#id-modal-alerta").on('show.bs.modal', function (e) {
    $("#id-modal-form").modal("hide");
});