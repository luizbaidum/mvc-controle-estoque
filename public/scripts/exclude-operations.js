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
            if(response.resultado_operacao == true) {

                alert('Peça(s) ID(s) '+ response.ids_operacao +' excluída(s) com sucesso!')
                window.location.href = "/";
            } else {

                alert('Erro ao excluir Peça(s) ID(s) '+ response.ids_operacao + '. Por favor, tente novamente');
            }
        }
    })
})

