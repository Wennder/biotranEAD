<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8_unicode_ci" />
        <title>EAD Biotran</title>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/menuDropDown.js" type="text/javascript"></script>
<!--        <link rel='stylesheet' href='css/styleEAD.css' />-->
        <script type="text/javascript">
            $(document).ready(function(){
                $(".eadbiotran_topbar").disableSelection();
                // Fecha a aba se clicado fora
                document.onClick = comprimir(); 
            });
        </script>
        <link rel='stylesheet' href='css/styleEAD.css' />
    </head>
    <body>
        <div class="eadbiotran_topbar">
            <div class="eadbiotran_navbar_container">
                <ul class="eadbiotran_topbar_dropdown" >
                    <li class="eadbiotran_top_item" style="">
                        <a target="_new" href="index.php?c=index&a=cursos">Cursos</a>
                    </li>
                    <li class="eadbiotran_top_item" style="">
                        <a href="#" onmouseover="expandir('menuDrop')" onmouseout="iniciarCronometro()"><?php echo $_SESSION["usuarioLogado"]->getNome_completo(); ?></a>
                        <div id="menuDrop"
                             onmouseover="zerarCronometro()" 
                             onmouseout="iniciarCronometro()">
                            <a href="index.php?c=ead&a=profile&id=<?php echo $_SESSION["usuarioLogado"]->getId_usuario(); ?>">Perfil</a>
                            <a href="index.php?c=seguranca&a=logout">Logout</a>
                        </div>
                    </li>
                </ul>
                <div style="clear:both"></div>
            </div>

            <div class="eadbiotran_logo">
                <a href="<?php echo "index.php?c=ead&a=index" ?>">
                    <img alt="Biotran EAD" src="img/eadbiotran_logo.png">
                </a>
            </div>
        </div>
        <div id="banner_top">
            <br>
                <label style="color: #fff;">. Versão 0.1</label>
        </div>
        <div class="content_fluid">
