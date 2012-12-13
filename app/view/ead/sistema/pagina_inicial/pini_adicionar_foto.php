<div id="div_adicionar_foto" style="display:none;">
    <form id="_ID_FORM_" method="post" action="index.php?c=ead&a=pini_fotos&i=1" enctype="multipart/form-data">
        <fieldset>
            <legend>Adicionar Foto</legend>
            <table>
                <tr>
                    <td><label>Imagem:</label></td>
                    <td><input type="file" name="imagem" id="imagem"  class="text-input" data-prompt-position="centerRight"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <progress id="_ID_PROGRESS_" value="0" max="100"></progress><span id="_ID_PORCENTAGEM_">0%</span>
                    </td>
                </tr>
            </table>
        </fieldset>
        <input type="submit" id="_ID_SUBMIT_" value="adicionar" />
    </form>
    <div style="display: none;">
        <input type="text" value="a"/>
    </div>
</div>
