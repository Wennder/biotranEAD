<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php'; ?>
<script>
    function resizing(){
        var width = $('#content_left_holder').width();
         width += $('#content_right_holder').width();
         width += 600;
//var width = $(window).width() -100;
         width+=300;
         var center = width;
//         alert(width);
          center -=460;
          if(center>600){
              center+='px';
              $('#content_center_holder').css('width',center);
          }
         $('#content_fit').css('width', width);
         
         if(width>1024)
            $('body').css('min-width', width);  
         
         width = -(width/2);
         width+='px';
         
//         alert(width);
         $('#content_fit').css('margin-left', width);
        }
    $(document).ready( function(){
        $('#sliderShow').jqFancyTransitions({
            width: 500,
            height: 308,
            delay: 5000,
            effect: 'zipper', //zipper, wave, curtain, fountain top, random top, curtain alternate, felt top, right bottom
            strips: 20,
            stripDelay: 50,
            titleOpacity: 0.7,
            titleSpeed: 1000,
            navigation: false,
            position: 'alternate', // top, bottom, alternate, curtain
            direction: 'random', // left, right, alternate, random, fountain, fountainAlternate
            links: false
        });
        
        resizing();
    $(window).bind('resize', resizing);
//        var width = $(window).width();
//
//        width+='px';
//        $('#content_fit').css('width', width);
resizing();
    });
</script>

