<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<h2 style="margin-bottom: 50px; margin-left: 30px;">Patrocinadores</h2>

<div id="patrocinadores_gerencia">
    <a href="index.php?c=ead&a=pini_adicionar_patrocinador">adicionar patrocinador</a>
    <div>
        <?php $controller = new ControllerSistema(); echo $controller->listaPatrocinadores(); ?>
    </div>
</div>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
