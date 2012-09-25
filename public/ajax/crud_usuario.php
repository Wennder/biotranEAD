<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerUsuario.php';
include ROOT_PATH . '/app/controller/controllerEndereco.php';

$acao = $_GET['acao'] . 'Usuario_post';

$controller = new controllerUsuario();
$id_usuario = $_POST['id'];

if(method_exists($controller, $acao)) {
    $resposta = $controller->$acao($id_usuario);
}else{
    $resposta = false;
}

echo( json_encode($resposta) );
?>
