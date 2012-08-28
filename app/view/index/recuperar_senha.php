<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php'; ?>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>
    $(document).ready(function(){
        $("#recuperarSenha").validationEngine();
        $('#button_enviar').click(function(){
            //alert('oi');
            ajax_enviarEmail($('#email'), $('#cpf_passaporte'));
        });
    
        function ajax_enviarEmail(email, cpf_passaporte){
            $.getJSON('ajax/enviarEmail.php?search=',{
                email: email.val(),
                cpf_passaporte: cpf_passaporte.val(), 
                ajax: 'true'
            }, function(j){
                if(j == 1){
                    alert("DEU CERTO");
                }else{
                    alert("NÃO DEU CERTO");
                }
            });
        }
       
    });

    
</script>
<div id="form_recuperarSenha">
    <form id="recuperarSenha" name="form_recuperarSenha" method="post" action="">
        <fieldset style="width: 100%;">
            <legend>Recuperar Senha</legend>
            <table style="width: 100%;">
                <tr>
                    <td colspan="2">
                        <label class="label_recuperarSenha"><strong>Para recuperar sua senha, informe seu e-mail e CPF/Passaporte. Um e-mail lhe será enviado com sua nova senha.</strong></label>
                    </td>
                </tr>
                <tr><td colspan="2" style="height: 30px;"></td></tr>
                <tr>
                    <td style="width: 100px;">
                        <label class="label_recuperarSenha">E-mail (login): </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="email" name="email"  class="validate[required, custom[email]] text-input" data-prompt-position="centerRight" size="40"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_recuperarSenha">CPF/Passaporte: </label>
                    </td>
                    <td>
                        <input type="text" id="cpf_passaporte" name="cpf_passaporte" class="validate[required, custom[onlyNumberSp]] text-input" data-prompt-position="centerRight" onkeypress="return apenas_numero(event);" style="width: 115px" maxlength="14"/>
                        <label class="label_recuperarsenha_legend">Somente números </label>
                    </td>
                </tr>
                <tr><td colspan="2" style="height: 30px;"></td>
            </table>
        </fieldset>
        <br>
        <input type="button" id="button_enviar" name="button_enviar" value="Enviar" class="button"/>
    </form>
</div>
<?php // require 'structure/content_down.php'; ?>
<?php require 'structure/footer.php'; ?>