<?php // require ROOT_PATH . '/app/view/ead/structure/header.php';   ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'   ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/content.php';   ?>

<?php
$this->controller = new ControllerForum();
$this->controller->getTopico("id_topico=" . $_GET['id']);
?>


<div>
    <script>

        $(document).ready(function(){
            $('#mensagem').jqte();
        });

    </script>
    <div>
        <a href="#" class="ref_ajax" name="index.php?c=ead&a=topico&id=<?php echo $_GET['id']; ?>"><img src="img/dynamic_blue_left.png"/>Tópico</a>
    </div>
    <form id="form_responder_topico" method="post" action="index.php?c=ead&a=topico&r=1&id=<?php echo $_GET['id']; ?>">
        <input id="id_curso_topico" name="id_topico" type="text" hidden="true" value="<?php echo $_GET['id']; ?>" />
        <input id="id_usuario_topico" name="id_usuario" type="text" hidden="true" value="<?php echo $_SESSION["usuarioLogado"]->getId_usuario(); ?>" />
        <input name="data_hora" type="text" hidden="true" value="<?php date_default_timezone_set("Brazil/East");
echo $today = date("F j, Y, g:i a");
?>"/>        
        <fieldset>
            <table>
                <legend>Resposta</legend>
                <tr>
                    <td style="vertical-align: top;"><label>mensagem: </label></td>
                    <td><textarea id="mensagem" name="mensagem" rows="5" style="width:500px;" maxlenght="1000"></textarea></td>
                </tr>
            </table>
        </fieldset>
        <input type="submit" value="Responder" />
    </form>
</div>
<?php
// require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>