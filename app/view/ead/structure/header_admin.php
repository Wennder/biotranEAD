<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>        
        <meta http-equiv="Content-Type" content="NO-CACHE; text/html; charset=utf8" />
        <title>EAD Biotran</title>
        <link href="css/video-js.css" rel="stylesheet" type="text/css"/>        
        <script src="js/video.js"></script>                
        <link href="css/jquery-ui-1.8.24.custom.css" rel="stylesheet" type="text/css"/>   
        <script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <link href="css/jquery.dialog.css" rel="stylesheet" type="text/css"/>        
        <script src="js/jquery.js"></script> 
        <script type="text/javascript" src="js/jquery.form.js"></script>
        <script src="js/accordion_1.js" type="text/javascript"></script>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/menuDropDown.js" type="text/javascript"></script>                        
        <script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>
<!--        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> -->
        <style>
            @import "http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css";
        </style>
        <script type="text/javascript">
            //            _V_.options.flash.swf = "video-js.swf";
            var centro = 1;
            var dialog;
            
            function resize_content_fluid(){
                var height = $('.content').height();
              
                if(height < $(window).height()){
                    height+=75;
                    height +='px';
                    $(".content_fluid").css('height',height);
                }              
            }

            $(document).ready(function(){                
                document.onClick = comprimir();
            });
                
        </script>

        <link rel='stylesheet' href='css/estilos.css' />

        <style>
            #page-content{
                padding:20px;
            }
        </style>
    </head>
    <body>
        <div id="dialog" style="display:none">
        </div>
        <div id="dialog_video" style="display:none">
        </div>
        <div id="main">
            <div class="eadbiotran_topbar">
                <div class="eadbiotran_navbar_container">
                    <ul>
                        <li>
                            <div id="pic_holder">
                                <img src="img/profile/pic/<?php
$this->usuario = $_SESSION['usuarioLogado'];
if ($this->usuario == null) {
    echo '00.jpg';
} else if (file_exists('img/profile/' . $this->usuario->getId_usuario() . '.jpg')) {
    echo $this->usuario->getId_usuario() . '.jpg';
} else {
    echo '00.jpg';
}
?>"  />
                            </div>
                        </li>
                        <li style="margin-top:15px;">
                            <h2 >
                                <?php echo $_SESSION["usuarioLogado"]->getNome_completo(); ?>
                            </h2>
                        </li>
                        <li style="margin: 0px 7px; margin-top:15px;">
                            -
                        </li>
                        <li style="margin-top:15px;">
                            <h3>
                                <?php
                                $papel = $_SESSION["usuarioLogado"]->getId_papel();
                                if ($papel == 1) {
                                    echo 'administrador';
                                } else if ($papel == 2) {
                                    echo 'gestor';
                                } else if ($papel == 3) {
                                    if ($_SESSION["usuarioLogado"]->getSexo() == 'Masculino') {
                                        echo 'professor';
                                    } else {
                                        echo 'professora';
                                    }
                                } else if ($papel == 4) {
                                    echo 'aluno';
                                }
                                ?>
                            </h3>
                        </li>
                        <li style="float:right;clear:right; margin:0px 15px; margin-top:15px;">
                            <img src="img/settings.png" id="settings" onclick="expandir('#menuDrop')" />

                        </li>
                        <li style="float:right; margin-top:15px;">
                            <h2>EAD Biotran</h2>
                        </li>
                        <div id="menuDrop"
                             onmouseover="zerarCronometro()" 
                             onmouseout="iniciarCronometro()">
                            <ul >
                                <li>
                                    <a  href="index.php?c=ead&a=profile&id=<?php echo $_SESSION["usuarioLogado"]->getId_usuario(); ?>">Perfil</a>

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
