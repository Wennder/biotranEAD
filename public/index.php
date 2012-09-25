<?php
require "../library/Biotran/importar_app.php";
//define classe tratadora de erros
set_error_handler('customerErros');
define('default_charset', 'utf-8');
Biotran_AutoLoad::registrar();
Biotran_Mvc::pegarInstancia()->rodar();

?>
