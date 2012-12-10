<script>
    $(document).ready(function(){
        $('#mensagem').jqte();
    });
</script>

<div>
    <div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
        <div style="border-bottom:1px solid #eeeeee;">
            <div style="float: left; position: absolute;">
                <a style="text-decoration: none;" href="#" class="ref_ajax" name="index.php?c=ead&a=forum&id=<?php echo $_GET['id']; ?>"><img src="img/dynamic_blue_left.png"/>Voltar</a>
            </div>
            <center><label style="font-size: 15px; font-weight: bold;">Fórum - <?php echo $this->curso->getNome(); ?></label></center>
        </div><br>
        <form id="form_adicionar_topico" method="post" action="index.php?c=ead&a=topico&i=inserir" class="formulario">
            <fieldset style="width: 653px;">
                <legend>Novo Tópico</legend>
                <table>
                    <tr>
                        <td><label>Título: </label></td>
                        <td><input type="text" id="titulo" name="titulo" style="width:500px;" maxlength="255"/></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;"><label>Mensagem: </label></td>
                        <td><textarea id="mensagem" name="mensagem" rows="5" style="width:500px;" maxlenght="1000"></textarea></td>
                    </tr>
                </table>
            </fieldset><br>
            <input type="submit" value="Postar" class="button2"/><br><br>
            <div style="display: none;">
                <input id="id_curso_topico" name="id_curso" type="text" value="<?php echo $_GET['id']; ?>" />
                <input id="id_usuario_topico" name="id_usuario" type="text" value="<?php echo $_SESSION["usuarioLogado"]->getId_usuario(); ?>" />
                <input name="data_hora" type="text" value="<?php date_default_timezone_set("Brazil/East");echo $today = date("d/m/y - h:i"); ?>"/>
            </div>
        </form>
    </div>
</div>