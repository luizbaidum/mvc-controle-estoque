$('#salvar').on('click', (e) => {

    e.preventDefault();

    let dados = $('form').serialize();
    console.log(dados);
    //DE ALGUMA FORMA, PRA MIM MÁGICA, A URL ESTÁ SENDO RECONHECIDA COMO A ROTA CORRETA E O LET DADOS TÁ SENDO RECONHECIDO NORMALMENTE PELO PHP SEM EU PRECISAR FAZER NADA DIFERENTE

    //NOVA CAIXA----------------------------
    if($('#operation').val() == 'nova_caixa') {

        let nova_caixa = $.ajax({

            method: "POST",
            url: "nova_caixa/insert",
            dataType: "json",
            data: dados,
          })
    
        nova_caixa.done(() => {
                alert("Caixa ID " + $('#idCaixa').val() + " inserida com sucesso!");
                $('form')[0].reset();
            });
    
        nova_caixa.fail(() => {
                alert("Erro no processo de inserir Caixa ID " + $('#idCaixa').val() + ". Verifique se este ID já está cadastrado.");
            });
    }    
    //NOVA PEÇA----------------------------
    if($('#operation').val() == 'nova_peca') {

        let nova_caixa = $.ajax({

            method: "POST",
            url: "nova_peca/insert",
            dataType: "json",
            data: dados,
          })
    
        nova_caixa.done(() => {
                alert("Peca ID " + $('#idPeca').val() + " inserida com sucesso!");
                $('form')[0].reset();
            });
    
        nova_caixa.fail(() => {
                alert("Erro no processo de inserir Peca ID " + $('#idPeca').val() + ". Verifique se este ID já está cadastrado.");
            });
    } 
})