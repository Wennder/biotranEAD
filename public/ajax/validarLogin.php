<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/biotranEAD');
include ROOT_PATH . '/app/model/pdo/PDOConnectionFactory.class.php';
include ROOT_PATH . '/app/controller/ControllerSeguranca.php';
include ROOT_PATH . "/app/model/vo/Usuario.php";
include ROOT_PATH . '/app/model/vo/Papel.php';
include ROOT_PATH . '/app/model/dao/UsuarioDAO.php';
include ROOT_PATH . '/app/model/dao/EnderecoDAO.php';
include ROOT_PATH . '/app/model/dao/PapelDAO.php';

$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];

$controllerSeguranca = new ControllerSeguranca();
$valores = $controllerSeguranca->actionValidarLogin_ajax($login, $senha);

echo( json_encode($valores) );

?>