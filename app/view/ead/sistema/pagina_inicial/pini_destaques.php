<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<h2 style="margin-bottom: 50px; margin-left: 30px;">Destaques</h2>

<div id="destaques_gerencia">
    <a href="index.php?c=ead&a=pini_adicionar_destaque">adicionar destaque</a>
    <div>
        <?php $controller = new controllerSistema(); echo $controller->listaDestaques();?>
    </div>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>