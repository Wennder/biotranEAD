<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php'; ?>
<?php $caminho = file_exists("img/cursos/" . $this->curso->getId_curso() . ".jpg") ? "img/cursos/" . $this->curso->getId_curso() . ".jpg" : "img/cursos/00.jpg"; ?>

<script>
    function defineAction(){
        if($("#usuario_logado").val() == 0){
            $(window.document.location).attr('href','index.php?c=index&a=cadastro');
        }
        else{
            $(window.document.location).attr('href','index.php?c=ead&a=todos_cursos');
        }
    }
</script>

<div id="div_descricao_curso">
    <form>
        <table>
            <tr>
                <td rowspan="4">
                    <img src='<?php echo $caminho; ?>'/>
                </td>
                <td style="font-size: 22px; font-weight: bold; padding-left: 20px;">
                    <b><?php echo $this->curso->getNome(); ?></b>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 20px;">
                    <b>Tempo de acesso:</b> <?php echo $this->curso->getTempo(); ?> dias
                </td>
            </tr>
            <tr>
                <td style="padding-left: 20px;">
                    <b>Preço:</b> <?php echo ($this->curso->getGratuito(1) == 0 ? "Gratuito" : "R$" . $this->curso->getValor()); ?>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 20px;">
                    <b>Quantidade Módulos:</b> <?php echo $this->curso->getNumero_modulos(); ?>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 20px;">
                    <b>Descrição:</b> <?php echo $this->curso->getDescricao(); ?>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 20px;">
                    <b>Justificativa:</b> <?php echo $this->curso->getJustificativa(); ?>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 20px;">
                    <input type="button" id="button_matricular" name="button_matricular" class="button2" value="Matricular-se" onclick="defineAction();"/>
                </td>
            </tr>
        </table>
    </form>
    <span style="display: none;">
        <input type="text" id="usuario_logado" value="<?php echo (isset($_SESSION['usuarioLogado']) ? "1" : "0") ?>"/>
    </span>
</div>

<?php // echo $this->curso->getNome(); ?>
<?php // require 'structure/content_down.php'; ?>
<?php require 'structure/footer.php'; ?>