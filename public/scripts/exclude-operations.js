$('#delPeca').click(function() {


    //FAZER NEGOCIO Q PEGA SE NENHUM CHECKBOX ESTÁ SELECIONADO
    
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
            if(response.resultado_operacao == 1) {

                alert('Peça(s) ID'+ response.ids_operacao +' excluída(s) com sucesso!')
                document.location.reload();
            } else {

                alert('Erro ao excluir Peça(s). Por favor, tente novamente');
            }
        }
    })
})

