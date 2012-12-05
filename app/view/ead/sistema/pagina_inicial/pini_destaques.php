<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
    <h3 style="margin: 0;">Destaques</h3><br>
    <div id="destaques_gerencia">
        <a href="index.php?c=ead&a=pini_adicionar_destaque" style="text-decoration: none;" class="button2"> Adicionar Destaque</a><br><br>
        <div>
            <?php $controller = new controllerSistema(); echo $controller->listaDestaques();?>
        </div>
    </div>
    <br><br>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>