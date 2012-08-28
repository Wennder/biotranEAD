<?php

/*
 * Arquivo de importação da pasta app do projeto.
 * Contém apenas comandos de importação
 */

define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/biotranEAD');
include ROOT_PATH . "/app/model/pdo/PDOConnectionFactory.class.php";
include ROOT_PATH . '/app/model/vo/Usuario.php';
include ROOT_PATH . '/app/model/vo/Endereco.php';
include ROOT_PATH . '/app/model/vo/Papel.php';
include ROOT_PATH . '/app/model/vo/Curso.php';
include ROOT_PATH . '/app/model/vo/Curso_professor.php';
include ROOT_PATH . '/app/model/dao/UsuarioDAO.php';
include ROOT_PATH . '/app/model/dao/CursoDAO.php';
include ROOT_PATH . '/app/model/dao/Curso_professorDAO.php';
include ROOT_PATH . '/app/model/dao/EnderecoDAO.php';
include ROOT_PATH . '/app/model/dao/PapelDAO.php';
include ROOT_PATH . '/app/model/dao/Papel_paginaDAO.php';
include ROOT_PATH . '/app/controller/ControllerSeguranca.php';
require ROOT_PATH . '/library/Biotran/AutoLoad.php';
require ROOT_PATH . '/library/Biotran/mvc/view.php';
require ROOT_PATH . '/library/Biotran/mvc/controller.php'; 
include ROOT_PATH . '/library/wideimage/lib/WideImage.inc.php';


?>
