<?php require 'structure/header.php' ?>
<?php require 'structure/leftcolumn_professor_curso.php' ?>
<?php require 'structure/content.php' ?>

<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>
    $(document).ready(function(){
        //Habilita a validação automática no formulário de cadastro
        $("#cadastro").validationEngine();
    });
    
    $('#numero_modulo').change(function (e){
        var id_curso = $(this).children('option:selected').val();
        $.getJSON('ajax/numeracaoModulo.php?search=',{
                id_curso: id_curso,                         
                ajax: 'true'
            }, function(j){                         
                if(j == 0){
                    alert('Este e-mail já está cadastrado.');                                
                    $('#email').val('');
                }
            }); 
    });
</script>

<div id="form_cadastro" style="margin-top:0px;">
    <form id="cadastro" name="cadastro" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_modulo" enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Dados do modulo</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">*Titulo do modulo: </label>
                    </td>
                    <td style="width: 600px;">
                        <input type="text" id="titulo_modulo" name="titulo_modulo" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Descrição: </label>
                    </td>
                    <td>
                        <textarea id="descricao" style="width:500px;" name="descricao" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Adicionar em: </label>
                    </td>
                    <td>
                        <select multiple="single" style="width: 500px;" id="id_curso" name="id_curso" class="validate[required] text-input">
                            <?php
                            if ($this->options != null) {
                                echo $this->options;
                            }
                            ?>
                        </select>
                    </td>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">*Numero do modulo: </label>
                    </td>
                    <td style="width: 600px;">
                        <select style="width: 500px;" id="numero_modulo" name="numero_modulo" class="validate[required] text-input">
                            
                        </select>
                    </td>
                </tr>

                </tr>                                                                
            </table>
        </fieldset>
        <br>
        <input type="submit" id="button_cadastrar" name="button_cadastrar" value="Adicionar" class="button"/>

    </form>
    </br></br>
</div>


<?php require 'structure/footer.php' ?>