<style>
    body{
        min-width: 1024px;
    }
    #content_right_holder{
        overflow: auto;
        padding:12px;
        float:left;
        clear:right;
        height: 100%;
    }
    #sliderShow{

        float: left;
        border:3px solid #275175;
    }
    #content_left_holder{
        padding:12px;
        float:left;
     
    }

    #content_center_holder{
        border-left: 1px solid #CCC;

        float:left;

        min-width:600px;

        

        height:100%;
        border-right: 1px solid #CCC;
        box-shadow: 2px 2px 2px #888888; 
        -webkit-box-shadow:2px 2px 2px #888888;
        -moz-box-shadow:2px 2px 2px #888888;
        -ms-box-shadow:2px 2px 2px #888888;
        -o-box-shadow: 0 1px 0 0 #3871a1 inset;
    }

    #sliderShow{
        position:relative;
        left:50%;
        margin-left: -252px;
    }

    h4{
        color:#7a7a7a;
        font-size:18px;
        font-weight:600;
        padding-right: 3px;
    }

    #content_up{
        
        padding:20px 0px;
    }

    #button_login{
        background-color: #23496a;
        /*    background: -webkit-gradient(linear, left top, left bottom, from(#23056a), to(#23496a));
            background: -webkit-linear-gradient(top, #23056a, #23496a);
            background: -moz-linear-gradient(top, #23056a, #23496a);
            background: -ms-linear-gradient(top, #23056a, #23496a);
            background: -o-linear-gradient(top, #23056a, #23496a);
            background: linear-gradient(top, #23056a, #23496a);*/
        border: 1px solid #1b3952;    
        border-bottom: 1px solid #23496a;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        -ms-border-radius: 3px;
        -o-border-radius: 3px;
        box-shadow: 2px 2px 2px #888888, inset 0 1px 0 0 #3871a1;
        -webkit-box-shadow:2px 2px 2px #888888, 0 1px 0 0 #3871a1 inset ;
        -moz-box-shadow:2px 2px 2px #888888, 0 1px 0 0 #3871a1 inset;
        -ms-box-shadow:2px 2px 2px #888888, 0 1px 0 0 #3871a1 inset;
        -o-box-shadow: 0 1px 0 0 #3871a1 inset;
        color: white;
        font-size:15px;
        font-weight: 500;
        padding: 3px 15px;
        text-align: center;

        z-index:5;

    }

    ul{
        list-style: none;
    }


    #titulo_parceiros{
        background-color: #275175;
    }

    #menu_destaque{
        min-width: 320px;
        width:40%;
        min-height: 400px;
        float: left;
        color: #CCCCCC;
        padding-top:20px;
        padding-left:0px;
    }

    #menu_destaque ul{
        list-style-type:none;
        margin:0px;
        padding:0px;
        width:100%;
        position: relative;
    }

    #menu_destaque li{
        height: 91px;
        min-width: 320px;
    }

    /*    #menu_destaque li:hover{
            background-color: #275175;
            color: #fff;
            border-radius: 0px 5px 5px 0px;
                -moz-border-radius:10px 10px 10px 10px;
                -webkit-border-radius:10px 10px 10px 10px;
        }
        #menu_destaque li:hover a{
         
            color: #fff;
          text-shadow:-1px 1px 0px #000;
                -moz-border-radius:10px 10px 10px 10px;
                -webkit-border-radius:10px 10px 10px 10px;
        }*/

    #menu_destaque ul a {
        /*        height: 91px;*/
        min-width: 320px;
        width:100%;
        position: absolute;
        color: #275175;
        text-decoration: none;
        text-align: center;
        font-size: 32px;
        font-weight: bold;
        padding: 25px 10px;

        text-shadow:-1px 1px 0px #CCC;
    }

    #menu_destaque ul  a:hover {
        color: #fff;
        text-shadow:-1px 1px 0px #000;
        background-color: #275175;
    }

    #button_login{
        float:right;
    }
    #recuperar_senha{
        float:left;
    }

    #news_holder{
        clear: both;
        padding-top:20px;
    }

    #news_image{
        height: 48px;
        width:183px;
        position: absolute;
        z-index: 3;
        left:10px;
        background-image: url('img/news_background.png')  ;

    }

    #list_news{
        background: white;
        border:1px solid #e3e3e3;
        height: 300px;
        padding:0px 10px;
    }

    #indice_news{
        width: 100%;
        text-align: center;
    }

    #indice_news h4{
        float:left;
    }

    #patrocinadores_holder{

        margin-top:20px;
    }

    .titulo_holder{
        padding:4px 0px;
        width:200px;
        border-radius: 5px;
        /*        background-color: black;*/

        background: -webkit-gradient(linear, left top, left bottom, from(#0069b5), to(#0564aa));
        background: -webkit-linear-gradient(top, #0069b5, #0564aa);
        background: -moz-linear-gradient(top, #0069b5, #0564aa);
        background: -ms-linear-gradient(top, #0069b5, #0564aa);
        background: -o-linear-gradient(top, #0069b5, #0564aa);
        background: linear-gradient(top, #0069b5, #0564aa);
    }

    .titulo_holder{
        color:white;
        text-align: center;
    }

    li{
        min-height: 30px;
    }

    #form_login ul li h4{
        font-size:16px;
        float:left;
    }

    #div_login{
       
       padding:5px 10px;
        min-height:220px;
        width:160px;
        background-color: #EEE;
        border:1px solid #CCC;
       margin-top:10px;
       margin-left: 10px;
    }

    #coments{
        height:250px;
        width:180px;
        background-color: #EEE;
        border:1px solid #CCC;
        margin:10px 0px 10px 10px;
    }


</style>
<!--<div style="float:left; width:5%; height:100%;"></div>-->
<!--<div style="float:right; width:5%; height:100%;"></div>-->
<div id="content_fit" style="  height: 100%; position:relative; left:50%;">
    <div id="content_left_holder" style="">
        <div >
            <div class="titulo_holder">Parceiros</div>
            <img style="margin:10px 0px 10px 10px" src="img/tribit.jpg" />
        </div>
        <div>
            <div class ="titulo_holder">Comentarios</div>
            <div id="coments">

            </div>
        </div>
    </div>
    <div id="content_center_holder">
        <div id='sliderShow'>
            <img src='img/biotran.jpg' />
            <img src='img/curso.jpg' />
            <img src='img/fazenda.jpg'/>
        </div>


    </div>
    <div id="content_right_holder">
        <div id="login_area">
            <?php
            if (isset($_SESSION["usuarioLogado"])) {
                echo('
                            <div id="div_logado">
                                
                                            Olá ' . $_SESSION["usuarioLogado"]->getNome_completo() . '!
                                        
                                    
                                            <a href="index.php?c=ead&a=index" class="button">Acessar Biotran EAD</a>
                                     
                                
                            </div>
                        ');
            } else {
                echo('          <div class="titulo_holder">Login</div>
                            <div id="div_login" style="">
                                <form id="form_login" name="form_login" method="post" action="index.php?c=index&a=login">
                                    <ul style="display:block;"><li>
                                                <h4 style="">E-mail: </h4>
                                                <input id="login" name="login" type="text" size="20" />
                                            </li>
                                            <li >
                                                <h4 style="">Senha: </h4>
                                                <input style="margin-bottom:20px;" id="senha" name="senha" type="password" size="20" onKeyPress="return checarBotao(event)" />
                                            </li>
                                            <li>
                                                <div id="recuperar_senha" style=""><label> <a style="font-size:14px;" href="index.php?c=index&a=recuperar_senha">Esqueceu a senha?</a></label></div>
                                                <input id="button_login" type="button" name="button_login" value="Login"/>
                                                <a href="">registrar</a>
                                            </li>
                                        </ul>
                                    
                                </form>
                            </div>
                        ');
            }
            ?>
        </div>

<!--        <div class="titulo_holder">Facebook</div>
        <div class="titulo_holder">Twitter</div>-->
    </div>
</div>

<?php require 'structure/footer.php'; ?>
