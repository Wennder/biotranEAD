<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<?php $this->controller = new ControllerForum();
if(isset($_GET['id']))
$this->controller->getTopico("id_topico=".$_GET['id']);

?>

<div class="topico_fundo">
    <div class="topico_header">
        <h3><?php echo $this->controller->getTitulo(); ?></h3>
        <b>Autor: </b><?php echo $this->controller->getUsuarioNome();?>
    </div>
    <div class="topico_mensagens">
        <p>
           <?php echo $this->controller->getMensagem(); ?> 
        </p>
    </div>
    <br>
    <div><a href="index.php?c=ead&a=responder_topico&id=<?php echo $_GET['id'];?>" id="forum_responder">Responder</a></div>
</div>
<br>
<?php 
    echo $this->controller->listaRespostas($_GET['id']);
?>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>