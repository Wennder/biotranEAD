<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/biotranEAD');
include ROOT_PATH . '/app/model/pdo/PDOConnectionFactory.class.php';
include ROOT_PATH . '/app/controller/controllerUsuario.php';
include ROOT_PATH . "/app/model/vo/Usuario.php";
include ROOT_PATH . '/app/model/dao/UsuarioDAO.php';
include ROOT_PATH . '/app/model/dao/EnderecoDAO.php';

$id_usuario = $_REQUEST["id_usuario"];

$condicao = "id_usuario=".$id_usuario;

$controllerUsuario = new controllerUsuario();
$user = $controllerUsuario->getUsuario($condicao);

$resposta = $controllerUsuario->removerUsuario($user);

echo( json_encode($resposta) );


    
?>
