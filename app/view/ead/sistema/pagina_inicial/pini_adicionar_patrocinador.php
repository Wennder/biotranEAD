<?php // require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<form method="post" action="index.php?c=ead&a=pini_patrocinadores&i=1" enctype="multipart/form-data">
    <fieldset>
        <legend>Adicionar patrocinador</legend>
        <input type="text" hidden="true" value="a" />
        <table>
            <tr>
                <td><label>imagem(200x200)</label></td>
                <td><input type="file" name="imagem" id="imagem"  class="text-input" data-prompt-position="centerRight"/></td>
            </tr>
        </table>
    </fieldset>
    <input type="submit" value="adicionar" />
</form>

<?php // require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
