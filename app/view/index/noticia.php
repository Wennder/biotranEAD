<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php';?>

<?php $dao = new NoticiaDAO(); $noticia = $dao->select("id_noticia=".$_GET['id']);  ?>

<h1><?php echo ucfirst($noticia[0]->getTitulo()); ?></h1>
<p><?php echo $noticia[0]->getManchete();?></p>
<h5>
    <?php echo $noticia[0]->getData();?>
</h5>
<?php // if(is_file(ROOT_PATH.'public/img/noticias/'.$noticia[0]->getId_noticia().'jpg')){ ?>
    <img alt="" src="img/noticias/<?php echo $noticia[0]->getId_noticia(); ?>.jpg"/>
<?php// } ?>

<p>
    <?php echo $noticia[0]->getNoticia();?>
</p>
<h5>autor: <?php echo $noticia[0]->getAutor();?></h5>
<?php require 'structure/footer.php'; ?>

