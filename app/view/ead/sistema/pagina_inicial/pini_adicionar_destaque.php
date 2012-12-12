<div style="display:none" id="div_adicionar_destaque">
    <form id="_ID_FORM_" method="post" action="index.php?c=ead&a=pini_destaques&i=1" enctype="multipart/form-data"class="formulario" >
        <fieldset>
            <legend>Adicionar destaque</legend>
            <table>
                <tr>
                    <td><label>Imagem(650x300)</label></td>
                    <td><input type="file" name="imagem" id="imagem" class="text-input"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <progress value="0" max="100"></progress><span id="_ID_PORCENTAGEM_">0%</span>
                        <label class="error" for="video" generated="true" style="display: none; position: relative;">Os formatos de vídeo aceitos são somente .mp4.</label>
                    </td>
                </tr>
            </table>
        </fieldset>
        <input type="_ID_SUBMIT_" value="adicionar" class="button2"/>
    </form>
</div>
