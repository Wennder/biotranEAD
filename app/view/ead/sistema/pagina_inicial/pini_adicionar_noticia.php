<?php // require ROOT_PATH . '/app/view/ead/structure/header.php';   ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php';   ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/content.php';   ?>
<div style="display:none" id="div_adicionar_noticia">
    <form id="_ID_FORM_" method="post" action="index.php?c=ead&a=pini_noticias&i=1" enctype="multipart/form-data" >
        <fieldset>
            <legend>Nova Noticia</legend>

            <table>
                <input name="data" type="text" hidden="true" value="<?php date_default_timezone_set("Brazil/East");
echo $today = date("d/m/y - h:i");
?>"/>
                <tr>
                    <td><label>titulo: </label></td>
                    <td><input type="text" id="titulo" name="titulo" style="width:500px;" maxlength="255"/></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;"><label>manchete: </label></td>
                    <td><textarea id="manchete" name="manchete" rows="3" style="width:500px;" maxlenght="255"></textarea></td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><label>imagem: </label></td>
                    <td><input type="file" name="imagem" id="imagem" style="width:500px;" class="text-input" data-prompt-position="centerRight"/></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;"><label>noticia:</label></td>
                    <td><textarea id="_ID_NOTICIA_" name="noticia" rows="10" style="width:500px;" maxlenght="1000"></textarea></td>
                </tr>
                <tr>
                    <td><label>autor:</label></td>
                    <td><input type="text" name="autor" style="width:500px;"/></td>
                </tr>
            </table>
        </fieldset>
        <input type="submit" id="_ID_SUBMIT_" value="Enviar mensagem" />
    </form>
</div>
<?php
// require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
