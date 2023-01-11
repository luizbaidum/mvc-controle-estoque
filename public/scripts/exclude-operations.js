//PEÇAS 
$('#del-peca').click(function() {

    dados = $('#form-index').serialize();

    if(dados == '' || dados == null) {
        alert('Por favor, selecione ao menos uma peça para excluir.');
    } else {
        operacao = 'deletar_peca';
        $('#form-index').submit();
    }
});

$('#form-index').submit((e) => {

    e.preventDefault();

    if(operacao == 'deletar_peca' && confirmarExclusao() == true) {
        $.ajax({
            method: "POST",
            url: "/delete_peca",
            dataType: "json",
            data: dados,
            complete: function(response) {
                if(response.responseJSON.resultado_operacao == true) {

                    alert('Peça(s) ID(s) '+ response.responseJSON.ids_operacao +' excluída(s) com sucesso!')
                    window.location.href = "/";
                } else {
                    alert('Erro ao excluir Peça(s) ID(s) '+ response.responseJSON.ids_operacao + '. Provavelmente essas peças estão sendo usadas por outra tabela.');
                }
            }
        })
    }
})

//CAIXAS
$(document).on('click', '#salvar-apagar', () => {

    dados = $('#form-todas-caixas').serialize();

    if(dados.indexOf("caixa") <= 0) {
        alert('Por favor, selecione ao menos uma caixa para apagar.');
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
                if(response.responseJSON.resultado_operacao == true) {

                    alert('Caixa(s) ID(s) '+ response.responseJSON.ids_operacao +' excluída(s) com sucesso!')
                    window.location.href = "/";
                } else {

                    alert('Erro ao excluir Caixas(s) ID(s) '+ response.responseJSON.ids_operacao + '. Provavelmente essas caixas estão sendo usadas por outra tabela.');
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

                    alert('Imagem excluída com sucesso!');
                    $('#fotoPeca span').text('Imagem atual: Nenhuma imagem');
                    $('#excluir-img-atual').prop('disabled', 'true');
                } else {
                    alert('Erro ao excluir imagem.');
                }
            }
        });
    }
})