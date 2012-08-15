<?php
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'biotranEAD');
include ROOT_PATH . "/app/model/pdo/PDOConnectionFactory.class.php";
include ROOT_PATH . '/app/model/vo/Usuario.php';
include ROOT_PATH . '/app/model/vo/Endereco.php';
include ROOT_PATH . '/app/model/vo/Papel.php';
include ROOT_PATH . '/app/model/vo/Curso.php';
include ROOT_PATH . '/app/model/dao/UsuarioDAO.php';
include ROOT_PATH . '/app/model/dao/CursoDAO.php';
include ROOT_PATH . '/app/model/dao/EnderecoDAO.php';
include ROOT_PATH . '/app/model/dao/PapelDAO.php';
require ROOT_PATH . '/library/Biotran/AutoLoad.php';
 
Biotran_AutoLoad::registrar();
Biotran_Mvc::pegarInstancia()->rodar();

?>