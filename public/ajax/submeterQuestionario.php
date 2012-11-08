<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerExercicio.php';
session_start();
$controller = new controllerExercicio();
$id_perguntas = $_REQUEST['id_perguntas'];
$respostas = $_REQUEST['respostas'];
$resposta = $controller->submeterQuestionario(explode(';',$id_perguntas), explode(';', $respostas));

echo( json_encode($resposta));
?>
