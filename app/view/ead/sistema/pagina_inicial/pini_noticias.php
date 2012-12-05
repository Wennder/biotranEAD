<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
    <h3 style="margin: 0;">Notícias</h3><br>
    <div id="noticias_gerencia">
        <a href="index.php?c=ead&a=pini_adicionar_noticia" style="text-decoration: none;" class="button2"> Adicionar Notícia</a><br><br>
        <div style="border-top: 1px solid #ddd; border-right: 1px solid #ddd;">
            <?php
            $controller = new controllerSistema();
            echo $controller->listaNoticia();
            ?>
        </div>
    </div>
    <br><br>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>