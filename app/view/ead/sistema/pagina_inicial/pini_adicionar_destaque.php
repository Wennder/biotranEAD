<?php // require ROOT_PATH . '/app/view/ead/structure/header.php';  ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php';  ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/content.php';  ?>

<div style="display:none" id="div_adicionar_destaque">
    <form id="_ID_FORM_" method="post" action="index.php?c=ead&a=pini_destaques&i=1" enctype="multipart/form-data">
        <fieldset>
            <legend>Adicionar destaque</legend>
            <table>
                <tr>
                    <td><label>imagem(650x300)</label></td>
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
<?php
// require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>