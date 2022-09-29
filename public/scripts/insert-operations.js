$('#salvar').on('click', (e) => {

    e.preventDefault();

    //VALIDAÇÃO DE CAMPOS REQUIRED----------
    let elementos = $('form').find('*');

    let requeridos = [];

    elementos.each(function(key, value) {
        
        if(value.hasAttribute('required')) {
            
            if(value.value == '' || value.value == undefined || value.value == null) {

                requeridos.push(value);
            }
        }
    });

    if(requeridos.length>0) {

        alert('Existem campos obrigatórios NÃO preenchidos.');
        return;
    }    

    let dados = $('form').serialize();

    //NOVA CAIXA----------------------------
    if($('#operation').val() == 'nova_caixa') {

        $.ajax({
            method: "POST",
            url: "nova_caixa/insert",
            dataType: "json",
            data: dados,
            success: function(response) {
                if(response.resultado_operacao == true) {
    
                    alert("Caixa ID " + response.id_operacao + " inserida com sucesso!");
                    $('form')[0].reset();
                } else {
                    alert("Erro no processo de inserir Caixa ID " + response.id_operacao + ". Verifique se este ID já está cadastrado.");
                }
            }
        })
    }    
    //NOVA PEÇA----------------------------
    if($('#operation').val() == 'nova_peca') {

        $.ajax({
            method: "POST",
            url: "nova_peca/insert",
            dataType: "json",
            data: dados,
            success: function(response) {
                if(response.resultado_operacao == true) {
    
                    alert("Peca ID " + response.id_operacao + " inserida com sucesso!");
                    $('form')[0].reset();
                } else {
                    alert("Erro no processo de inserir Peca ID " + response.id_operacao + ". Verifique se este ID já está cadastrado.");
                }
            }
        })
    } 
})