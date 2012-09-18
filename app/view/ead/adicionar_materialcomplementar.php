<?php require 'structure/header.php'?>
<?php require 'structure/leftcolumn_admin.php'?>
<?php require 'structure/content.php'?>

<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>

<div id="form_cadastro" style="">
    <form id="" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_bibliografia" enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Dados do material complementar</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Titulo do material: </label>
                    </td>
                    <td style="width: 600px;">
                        <input type="text" id="nome" name="nome" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Material: </label>
                    </td>
                    <td>
                        <input type="file" id="" style="width:500px;" value="" class="validate[required] text-input" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label class="label_cadastro">Adicionar em: </label>
                    </td>
                    <td>
                        <select style="width: 500px;" class="validate[required] text-input" multiple="multiple" />
                    </td>
                </tr>
                
                
                
                
            </table>
        </fieldset>
        <br>
        <input type="submit" id="button_add" name="button_cadastrar" value="Adicionar" class="button"/>
        
    </form>
    </br></br>
</div>


<?php require 'structure/footer.php'?>
