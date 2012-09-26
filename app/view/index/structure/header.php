<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">       
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>EAD Biotran</title>
        <script src="js/jquery.js" type="text/javascript"></script>  
        <script src="js/login.js" type="text/javascript"></script>  
        <script src="js/jqFancyTransitions.1.8.js" type="text/javascript"></script>
<!--        <link rel='stylesheet' href='css/style.css' />-->

        <script type="text/javascript">
            function checarBotao(e)
            {
                if(e && e.keyCode == 13)
                {
                    document.forms[0].submit();
                }
            }
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
            min-width: 1024px;
        }
        
        #eadbiotran{
            hieght:100%;
            width:100%;
            
        }
        
        #header{
            height:110px;
            background-color: #275175;
        }
        
        #header *{
            color:white;
            font-size:22px;
            text-transform: lowercase;
            text-decoration: none;
        }
        
        #topmenu ul{
            position: relative;
            padding-top: 60px;
            padding-right: 25px;
            list-style: none;
            float:right;
        }
        
        #topmenu ul li{
            display: inline;
            margin-left:15px;
            foat:left;
        }
        
#footer{
    height: 150px;
    clear: both;
    background-color: #275175;
}

#content_footer{
    height: 150px;
    width: 980px;
    margin: 0 auto;
    position: relative;
}
    </style>
    <body onLoad="self.focus();document.form_login.login.focus();">
        
        <div id="eadbiotran">
            
                <div id="header">
                    <div id="topmenu">
                        <img style="padding-top: 20px;" src="img/header.png"/>
                        <ul>
                            <li><a href="index.php">HOME</a></li>
                            <li><a href="index.php?c=index&a=cursos">CURSOS</a></li>
                            <li><a href="index.php?c=index&a=contato">CONTATO</a></li>
                            <li><a href="index.php?c=index&a=fotos">FOTOS</a></li>
                            <li><a href="http://www.biotran.com.br" target="_blank">BIOTRAN</a></li>
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
