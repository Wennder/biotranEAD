<div style="display:none;" id="div_adicionar_patrocinador">
    <form method="post" id="_ID_FORM_" action="index.php?c=ead&a=pini_patrocinadores&i=1" enctype="multipart/form-data">
        <fieldset>
            <legend>Adicionar patrocinador</legend>
            <input type="text" hidden="true" value="a" />
            <table>
                <tr>
                    <td><label>imagem(200x200)</label></td>
                    <td><input type="file" name="imagem" id="imagem"  class="text-input" data-prompt-position="centerRight"/></td>
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
        <input type="_ID_SUBMIT_" value="adicionar" />
    </form>
</div>
