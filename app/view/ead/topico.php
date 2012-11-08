<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<?php $this->controller = new ControllerForum();
if(isset($_GET['id']))
$topico = $this->controller->getTopico("id_topico=".$_GET['id']);

?>
<a id="voltar_forum" href="index.php?c=ead&a=forum&id=<?php echo $topico[0]->getId_curso();?>"><img src="img/dynamic_blue_left.png"/>Forum</a>
<div class="topico_fundo">
    <div class="topico_header">
        <?php if($topico[0]->getId_usuario() == $_SESSION['usuarioLogado']->getId_usuario()){?>
        <a style="float:right;" href="index.php?c=ead&a=forum&id=<?php echo $topico[0]->getId_curso();?>&d=<?php echo $topico[0]->getId_topico();?>"><img src="img/excluir_forum.png" /></a>
        <?php }?>
        <h2><?php echo $this->controller->getTitulo(); ?></h2>
        <b>Autor: </b><?php echo $this->controller->getUsuarioNome();?> 
        <span> <?php echo $this->controller->getData_hora(); ?></span>
    </div>
    <div class="topico_mensagem">
        <p>
           <?php echo $this->controller->getMensagem(); ?> 
        </p>
    </div>
    <br>
    <div><a href="index.php?c=ead&a=responder_topico&id=<?php echo $_GET['id'];?>" id="forum_responder">Responder</a></div>
</div>
<br>
<div id="respostas">
<?php 
    echo $this->controller->listaRespostas($_GET['id']);
?>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>