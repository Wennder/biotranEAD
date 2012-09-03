//Verifica se o e-mail informado pelo usuário já é cadastrado ou não
function validaCpf_passaporte_ajax(cpf_passaporte_antigo){
    if($('#email').val() != cpf_passaporte_antigo || cpf_passaporte_antigo == null){
        $.getJSON('ajax/validarCpf_passaporteCadastro.php?search=',{
            cpf_passaporte: $('#cpf_passaporte').val(),                         
            ajax: 'true'
        }, function(j){
            //usuario validado         
            if(j == 0){
                alert('Este cpf_passaporte já está cadastrado.');                                
                $('#cpf_passaporte').val('');
            }
        });            
    }
}

