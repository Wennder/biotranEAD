<?php

define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/biotranEAD');
include ROOT_PATH . '/app/model/pdo/PDOConnectionFactory.class.php';
include ROOT_PATH . '/app/controller/controllerCurso.php';
include ROOT_PATH . '/app/model/dao/CursoDAO.php';
include ROOT_PATH . '/app/model/vo/Curso.php';

$nome = $_REQUEST['nome'];

$controller = new controllerCurso();
$valores = $controller->validarCurso($nome);

echo( json_encode($valores) );





?>
