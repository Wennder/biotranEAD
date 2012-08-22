<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/biotranEAD');
include ROOT_PATH . '/app/model/pdo/PDOConnectionFactory.class.php';
include ROOT_PATH . '/app/controller/controllerUsuario.php';
include ROOT_PATH . '/app/model/dao/UsuarioDAO.php';
include ROOT_PATH . '/app/model/vo/Usuario.php';

$login = $_REQUEST['login'];

$controller = new controllerUsuario();
$valores = $controller->validarLoginCadastro($login);

echo( json_encode($valores) );

?>