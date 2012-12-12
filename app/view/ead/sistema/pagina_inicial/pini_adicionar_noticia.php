<?php // require ROOT_PATH . '/app/view/ead/structure/header.php';   ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php';   ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/content.php';   ?>
<div style="display:none" id="div_adicionar_noticia">
    <form id="_ID_FORM_" method="post" action="index.php?c=ead&a=pini_noticias&i=1" enctype="multipart/form-data" >
        <fieldset>
            <legend>Nova Noticia</legend>

<script>
    $(document).ready(function(){
        $('#noticia').jqte();
        $('#form_noticia').validate({
            rules:{
                titulo: {
                    required: true
                },
                autor: {
                    required: true
                },
                manchete: {
                    required: true
                },
                noticia: {
                    required: true
                }
            }
        });
    });
</script>

<div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
    <form id="form_noticia" method="post" action="index.php?c=ead&a=pini_noticias&i=1" enctype="multipart/form-data" class="formulario">
        <fieldset>
            <legend>Nova Notícia</legend>
            <table>
                <tr>
                    <td><label>Título: </label></td>
                    <td><input type="text" id="titulo" name="titulo" style="width:500px;" maxlength="255" class="text-input"/></td>
                </tr>
                <tr>
                    <td><label>Autor:</label></td>
                    <td><input type="text" name="autor" style="width:500px;" class="text-input"/></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;"><label>Manchete: </label></td>
                    <td><textarea id="manchete" name="manchete" rows="3" style="width:500px;" maxlenght="255" class="text-area"></textarea></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;"><label>Notícia:</label></td>
                    <td><textarea id="_ID_NOTICIA" name="noticia" rows="10" style="width:500px;" maxlenght="1000"></textarea></td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><label>Imagem: </label></td>
                    <td><input type="file" name="imagem" id="imagem" style="width:500px;" class="text-input" data-prompt-position="centerRight"/></td>
                </tr>
            </table>
        </fieldset><br>
        <input type="submit" id="_ID_SUBMIT" value="Postar" class="button2"/><br><br>
        <div style="display: none;">
            <input name="data" type="text" value="<?php date_default_timezone_set("Brazil/East");
echo $today = date("d/m/y - h:i"); ?>"/>
        </div>
    </form>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
