<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <title>EAD Biotran</title>
        <!--<script src="js/accordion.js" type="text/javascript"></script>-->
        <link href="css/video-js.css" rel="stylesheet" type="text/css"/>        
        <script src="js/video.js"></script>                
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/menuDropDown.js" type="text/javascript"></script>                        
<!--        <script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> -->
        
        <script type="text/javascript">
//            _V_.options.flash.swf = "video-js.swf";
            function resize_content_fluid(){
                var height = $('.content').height();
              
                if(height < $(window).height()){
                    height+=75;
                    height +='px';
                    $(".content_fluid").css('height',height);
                }
              
                

            }
             
            $(document).ready(function(){
                //                resize_content_fluid();
                //                $(window).bind('resize', resize_content_fluid);

                //                
                //                //                $('#page-leftcolumn').css('height',$height );
                //                //                
                //                //
                //                //                $('#right_menu_holder').css('height', $height );
                //                
                //                $right = $('#right_menu_holder').css('height');
                //                
                //                $right_num = parseInt($right);
                //                $right_num-=25;
                //                
                //               
                //                
                //                $('#right_menu_holder').css('height', $right_num );
                
//                $(".eadbiotran_topbar").disableSelection();
                // Fecha a aba se clicado fora
                //                alert($('#page-leftcolumn').css('height') );
                //                alert($('#right_menu_holder').css('height') );
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
