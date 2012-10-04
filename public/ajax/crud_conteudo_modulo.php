<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerModulo.php';
include ROOT_PATH . '/app/controller/controllerVideo.php';
include ROOT_PATH . '/app/model/dao/VideoDAO.php';
include ROOT_PATH . '/app/model/vo/Video.php';

$metodo = $_GET['acao'];

//$id_modulo = $_GET['id_modulo'];

$controller = new controllerModulo();

if (method_exists($controller, $metodo)) {
    /* @var $id_modulo type */
    $resposta = $controller->$metodo();
} else {
    $resposta = false;
}

echo( json_encode($resposta));
?>
