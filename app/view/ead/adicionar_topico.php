<?php // require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php' ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<form id="form_topico" method="post" action="index.php?c=ead&a=topico" >
    <fieldset>
        <legend>Novo Topico</legend>
        
        <table>
            <input id="id_curso_topico" name="id_curso" type="text" hidden="true" value="<?php echo $_GET['id'];?>" />
            <input id="id_usuario_topico" name="id_usuario" type="text" hidden="true" value="<?php echo $_SESSION["usuarioLogado"]->getId_usuario();?>" />
            <input name="data_hora" type="text" hidden="true" value="<?php  date_default_timezone_set("Brazil/East"); echo $today = date("F j, Y, g:i a"); ?>"/>
            <tr>
                <td><label>titulo: </label></td>
                <td><input type="text" id="titulo" name="titulo" style="width:500px;" maxlength="255"/></td>
            </tr>
            <tr>
                <td style="vertical-align: top;"><label>mensagem: </label></td>
                <td><textarea id="mensagem" name="mensagem" rows="5" style="width:500px;" maxlenght="1000"></textarea></td>
            </tr>
        </table>
    </fieldset>
    <input type="submit" value="Enviar mensagem" />
</form>

<?php // require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
