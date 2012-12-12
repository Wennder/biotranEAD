<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<?php
$noticiaDAO = new NoticiaDAO();
$noticia = $noticiaDAO->select("id_noticia=" . $_GET['id']);
?>

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
    <form id="form_noticia" method="post" enctype="multipart/form-data" action="index.php?c=ead&a=pini_noticias&u=1&id="<?php echo $_GET['id'] ?> class="formulario">
        <fieldset>
            <legend>Editar Notícia</legend>
            <table>
                <tr>
                    <td><label>Título: </label></td>
                    <td><input type="text" id="titulo" value="<?php echo $noticia[0]->getTitulo(); ?>" name="titulo" style="width:500px;" maxlength="255" class="text-input"/></td>
                </tr>
                <tr>
                    <td><label>Autor:</label></td>
                    <td><input type="text" value="<?php echo $noticia[0]->getAutor(); ?>" name="autor" style="width:500px;" class="text-input"/></td>
                </tr>
                <tr>
                    <td style="vertical-align: top;"><label>Manchete: </label></td>
                    <td><textarea id="manchete" name="manchete" rows="3" style="width:500px;" maxlenght="255" class="text-area"><?php echo $noticia[0]->getManchete(); ?></textarea></td>
                </tr>
                <?php if (is_file('img/noticias/' . $noticia[0]->getId_noticia() . '.jpg')) { ?>
                    <tr><td colspan="3"><img src="img/noticias/<?php echo $noticia[0]->getId_noticia(); ?>.jpg" alt="" /></td><td><a href="index.php?c=ead&a=editar_noticia&id=<?php echo $_GET['id']; ?>&f=1">x</a></td></tr>
<?php } ?>
                <tr>
                    <td style="vertical-align: top;"><label>Notícia:</label></td>
                    <td><textarea id="noticia" name="noticia" rows="10" style="width:500px;" maxlenght="1000" class="text-area"><?php echo $noticia[0]->getNoticia(); ?></textarea></td>
                </tr>
                <tr>
                    <td style="vertical-align:top;"><label>Imagem: </label></td>
                    <td><input type="file" name="imagem"  id="imagem" style="width:500px;" class="text-input" data-prompt-position="centerRight"/></td>
                </tr>

            </table>
        </fieldset><br>
        <input type="submit" value="Postar" class="button2"/><br><br>
        <div style="display: none;">
            <input name="id_noticia" type="text" value="<?php echo $noticia[0]->getId_noticia(); ?>"/>
            <input name="data" type="text" value="<?php echo $noticia[0]->getData(); ?>"/>
        </div>
    </form>
</div>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
