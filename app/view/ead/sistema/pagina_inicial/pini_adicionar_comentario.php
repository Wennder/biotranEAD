<?php // require ROOT_PATH . '/app/view/ead/structure/header.php';  ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php';  ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/content.php';  ?>

<div style="display:none" id="div_adicionar_comentario">
    <form id="_ID_FORM_" method="post" action="index.php?c=ead&a=pini_comentarios&i=1" >
        <fieldset>
            <legend>Novo Comentario</legend>

            <table>
                <input name="data" type="text" hidden="true" value="<?php date_default_timezone_set("Brazil/East");
echo $today = date("d/m/y - h:i"); ?>"/>
                <tr>
                    <td><label>autor: </label></td>
                    <td><input type="text" id="autor" name="autor" style="width: 500px;" /></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;"><label>comentario: </label></td>
                    <td><textarea id="comentario" name="comentario" rows="5" style="width:500px;" maxlenght="500"></textarea></td>
                </tr>
            </table>
        </fieldset>
        <input type="submit" id="_ID_SUBMIT_"value="Enviar mensagem" />
    </form>
</div>
<?php
// require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>