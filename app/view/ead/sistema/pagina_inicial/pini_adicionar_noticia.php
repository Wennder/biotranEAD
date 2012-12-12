<div id="div_adicionar_noticia" style="border-bottom:1px solid #f0f0f0; margin-left:20px; display: none;">
    <form id="_ID_FORM_" method="post" action="index.php?c=ead&a=pini_noticias&i=1" enctype="multipart/form-data" class="formulario">
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
                    <td><textarea class="editor" id="_ID_NOTICIA_" name="noticia" rows="10" style="width:500px;" maxlenght="1000"></textarea></td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><label>Imagem: </label></td>
                    <td><input type="file" name="imagem" id="imagem" style="width:500px;" class="text-input" data-prompt-position="centerRight"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <progress id="_ID_PROGRESS_" value="0" max="100"></progress><span id="_ID_PORCENTAGEM_">0%</span>                        
                    </td>
                </tr>                
                <tr>
                    <td><label>autor:</label></td>
                    <td><input type="text" name="autor" style="width:500px;"/></td>
                </tr>
            </table>
        </fieldset><br>
        <input type="submit" id="_ID_SUBMIT_" value="Postar" class="button2"/><br><br>
        <div style="display: none;">
            <input name="data" type="text" value="<?php date_default_timezone_set("Brazil/East");
echo $today = date("d/m/y - h:i"); ?>"/>
        </div>
    </form>
</div>
