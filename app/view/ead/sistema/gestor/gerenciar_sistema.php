<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<h2 style="margin-bottom: 50px; margin-left: 30px;">Gerenciar Sistema</h2>

<ul id="gerenciar_sistema">
    <a href="index.php?c=ead&a=patrocinadores">
        <li>
            
            <img src="img/patrocinio_gestor.png" />
            <h3 style="text-align: center;">Patrocinio</h3>
        </li></a>
    <a href="#">
        <li>
            <img src="img/news.png" />
            <h3 style="text-align: center;">Noticias</h3>
        </li></a>
    <a href="#">   
    <li>
            <img src="img/chat_3.png" />
            <h3 style="text-align: center;">Comentarios</h3>
        </li></a>
   
</ul>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
