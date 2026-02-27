//PEÇAS 
$('#del-peca').click(function() {

    dados = $('#form-index').serialize();

    if(dados == '' || dados == null) {
        modalAlerta('Atenção', 'Por favor, selecione ao menos uma peça para excluir.', 'alerta');
    } else {
        operacao = 'deletar_peca';
        $('#form-index').submit();
    }
});

$('#form-index').submit((e) => {

    e.preventDefault();

    if (operacao == 'deletar_peca' && confirmarExclusao() == true) {
        $.ajax({
            method: "POST",
            url: "/delete_peca",
            dataType: "json",
            data: dados,
            complete: function (response) {
                if (response.resultado_operacao != undefined) {
                    if (response.responseJSON.resultado_operacao == true) {
                        modalAlerta("Sucesso", 'Peça(s) ID(s) '+ response.responseJSON.ids_operacao +' excluída(s) com sucesso!', "alerta")
                    } else {
                        modalAlerta('Erro', 'Erro ao excluir Peça(s) ID(s) '+ response.responseJSON.ids_operacao + '. Provavelmente essas peças estão sendo usadas por outra tabela.', 'alerta');
                    }
                } else {
                    modalAlerta('Erro', response.responseText, 'alerta');
                }
            }
        })
    }
})

//CAIXAS
$(document).on('click', '#salvar-apagar', () => {

    dados = $('#form-todas-caixas').serialize();

    if(dados.indexOf("caixa") <= 0) {
        modalAlerta('Atenção', 'Por favor, selecione ao menos uma caixa para apagar.', 'alerta');
    } else {
        $('#form-todas-caixas').submit();
    }
})

$(document).on('submit', '#form-todas-caixas', (e) => {

    e.preventDefault();

    if($('#operacao').val() == 'apagar' && confirmarExclusao() == true) {

        $.ajax({
            method: "POST",
            url: "/delete_caixa",
            dataType: "json",
            data: dados,
            complete: function(response) {
                if (response.responseJSON.resultado_operacao == true) {

                    modalAlerta('Sucesso', 'Caixa(s) ID(s) '+ response.responseJSON.ids_operacao +' excluída(s) com sucesso!', 'alerta')
                } else {

                    modalAlerta('Erro', 'Erro ao excluir Caixas(s) ID(s) '+ response.responseJSON.ids_operacao + '. Provavelmente essas caixas estão sendo usadas por outra tabela.', 'alerta');
                }
            }
        });
    }
});

function confirmarExclusao()
{
    let confirmacao = confirm('Confirma exclusão?');
    return confirmacao;
}

$(document).on('click', '#excluir-img-atual', (e) => {

    let id_peca = $('#oldId').val();

    if (confirmarExclusao() == true) {

        let dados = new FormData;
        dados.append('id_img', id_peca);

        $.ajax({
            method: "POST",
            url: "/delete_img",
            dataType: "json",
            data: dados,
            processData: false,
            contentType: false,
            complete: function(response) {
                if(response.responseJSON.resultado_operacao == true) {

                    modalAlerta('Sucesso', 'Imagem excluída com sucesso!', 'alerta');
                    $('#fotoPeca span').text('Imagem atual: Nenhuma imagem');
                    $('#excluir-img-atual').prop('disabled', 'true');
                } else {
                    modalAlerta('Erro', 'Erro ao excluir imagem.', 'alerta');
                }
            }
        });
    }
})