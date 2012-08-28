<?php
//ini_set('default_charset','UTF-8');

require "../library/Biotran/importar_app.php";

Biotran_AutoLoad::registrar();
Biotran_Mvc::pegarInstancia()->rodar();

?>
