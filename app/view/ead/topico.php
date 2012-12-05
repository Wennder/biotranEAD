<?php // require ROOT_PATH . '/app/view/ead/structure/header.php';  ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'  ?>
<?php // require ROOT_PATH . '/app/view/ead/structure/content.php';  ?>

<?php
$this->controller = new ControllerForum();
if (isset($_GET['id']))
    $topico = $this->controller->getTopico("id_topico=" . $_GET['id']);
?>
<div>
<fr>
    <a href="#" id="index.php?c=ead&a=forum&id=<?php echo $topico[0]->getId_curso(); ?>"><img src="img/dynamic_blue_left.png"/>Forum</a>
</fr>

<div class="topico_fundo">
    <div class="topico_header">
        <?php if ($topico[0]->getId_usuario() == $_SESSION['usuarioLogado']->getId_usuario()) { ?>
            <input class="classeBotaoExcluir btn_excluir_topico" style="float:right;" name="topico" id="index.php?c=ead&a=forum&id=<?php echo $topico[0]->getId_curso(); ?>&d=<?php echo $topico[0]->getId_topico(); ?>"/>
        <?php } ?>
        <h2><?php echo $this->controller->getTitulo(); ?></h2>
        <b>Autor: </b><?php echo $this->controller->getUsuarioNome(); ?> 
        <span> <?php echo $this->controller->getData_hora(); ?></span>
    </div>
    <div class="topico_mensagem">
        <p>
            <?php echo $this->controller->getMensagem();?> 
        </p>
    </div>
    <br>
    <div><fr><a href="#" class="responder_topico" id="index.php?c=ead&a=responder_topico&id=<?php echo $_GET['id']; ?>">Responder</a></fr></div>
</div>
<br>
<div id="respostas">
    <?php
    echo $this->controller->listaRespostas($_GET['id']);
    ?>
</div>
</div>
<?php
// require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>