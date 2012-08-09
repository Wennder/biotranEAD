<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login</title>
    </head>
    <body>
        <div id="login" >
            <table width="520" border="0" style="margin: 0 auto;">
                <tr align="center">
                    <td colspan="3"><h1>Sistema de Controle CEAD</h1></td>
                <tr align="center">
                    <td width="140" rowspan="2" align="center"><div id="unifal" style="margin: 0"></div></td>
                    <td width="220"><h2>Login de Acesso</h2></td>
                    <td width="160" rowspan="2" align="right"><div id="cead" style="margin: 0"></div></td></tr>
                </tr>
                <tr>
                    <td align="center">
                        <form id="form1" name="form1" action="index.php?c=index&a=login" method="post">
                            <table width="200" border="0" align="center">
                                <tr>
                                    <td><div style="font-size: 14px;">Usuário: </div></td>
                                    <td><label>
                                            <input type="text" name="login" size="100"/>
                                        </label></td>
                                </tr>
                                <tr>
                                    <td><div style="font-size: 14px;">Senha: </div></td>
                                    <td><label>
                                            <input type="password" name="senha" />
                                        </label></td>
                                </tr>
                                <tr>
                                    <th colspan="2"><label><input type="submit" value="Entrar" /></label></th>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
                <tr align="center"><td><div id="message"></div></td></tr>
            </table>
        </div>
        <div id="footer" >
            <p>Copyright &copy; 2011 - Desenvolvido por <a href="http://cead.unifal-mg.edu.br" target="_blank" title="Cead home page">CEAD</a></p>
        </div>
    </body>
</html>