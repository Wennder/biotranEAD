<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">       
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>EAD Biotran</title>
        <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="js/jquery.carouFredSel-6.1.0.js" type="text/javascript"></script> 
        <script src="js/login.js" type="text/javascript"></script>
        <script src="js/jqFancyTransitions.1.8.js" type="text/javascript"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="eadbiotran">
            <div id="header">
                <div id="div_logo"></div>
                <div id="topmenu">
                    <ul>
                        <li><a class="<?php echo $_GET['a']=='' ? 'itemSelecionado':'itemNaoselecionado'?>" href="index.php">HOME</a></li>
                        <li><a class="<?php echo $_GET['a']=='cursos' ? 'itemSelecionado':'itemNaoselecionado'?>" href="index.php?c=index&a=cursos">CURSOS</a></li>
                        <li><a class="<?php echo $_GET['a']=='contato' ? 'itemSelecionado':'itemNaoselecionado'?>" href="index.php?c=index&a=contato">CONTATO</a></li>
                        <li><a class="<?php echo $_GET['a']=='fotos' ? 'itemSelecionado':'itemNaoselecionado'?>" href="index.php?c=index&a=fotos">FOTOS</a></li>
                        <li><a href="http://www.biotran.com.br" target="_blank">BIOTRAN</a></li>
                    </ul>
                </div>
                <?php
                if (isset($_SESSION["usuarioLogado"])) {
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
                                        <a href="index.php?c=ead&a=index" class="button2">Acessar Biotran EAD</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    ');
                } else {
                    echo('
                        <div id="div_login">
                            <form id="form_login" method="post" action="index.php?c=index&a=login">
                                <table align="right">
                                    <tr>
                                        <td style="width: 240px;">
                                            <label style="color: #fff">E-mail: </label>
                                            <input id="login" name="login" type="text" size="25"/>
                                        </td>
                                        <td style="width: 180px;">
                                            <label style="color: #fff">Senha: </label>
                                            <input id="senha" name="senha" type="password" size="15"/>
                                        </td>
                                        <td style="width: 60px;">
                                            <input id="button_login" type="button" name="button_login" class="button2" value="Login"/>
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
                ?>
            </div>
            <div id="main">
                