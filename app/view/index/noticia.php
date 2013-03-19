<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php';?>

<?php $dao = new NoticiaDAO(); $noticia = $dao->select("id_noticia=".$_GET['id']);  ?>

<h1 id="titulo_noticia"><?php echo ucfirst($noticia[0]->getTitulo()); ?></h1>
<p id="manchete_noticia" ><?php echo $noticia[0]->getManchete();?></p>
<h5 id="data_noticia">
    <?php echo $noticia[0]->getData();?>
</h5>
<?php // if(is_file(ROOT_PATH.'public/img/noticias/'.$noticia[0]->getId_noticia().'jpg')){ ?>
    <img id="img_noticia" alt="" src="img/noticias/<?php echo $noticia[0]->getId_noticia(); ?>.jpg"/>
<?php// } ?>

<p id="texto_noticia">
    <?php echo $noticia[0]->getNoticia();?>
</p>
<h5 id="autor_noticia">autor: <?php echo $noticia[0]->getAutor();?></h5>
<?php require 'structure/footer.php'; ?>

