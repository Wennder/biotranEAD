<?php

include '../../library/Biotran/importar_app.php';

include ROOT_PATH . '/app/controller/controllerUsuario.php';
require ROOT_PATH . '/library/phpmailer/class.phpmailer.php';

$controller = new ControllerSeguranca();

$email = $_REQUEST["email"];
$cpf_passaporte = $_REQUEST["cpf_passaporte"];
$resposta = $controller->actionEnviarSenhaEmail($email, $cpf_passaporte);

echo( json_encode($resposta) );
?>
