$('#delPeca').on('click', () => {

    //VALIDAÇÃO DE CHECKBOX SELECTED----------
    let elementos = $('table').find('*');

    let selecionados = [];

    elementos.each(function(key, value) {
        
        if(value.tagName =='INPUT' && value.type == 'checkbox' && value.checked) {
            
            selecionados.push(value);
        }
    });

    if(selecionados.length<=0) {

        alert('Por favor, selecione alguma peça para apagar.')
        return;
    }
    
    let dados = selecionados;

    let delete_peca = $.ajax({

        method: "POST",
        url: "/delete_peca",
        dataType: "json",
        data: dados,
      })

    delete_peca.done(() => {
           
        });

    delete_peca.fail(() => {
            
        });
})