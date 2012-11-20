<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<?php $dao = new ComentarioDAO(); $comentario = $dao->select("id_comentario=".$_GET['id']); ?>

<form id="form_topico" method="post" action="index.php?c=ead&a=comentarios&u=1&id=<?php echo $_GET['id'];?>" >
    <fieldset>
        <legend>Novo Comentario</legend>
        
        <table>
            
            <input name="id_comentario" type="text" hidden="true" value="<?php echo $comentario[0]->getId_comentario();?>"/>
            <input name="data" type="text" hidden="true" value="<?php echo $comentario[0]->getData(); ?>"/>
            <tr>
                <td><label>autor: </label></td>
                <td><input type="text" name="autor" style="width: 500px;" value="<?php echo $comentario[0]->getAutor();?>" /></td>
            </tr>
            <tr>
                <td style="vertical-align: top;"><label>comentario: </label></td>
                <td><textarea id="comentario" name="comentario" rows="5" style="width:500px;" maxlenght="500"><?php echo $comentario[0]->getComentario();?></textarea></td>
            </tr>
        </table>
    </fieldset>
    <input type="submit" value="Enviar mensagem" />
</form>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>