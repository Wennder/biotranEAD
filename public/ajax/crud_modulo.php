<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerCurso.php';
include ROOT_PATH . '/app/controller/controllerModulo.php';

$acao = $_GET['acao'] . 'Modulo';
if (isset($_REQUEST['id_curso'])) {
    $id_curso = $_REQUEST['id_curso'];
}
if (isset($_REQUEST['id_modulo'])) {
    $id_modulo = $_GET['id_curso'];
}

$controller = new controllerModulo();

if (method_exists($controller, $acao)) {
    $resposta = $controller->$acao($id_curso);        
} else {
    $resposta = false;
}

echo( json_encode($resposta));
?>
