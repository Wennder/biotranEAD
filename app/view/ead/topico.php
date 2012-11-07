<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<?php $this->controller = new ControllerForum();
if(isset($_GET['id']))
$this->controller->getTopico("id_topico=".$_GET['id']);

?>

<div>
    <div class="topico_header">
        <h3><?php echo $this->controller->getTitulo(); ?></h3>
        <h4>Por <?php echo $this->controller->getUsuarioNome();?></h4>
    </div>
    <div>
        <p>
           <?php echo $this->controller->getMensagem(); ?> 
        </p>
    </div>
    <div><a href="index.php?c=ead&a=responder_topico&id=<?php echo $_GET['id'];?>">responder</a></div>
</div>
<?php 
    echo $this->controller->listaRespostas($_GET['id']);
?>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>