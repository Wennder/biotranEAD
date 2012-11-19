<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>
<form id="form_topico" method="post" action="index.php?c=ead&a=comentarios&i=1" >
    <fieldset>
        <legend>Novo Comentario</legend>
        
        <table>
            <input name="data" type="text" hidden="true" value="<?php  date_default_timezone_set("Brazil/East"); echo $today = date("F j, Y, g:i a"); ?>"/>
            <tr>
                <td><label>autor: </label></td>
                <td><input type="text" name="autor" style="width: 500px;" /></td>
            </tr>
            <tr>
                <td style="vertical-align: top;"><label>comentario: </label></td>
                <td><textarea id="comentario" name="comentario" rows="5" style="width:500px;" maxlenght="500"></textarea></td>
            </tr>
        </table>
    </fieldset>
    <input type="submit" value="Enviar mensagem" />
</form>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>