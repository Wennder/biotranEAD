<?php require ROOT_PATH.'/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH.'/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH.'/app/view/ead/structure/content.php'; ?>

<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<script>
    $(document).ready(function(){
        $('#cadastro').validationEngine();
    });
</script>
<style>
    #form_cadastro h2{
        margin-bottom: 20px;
        font-weight: 600;
    }
</style>
<div id="form_cadastro" >
    <h2><?php echo $this->curso->getNome();?></h2>
    <!-- -->
<p style="text-indent: 10px;"> Por favor, preencha o formulario para continuar!</p>
    
<form id="cadastro" class="form_cadastro" method="post" action="index.php?c=ead&a=professor_editar_curso&id=<?php echo $_GET['id']?>" enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Definicões do Curso</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Objetivo: </label>
                    </td>
                    <td style="width: 500px;">
                        <textarea id="objetivo" name="objetivo" rows="4" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="500"></textarea>
<!--                        <input type="text" id="nome_completo" name="nome_completo" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>-->
                    </td>
                </tr>
                <tr>
                    <td style="width:150px;">
                        <label class="label_cadastro">Justificativa: </label>
                    </td>
                    <td>
                        <textarea id="justificativa" name="justificativa" rows="4" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="500"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Numero de Modulos: </label>
                    </td>
                    <td>
                        <input type="text" style="width:50px;" name="numero_modulos" class="validate[required] text-input" id="numeroCursos" value="" data-prompt_position="centerRight" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Observação: </label>
                    </td>
                    <td>
                        <textarea id="obs" name="obs" rows="4" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="500"></textarea>
                    </td>
                </tr>
                
            </table>
        </fieldset>             
        <br>
        <input type="submit" id="button_ok" action="" name="button_ok" value="Ok" class="button"/>
        
        
    </form>
</div>
<?php require ROOT_PATH.'/app/view/ead/structure/footer.php'; ?>
