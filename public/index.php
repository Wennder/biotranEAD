<?php
require "../library/Biotran/importar_app.php";

Biotran_AutoLoad::registrar();
Biotran_Mvc::pegarInstancia()->rodar();

?>
