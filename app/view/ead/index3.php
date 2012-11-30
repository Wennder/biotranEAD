<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="NO-CACHE; text/html; charset=utf8" />
        <title>EAD Biotran</title>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/video.js"></script>
        <script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <script src="js/jquery.form.js" type="text/javascript"></script>
        <script src="js/biotran.js" type="text/javascript"></script>
        <script src="js/accordion.js" type="text/javascript"></script>
        <link href='css/styleEAD.css' rel='stylesheet'/>
        <link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="css/video-js.css" rel="stylesheet" type="text/css"/>

        <script>
            $(document).ready(function(){
                $('dd').hide();
                $('dt a').click(function(){
                    $("dd:visible").slideUp("fast");
                    $(this).parent().next().slideDown("fast");
                    return false;
                });
            });
        </script>
    </head>

    <body>
        <div id="dialog" style="display:none"></div>
        <div id="dialog_video" style="display:none"></div>

        <div class="eadbiotran_topbar">
            <div class="eadbiotran_navbar_container">
                <ul>
                    <li>
                        <div id="pic_topbar">
                            <img src="img/profile/pic/<?php
$this->usuario = $_SESSION['usuarioLogado'];
if ($this->usuario == null) {
    echo '00.jpg';
} else if (file_exists('img/profile/' . $this->usuario->getId_usuario() . '.jpg')) {
    echo $this->usuario->getId_usuario() . '.jpg';
} else {
    echo '00.jpg';
}
?>
                                 "/>
                        </div>
                    </li>
                    <li style="margin-top: 10px;">
                        <label class="labelTopbar_1">
                            <?php echo $_SESSION["usuarioLogado"]->getNome_completo(); ?>
                        </label><br>
                            <label class="labelTopbar_2">
                                <?php
                                $papel = $_SESSION["usuarioLogado"]->getId_papel();
                                if ($papel == 1) {
                                    echo 'Administrador';
                                } else if ($papel == 2) {
                                    echo 'Gestor';
                                } else if ($papel == 3) {
                                    if ($_SESSION["usuarioLogado"]->getSexo() == 'Masculino') {
                                        echo 'Professor';
                                    } else {
                                        echo 'Professora';
                                    }
                                } else if ($papel == 4) {
                                    echo 'Estudante';
                                }
                                ?>
                            </label>
                    </li>
                    <li id="menu_topbar" onclick="expandir('#menuDrop_topbar')">
                        <img src="img/settings.png" />
                    </li>
                    <li id="ead_biotran">
                        <a href="index.php"><label class="labelTopbar_1">EAD Biotran</label></a>
                    </li>
                    <div id="menuDrop_topbar" onmouseover="zerarCronometro()" onmouseout="iniciarCronometro()">
                        <ul >
                            <li>
                                <a href="index.php?c=ead&a=dados_pessoais&id=<?php echo $_SESSION["usuarioLogado"]->getId_usuario(); ?>">Perfil</a>
                            </li>
                            <li>
                                <a href="index.php?c=seguranca&a=logout">Logout</a>
                            </li>

                        </ul>
                    </div>
                </ul>              
            </div>
        </div> 
        <div class="content_fluid">


            <div id="page-leftcolumn" class="leftcolumn">
                <dl>
                    <dt>
                        <a class="navbar_item homeIcon" href="<?php echo "index.php?c=ead" ?>"> Home </a>
                    </dt>
                    <dd></dd>
                    <dt>
                        <a class="navbar_item gerenciarIcon" href="#">Gerenciar</a>
                    </dt>
                    <dd>
                        <ul>
                            <li><a class="navbar_item usuariosIcon" href="index.php?c=ead&a=gerenciar_usuarios"> Usuários</a></li>
                            <li><a class="navbar_item cursosIcon" href="index.php?c=ead&a=gerenciar_cursos"> Cursos</a></li>
                        </ul>
                    </dd>
                    <dt><a class="navbar_item gerenciarIcon"  href="http://www.jquery.com ">jQuery</a></dt>
                    <dd>
                        <ul>
                            <li><a href="http://docs.jquery.com/Downloading_jQuery ">Download</a></li>
                            <li><a href="http://docs.jquery.com/ ">Documentação</a></li>
                            <li><a href="http://docs.jquery.com/Tutorials ">Tutoriais</a></li>
                        </ul>
                    </dd>
                </dl>
            </div>
            <div id="page-content" class="content">
                <div style="width:240px;float:right;background-color:#f8f8f8;padding:20px;border:1px solid #d0d0d0;">
                    MENU DA DIREITA 
                    <ul>
                        <li>Item 1</li>
                        <li>Item 2</li>
                        <li>Item 3</li>
                        <li>Item 4</li>
                        <li>Item 5</li>
                        <li>Item 6</li>
                        <li>Item 7</li>
                        <li>Item 8</li>
                        <li>Item 9</li>
                        <li>Item 10</li>
                        <li>Item 11</li>
                        <li>Item 12</li>
                        <li>Item 13</li>
                        <li>Item 14</li>
                        <li>Item 15</li>
                        <li>Item 16</li>
                        <li>Item 17</li>
                    </ul>
                </div>
                <div>
                    <!-- TEXTO 1 -->
                    <div style="border-bottom:1px solid #f0f0f0;padding-top:16px;padding-bottom:16px;">
                        <div style="overflow:hidden;margin-left:50px;margin-top:-5px;padding-right:25px;">
                            <div>
                                <label style="font-weight: 500;">Bem Vindo,</label>
                                <label style="margin-left:25px;">o que deseja fazer administrador?</label>
                                <div id="list_holder">
                                    <ul style="list-style: none;">
                                        <li>
                                            <a href="index.php?c=ead&a=gerenciar_cursos">
                                                <div class="list_index_admin_gray">
                                                    <div class="detalhe"></div><h3 class="h3_gray" >Gerenciar Cursos</h3><img  src="img/seta_gray.png" />
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="index.php?c=ead&a=gerenciar_usuarios">
                                                <div class="list_index_admin_blue">
                                                    <div class="detalhe1"></div>
                                                    <label class="h3_blue">Gerenciar Usuarios</label><img src="img/seta_blue.png" />
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>