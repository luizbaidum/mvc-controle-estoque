$('#delPeca').click(function() {

    $('#form-index').submit();
} )

$('#form-index').submit((e) => {

    e.preventDefault();

    let dados = $('#form-index').serialize();

    $.ajax({
        method: "POST",
        url: "/delete_peca",
        dataType: "json",
        data: dados,
        success: function(response) {
            if(response == 1) {

                alert('Peça(s) excluídas com sucesso!')
                document.location.reload();
                //fazer pagina recarregar e ver se está dando aviso correto
            } else {

                alert('Erro ao excluir Peça(s). Por favor, tente novamente');
            }
        }
    })
})