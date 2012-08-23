<?php
include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/ControllerIndex.php';

$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];

$controller= new ControllerIndex();
$valores = $controller->actionLogin_ajax($login, $senha);

echo( json_encode($valores) );

?>