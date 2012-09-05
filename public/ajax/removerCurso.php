<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/biotranEAD');
include ROOT_PATH . '/app/model/pdo/PDOConnectionFactory.class.php';
include ROOT_PATH . '/app/controller/controllerCurso.php';
include ROOT_PATH . "/app/model/vo/Curso.php";
include ROOT_PATH . '/app/model/dao/CursoDAO.php';

$id_curso = $_REQUEST["id_curso"];

$condicao = "id_curso=".$id_curso;

$controllerCurso = new controllerCurso();
$curso = $controllerCurso->getCurso($condicao);

$resposta = $controllerCurso->removerCurso($curso);

echo( json_encode($resposta) );
   
?>
