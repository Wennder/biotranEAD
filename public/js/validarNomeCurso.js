//Verifica se o e-mail informado pelo usuário já é cadastrado ou não
function validaNomeCurso_ajax(cpf_passaporte_antigo){
    if($('#email').val() != cpf_passaporte_antigo || cpf_passaporte_antigo == null){
        $.getJSON('ajax/validarNomeCurso.php?search=',{
            nome_curso: $('#nome').val(),            
            ajax: 'true'
        }, function(j){
            //usuario validado         
            if(j == 0){
                alert('Este nome já está cadastrado.');                                
                $('#cpf_passaporte').val('');
            }
        });            
    }
}

