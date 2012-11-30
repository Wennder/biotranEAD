<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<h2 style="margin-bottom: 50px; margin-left: 30px;">Noticias</h2>

<div id="noticias_gerencia">
    <a href="index.php?c=ead&a=pini_adicionar_noticia">adicionar noticia</a>
    <div>
        <?php $controller = new ControllerSistema(); echo $controller->listaNoticia(); ?>
    </div>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>