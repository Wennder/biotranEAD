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
                                
                                            <h3>Olá ' . $_SESSION["usuarioLogado"]->getNome_completo() . '!</h3>
                                        
                                    
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
                                                <a href="index.php?c=index&a=cadastro">registrar</a>
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
