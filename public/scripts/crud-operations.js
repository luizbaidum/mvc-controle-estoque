$('#salvar').on('click', (e) => {

    e.preventDefault();
    //VALIDAÇÃO DE CAMPOS REQUIRED----------

    let a = $('form').find($("*"));

    Object.keys(a).forEach(key => {
        //console.log(a[key]);
        if(a[key].hasAttribute('required') && (a[key].value=='' || a[key].value==undefined)) {
            console.log(a[key]);
        }
      });

    let dados = $('form').serialize();

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