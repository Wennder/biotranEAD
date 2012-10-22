<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">       
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>EAD Biotran</title>
        <script src="js/jquery.js" type="text/javascript"></script>  
        <script src="js/login.js" type="text/javascript"></script>  
        <script src="js/jqFancyTransitions.1.8.js" type="text/javascript"></script>
        <script type="text/javascript">
            function checarBotao(e)
            {
                if(e && e.keyCode == 13)
                {
                    document.forms[0].submit();
                }
            }
            $(document).ready(function(){
                 $('.n_selecionado').mouseover(function(){
        $('.selecionado').addClass('n_selecionado');
    });
    $('.n_selecionado').mouseout(function(){
        $('.selecionado').removeClass('n_selecionado');
    });
            });       
   
    
    
        </script>
    </head>
    
    <style>
        *{
            font:normal 16px/30px "eras ITC","eras medium ITC";
            margin:0;
            padding:0;
        }
        
        body{
            
            min-height: 600px;
            min-width: 960px;
        }
        
        html,body{
            height:100%;
        }
        
        #eadbiotran{
            hieght:100%;
            width:100%;
            min-width:960px;
        }
        
        #header{
            height:110px;
            background-image: url('img/header_ead_background.png');
/*            background-color: #2b5880;*/
        }
        
        #header *{
            color:white;
            font-size:22px;
            text-transform: lowercase;
            text-decoration: none;
        }
        
        #topmenu{
            position: relative;
            height: 100%;
        }
        
        #topmenu ul{
            position: relative;
            padding-top: 60px;
            
            list-style: none;
            float:right;
            text-align: center;
        }
        
        #topmenu ul li{
            display: inline;
            height: 50px;
            float:left;
           width:112px;
            
        }
       
        #topmenu ul li:hover{
            background-image: none;
            background-color: #ffffff;
            
        }
        
        #topmenu ul li:hover a{
            color:#333;
        }
       
        
       
        
#footer{
    height: 150px;
    clear: both;
            background-image: url('img/header_ead_background.png');
/*    background-color: #275175;*/
}

#content_footer{
    height: 150px;
    width: 980px;
    margin: 0 auto;
    position: relative;
}

.detalhe_right{
    background-image: url('img/dark_blue_detalhe_menu.png');
    width:1px;
    height:50px;
    float:right;
}
.detalhe_left{
    background-image: url('img/light_blue_detalhe_menu.png');
    width:1px;
    height:50px;
    float:left;
}


.menu_holder{
    padding:10px;float: left;text-align: center;
    position:relative;
    width:90px;
}

.selecionado{
   
    background-color: #ffffff;
    color:#333;
}

        
        #topmenu ul .selecionado a{
            color:#333;
        }

.n_selecionado{
    background-image: url('img/menu_header_background.png');
            background-repeat: repeat-x;
            color:#333;
}
#topmenu ul .n_selecionado a{
    color:white;
}

    </style>
    <body onLoad="self.focus();document.form_login.login.focus();">
        
        <div id="eadbiotran">
            
                <div id="header">
                    <div id="topmenu">
                        <img style="padding-top: 20px;" src="img/header.png"/>
                        <ul>
                            <li class="<?php echo $retorno = $_GET['a']=='' ? 'selecionado':'n_selecionado' ?>"><div class="menu_holder"><a href="index.php">HOME</a></div><div class="detalhe_right"></div></li>
                            <li class="<?php echo $retorno = $_GET['a']=='cursos' ? 'selecionado':'n_selecionado' ?>"><div class="detalhe_left"></div><div class="menu_holder"><a href="index.php?c=index&a=cursos">CURSOS</a></div><div class="detalhe_right"></div></li>
                            <li class="<?php echo $retorno = $_GET['a']=='fotos' ? 'selecionado':'n_selecionado' ?>"><div class="detalhe_left"></div><div class="menu_holder"><a href="index.php?c=index&a=contato">CONTATO</a></div><div class="detalhe_right"></div></li>
                            <li class="<?php echo $retorno = $_GET['a']=='index' ? 'selecionado':'n_selecionado' ?>"><div class="detalhe_left"></div><div class="menu_holder"><a href="index.php?c=index&a=fotos">FOTOS</a></div><div class="detalhe_right"></div></li>
                            <li class="<?php echo $retorno = $_GET['a']=='index' ? 'selecionado':'n_selecionado' ?>" ><div class="detalhe_left"></div><div class="menu_holder"><a href="http://www.biotran.com.br" target="_blank">BIOTRAN</a></div><div class="detalhe_right"></div></li>
                            <li class="<?php echo $retorno = $_GET['a']=='index' ? 'selecionado':'n_selecionado' ?>" ><div class="detalhe_left"></div><div class="menu_holder"><a href="index.php?c=index&a=cadastro" target="_blank">CADASTRO</a></div><div class="detalhe_right"></div></li>
                        </ul>
                    </div>
                    
                    <?php
                    /*if (isset($_SESSION["usuarioLogado"])) {
                        echo('
                            <div id="div_logado">
                                <table align="right">
                                    <tr>
                                        <td style="font-size: 15px;">
                                            Olá ' . $_SESSION["usuarioLogado"]->getNome_completo() . '!
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="index.php?c=ead&a=index" class="button">Acessar Biotran EAD</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        ');
                    } else {
                        echo('
                            <div id="div_login">
                                <form id="form_login" name="form_login" method="post" action="index.php?c=index&a=login">
                                    <table align="right">
                                        <tr>
                                            <td style="width: 230px;">
                                                <label style="color: #fff">E-mail: </label>
                                                <input id="login" name="login" type="text" size="25" tabindex="1"/>
                                            </td>
                                            <td style="width: 170px;">
                                                <label style="color: #fff">Senha: </label>
                                                <input id="senha" name="senha" type="password" size="15" onKeyPress="return checarBotao(event)" tabindex="2"/>
                                            </td>
                                            <td style="width: 60px;">
                                                <input id="button_login" type="button" name="button_login" value="Login"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div id="recuperar_senha" style=""><label>Esqueceu sua senha? <a href="index.php?c=index&a=recuperar_senha">Clique aqui</a></label></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div id="errorlogin" style="display: none;"><label>Usuário ou senha inválidos, tente novamente.</label></div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        ');
                    }
                    */?>
                </div>
