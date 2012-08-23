$(document).ready(function(){
   $('#button_login').click(function(){
       //alert('oi');
      validarLogin($('#login'), $('#senha'));
   });
});



function validarLogin(login, senha){   
    $.getJSON('ajax/validarLogin.php?search=',{
        login: login.val(),
        senha: senha.val(), 
        ajax: 'true'
    }, function(j){
        //usuario validado         
        if(j.validacao == 'validado'){
            alert(j.controlador + ' - ' + j.acao);
            $('#form_login').attr({action: 'index.php?c='+ j.controlador +'&a=' + j.acao});
            $('#form_login').submit();
        }else{
            //senha invalida
            if(j.validacao == 'invalido'){
                $('#senha').val('');
                alert('Senha inválida!');
            }else{
                //usuario inexistente
                if(j.validacao == 'cadastrar'){
                    $('#senha').val('');
                    alert('Usuario não cadastrado!');
                }
            }
        }
    });
}


