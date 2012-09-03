<?php

define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/biotranEAD');
include ROOT_PATH . '/app/model/pdo/PDOConnectionFactory.class.php';
include ROOT_PATH . '/app/controller/controllerUsuario.php';
include ROOT_PATH . '/app/model/dao/UsuarioDAO.php';
include ROOT_PATH . '/app/model/vo/Usuario.php';

$cpf_passaporte = $_REQUEST['cpf_passaporte'];

$controller = new controllerUsuario();
$valores = $controller->validarCpf_passaporteCadastro($cpf_passaporte);

echo( json_encode($valores) );

?>