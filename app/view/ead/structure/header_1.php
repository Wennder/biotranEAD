<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        <link rel='stylesheet' href='css/estilos.css' />
        <style>
            .eadbiotran_topbar{
                position:relative;
                height:75px;
                background-image: url('img/header_ead_background.png');
            }
            
            .eadbiotran_navbar_container{
                position:relative;
                height:100%;
                
            }
            
            .eadbiotran_navbar_container *{
                color:white;
                font-size: 26px;
                
            }
            
            .eadbiotran_navbar_container h3{
                font-size: 20px;
            }
            
            .eadbiotran_navbar_container ul{
                float:left;
                width:100%;
                padding:0;
                margin:0;
                list-style-type:none;
            }
            
            .eadbiotran_topbar ul li{
                float:left;
                display:inline;
            }
            
            #pic_holder{
                padding:4px;
                background-image: url('img/dark_blue_ead.png');
                margin: 0px 15px;
            }
            
            .eadbiotran_navbar_container ul{
                margin: 10px 0px;
            }
            
            #menuDrop{
                display: none;
                position: absolute;
                right:10px;
                top:65px;
                
                z-index: 3;
                background-color: white;
                border:1px solid #eeeeee;
                padding:10px 30px;
                
            }
            
            #menuDrop a{
                color:black;
            }
            
            #menuDrop a:hover,a:visited, a:active, a:link{
                font-size:18px;
                font-weight: 500;
                line-height: 100%;
                text-decoration: none;
            }
            
            #menuDrop li{
                display:block;
                float:none;
            }
            
            #settings:hover{
                cursor:pointer;
                clear:right;
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
                            <img src="img/profile/pic/00.jpg" />
                        </div>
                    </li>
                    <li style="margin-top:15px;">
                        <h2 >
                            Chuck Norris
                        </h2>
                    </li>
                    <li style="margin: 0px 7px; margin-top:15px;">
                         -
                    </li>
                    <li style="margin-top:15px;">
                        <h3>
                            administrador
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
