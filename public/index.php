<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'biotranEAD');
require '../library/Biotran/AutoLoad.php';
 
Biotran_AutoLoad::registrar();
Biotran_Mvc::pegarInstancia()->rodar();

?>