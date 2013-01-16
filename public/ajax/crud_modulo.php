<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerCurso.php';
include ROOT_PATH . '/app/controller/controllerModulo.php';


$acao = $_REQUEST['acao'] . 'Modulo';
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}

$controller = new controllerModulo();

if (method_exists($controller, $acao)) {
    $resposta = $controller->$acao($id);
} else {
    $resposta = false;
}

echo( json_encode($resposta));
?>
