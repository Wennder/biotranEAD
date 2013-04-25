<?php

define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/biotranEAD');
include ROOT_PATH . '/app/model/pdo/PDOConnectionFactory.class.php';
include ROOT_PATH . '/app/controller/controllerUsuario.php';
include ROOT_PATH . '/app/controller/controllerCurso.php';
include ROOT_PATH . '/app/model/dao/CursoDAO.php';
include ROOT_PATH . '/app/model/dao/UsuarioDAO.php';
include ROOT_PATH . '/app/model/vo/Curso.php';
include ROOT_PATH . '/app/model/vo/Usuario.php';

//$id_input = $_GET['fieldId'];

$acao = $_GET['acao'];
$controller = $_GET['controller'];
$valor = $_GET[$acao];
$id = $_GET['id'];

$classe_controller = 'controller' . ucfirst(strtolower($controller));
$acao_controller = 'validar' . ucfirst(strtolower($acao));
$acaoGet_controller = 'get' . ucfirst(strtolower($controller));



if (class_exists($classe_controller)) {
    $controller = new $classe_controller;
    if (method_exists($controller, $acao_controller)) {
        if (method_exists($controller, $acaoGet_controller)) {  
                $valores = $controller->$acao_controller($valor, $id);
                //$valores = array($id_input, $controller->$acao_controller($valor, $id));                
        }
    }
}

echo( json_encode($valores) );
?>
