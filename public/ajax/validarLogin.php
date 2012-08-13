<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'biotranEAD');
include ROOT_PATH . '/app/model/pdo/PDOConnectionFactory.class.php';
include ROOT_PATH . '/app/controller/ControllerSeguranca.php';
include ROOT_PATH . "/app/model/vo/Usuario.php";
include ROOT_PATH . '/app/model/vo/Papel.php';

header('Cache-Control: no-cache');
header('Content-type: application/xml; charset="utf-8"', true);

$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];

$controllerSeguranca = new ControllerSeguranca();
$valores = $controllerSeguranca->acaoValidarLogin_ajax($login, $senha);

echo( json_encode($valores) );

?>