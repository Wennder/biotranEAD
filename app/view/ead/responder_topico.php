<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<?php $this->controller = new ControllerForum();
$this->controller->getTopico("id_topico=".$_GET['id']);

?>

<form method="post" action="index.php?c=ead&a=topico&id=<?php echo $_GET['id']; ?>">
    <input id="id_curso_topico" name="id_topico" type="text" hidden="true" value="<?php echo $_GET['id'];?>" />
    <input id="id_usuario_topico" name="id_usuario" type="text" hidden="true" value="<?php echo $_SESSION["usuarioLogado"]->getId_usuario();?>" />
    <input id="" name="r" type="text" hidden="true" value="1"/>
    <table>
        <fieldset>
            <legend>Resposta</legend>
        <tr>
            <td style="vertical-align: top;"><label>mensagem: </label></td>
            <td><textarea id="mensagem" name="mensagem" rows="5" style="width:500px;" maxlenght="1000"></textarea></td>
        </tr>
        </fieldset>
    </table>
    <input type="submit" value="Responder" />
</form>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>