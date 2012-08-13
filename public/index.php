<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'biotranEAD');
include ROOT_PATH . '/app/model/pdo/PDOConnectionFactory.class.php';
require '../library/Biotran/AutoLoad.php';
 
Biotran_AutoLoad::registrar();
Biotran_Mvc::pegarInstancia()->rodar();

?>