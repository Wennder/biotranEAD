<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>EAD Biotran</title>
        <script src="js/jquery.js" type="text/javascript"></script>
        <link rel='stylesheet' href='css/styleEAD.css' />
    </head>
    <body>
        <div class="eadbiotran_topbar">
            <div class="eadbiotran_navbar_container">
                <ul id="eadbiotran_topbar" class="eadbiotran_toplevel_nav">
                    <li class="eadbiotran_top_item" style="">
                        <a target="_new" href="index.php?c=index&a=cursos">Cursos</a>
                    </li>
                    <li class="eadbiotran_top_item" style="">
                        <a href="index.php?c=seguranca&a=logout">Logout</a>
                    </li>
                    <li class="eadbiotran_top_item" style="">
                        <a href="index.php?c=ead&a=profile&id=<?php echo $_SESSION["usuarioLogado"]->getId_usuario(); ?>" class="">
                            <?php echo $_SESSION["usuarioLogado"]->getNome_completo(); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="eadbiotran_logo">
                <a href="<?php echo "index.php?c=ead&a=index" ?>">
                    <img alt="Biotran EAD" src="img/eadbiotran_logo.png">
                </a>
            </div>
        </div>
        <div id="banner_top">

        </div>
        <div class="content_fluid">