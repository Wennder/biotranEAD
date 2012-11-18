<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<?php $noticiaDAO = new NoticiaDAO(); $noticia = $noticiaDAO->select("id_noticia=".$_GET['id']); ?>

<form id="form_noticia" method="post" action="index.php?c=ead&a=noticias&u=1&id="<?php echo $_GET['id']?> >
    <fieldset>
        <legend>Nova Noticia</legend>
        
        <table>
            <input name="id_noticia" type="text" hidden="true" value="<?php echo $noticia->getId_noticia(); ?>"/>
            <input name="data" type="text" hidden="true" value="<?php echo $noticia->getData(); ?>"/>
            <tr>
                <td><label>titulo: </label></td>
                <td><input type="text" id="titulo" value="<?php echo $noticia[0]->getTitulo();?>" name="titulo" style="width:500px;" maxlength="255"/></td>
            </tr>
            <tr>
                <td style="vertical-align: top;"><label>manchete: </label></td>
                <td><textarea id="manchete" name="manchete" rows="3" style="width:500px;" maxlenght="255"><?php echo $noticia[0]->getManchete();?></textarea></td>
            </tr>
            <tr>
                <td style="vertical-align:top;"><label>imagem: </label></td>
                <td><input type="file" name="imagem" id="imagem" style="width:500px;" class="text-input" data-prompt-position="centerRight"/></td>
            </tr>
            <tr>
                <td style="vertical-align: top;"><label>noticia:</label></td>
                <td><textarea id="noticia" name="noticia" rows="10" style="width:500px;" maxlenght="1000"><?php echo $noticia[0]->getNoticia(); ?></textarea></td>
            </tr>
            <tr>
                <td><label>autor:</label></td>
                <td><input type="text" value="<?php echo $noticia[0]->getAutor();?>" name="autor" style="width:500px;"/></td>
            </tr>
        </table>
    </fieldset>
    <input type="submit" value="Enviar mensagem" />
</form>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
