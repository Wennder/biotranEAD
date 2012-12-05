<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/ControllerForum.php';

$acao = $_GET['acao'];
if (isset($_REQUEST['id_usuario'])) {
    $id_usuario = $_REQUEST['id_usuario'];
} else {
    $id_usuario = $_POST['id'];
}

$controller = new ControllerForum();

if (method_exists($controller, $acao)) {
    $resposta = $controller->$acao($id_usuario);
} else {
    $resposta = false;
}

echo(json_encode($resposta));
?>
