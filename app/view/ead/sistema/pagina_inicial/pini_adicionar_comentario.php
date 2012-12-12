<div style="display:none" id="div_adicionar_comentario">
    <form id="_ID_FORM_" method="post" action="index.php?c=ead&a=pini_comentarios&i=1" class="formulario">
        <fieldset>
            <legend>Novo Comentário</legend>
            <table>
                <tr>
                    <td><label>Autor: </label></td>
                    <td><input type="text" id="autor" name="autor" style="width: 390px;" class="text-input"/></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;"><label>Comentário: </label></td>
                    <td><textarea id="comentario" name="comentario" rows="5" style="width:390px;" maxlenght="500" class="text-area"></textarea></td>
                </tr>
            </table>
        </fieldset><br>
        <input type="submit" id="_ID_SUBMIT_"value="Postar" class="button2"/><br><br>
        <div style="display: none;">
            <input name="data" type="text" value="<?php date_default_timezone_set("Brazil/East");
echo $today = date("d/m/y - h:i");
?>"/>
        </div>
    </form>
</div>