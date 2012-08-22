<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">       
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>EAD Biotran</title>
        <script src="js/jquery.js" type="text/javascript"></script>  
        <script src="js/login.js" type="text/javascript"></script>  
        <script src="js/jqFancyTransitions.1.8.js" type="text/javascript"></script>
        <link rel='stylesheet' href='css/style.css' />
        <script>
            function mostrarErro(){
                if($("#i_errorlogin") == 1){
                   $("errorlogin").show();
                }
                else{
                    $("errorlogin").hide();
                }
            }
        </script>
    </head>
    <body>
        <div id="eadbiotran">
            <div id="main">
                <div id="header">
                    <div id="topmenu">
                        <ul>
                            <li><a href="<?php echo "index.php" ?>">HOME</a></li>
                            <li><a href="<?php echo "index.php?c=index&a=cursos" ?>">CURSOS</a></li>
                            <li><a href="<?php echo "index.php?c=index&a=contato" ?>">CONTATO</a></li>
                            <li><a href="<?php echo "index.php?c=index&a=fotos" ?>">FOTOS</a></li>
                            <li><a href="http://www.biotran.com.br" target="_blank">BIOTRAN</a></li>
                        </ul>
                    </div>
                    <div id="div_login">
                        <form id="form_login" method="post" action="index.php?c=index&a=login">
                            <table align="right">
                                <tr>
                                    <td style="width: 220px;">
                                        <label style="color: #fff">E-mail: </label>
                                        <input id="login" name="login" type="text" size="25"/>
                                    </td>
                                    <td style="width: 170px;">
                                        <label style="color: #fff">Senha: </label>
                                        <input id="senha" name="senha" type="text" size="15"/>
                                    </td>
                                    <td style="width: 60px;">
                                        <input id="button_login" type="submit" name="button_login" value="Login"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div id="errorlogin" style="display: none;"><label>Usuário e/ou senha inválidos, tente novamente.</label></div>
                                        <div style="display: none;"><input type="text" id="i_errorlogin" value="<?php echo $this->invalidado; ?>" /></div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
