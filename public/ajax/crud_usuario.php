<?php
include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerUsuario.php';
include ROOT_PATH . '/app/controller/controllerEndereco.php';

$controller = new controllerUsuario();
$id_usuario = $_POST['id'];

$resposta = $controller->atualizarUsuario_post($id_usuario);

echo( json_encode($resposta) );


?>
