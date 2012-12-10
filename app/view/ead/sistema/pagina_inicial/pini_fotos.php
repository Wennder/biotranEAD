<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<h2 style="margin-bottom: 50px; margin-left: 30px;">Patrocinadores</h2>

<div id="fotos_gerencia">
    <a href="index.php?c=ead&a=pini_adicionar_foto">adicionar foto</a>
    <div>
        <?php $controller = new controllerSistema(); echo $controller->listaFotos() ; ?>
    </div>
</div>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
