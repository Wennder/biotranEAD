<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>EAD Biotran</title>
        <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<!--        <script src="js/video.js"></script>-->
        <script src="js/jquery.form.js" type="text/javascript"></script>
        <script src="js/biotran.js" type="text/javascript"></script>
        <script src="js/accordion.js" type="text/javascript"></script>
        <script src="js/jquery.validate.js" type="text/javascript"></script>
        <script src="js/messages_pt_BR.js" type="text/javascript"></script>
        
        <link href='css/styleEAD.css' rel='stylesheet' type="text/css"/>
        <link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>
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
