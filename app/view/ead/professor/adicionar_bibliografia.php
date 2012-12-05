<div id="form_cadastro" style="">
    <form id="form_cadastrar" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_bibliografia<?php echo (isset($_GET['id'])?"&id=".$_GET['id'] : '') ?>" enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Dados do material</legend>
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
            </table>
        </fieldset>
        <br>
        <input type="submit" id="button_add" name="button_cadastrar" value="Adicionar" class="button"/>
        
    </form>
    </br></br>
</div>
