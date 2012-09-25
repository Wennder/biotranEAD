<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php'; ?>
<script>
    $(document).ready( function(){
        $('#sliderShow').jqFancyTransitions({
            width: 650,
            height: 400,
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
    });
</script>

<style>
    #content_left_holder{
        margin:20px;

        /*        margin:20px 20px;*/
        border:1px solid #e3e3e3;
        background-color: #f7f7f7;
        padding: 20px;
        float:left;
    }

    #content_right_holder{
        float:right;
        padding:20px;
        width: 250px;
    }

    #slidershow{
        float:left;
    }

    #menu_destaque{
        float:right;
    }

    #menu_destaque ul{
        list-style: none;
    }

    #login_area{
        /*        margin:20px 20px;*/
        display: block;
        background-color: #f7f7f7;
        border:1px solid #e3e3e3;
    }

    #login_area input{
        clear:right;
    }

</style>
<div id="content_left_holder" style="">
    <div id='sliderShow'>
        <img src='img/biotran.jpg' />
        <img src='img/curso.jpg' />
        <img src='img/fazenda.jpg'/>
    </div>
    <div id="menu_destaque">
        <ul>
            <li style="margin-bottom: 12px;">
                <span class="destaque_item">
                    <a href="index.php?c=index&a=cadastro">Cadastre-se</a>
                </span>
            </li>
            <li style="margin-bottom: 12px;">
                <span class="destaque_item">
                    <a href="#">Matricule-se</a>
                </span>
            </li>
            <li style="margin-bottom: 12px;">
                <span class="destaque_item">
                    <a href="#">Veja como é</a>
                </span>
            </li>
            <li>
                <span class="destaque_item">
                    <a href="#">Cursos Presenciais</a>
                </span>
            </li>
        </ul>
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
            echo('
                            <div id="div_login">
                                <form id="form_login" name="form_login" method="post" action="index.php?c=index&a=login">
                                    
                                                <label style="">E-mail: </label>
                                                <input id="login" name="login" type="text" size="25" />
                                            
                                            
                                                <label style="">Senha: </label>
                                                <input id="senha" name="senha" type="password" size="15" onKeyPress="return checarBotao(event)" />
                                            
                                            
                                                <input id="button_login" type="button" name="button_login" value="Login"/>
                                            
                                        
                                            
                                                <div id="recuperar_senha" style=""><label> <a href="index.php?c=index&a=recuperar_senha">Esqueceu a senha?</a></label></div>
                                            
                                        
                                        
                                            
                                                <div id="errorlogin" style="display: none;"><label>Usuário ou senha inválidos, tente novamente.</label></div>
                                            
                                        
                                    
                                </form>
                            </div>
                        ');
        }
        ?>
    </div>
    <div id="pratocinadores_holder">

    </div>
</div>

<?php require 'structure/content_down.php'; ?>

<?php require 'structure/footer.php'; ?>
