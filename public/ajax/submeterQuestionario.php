<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerExercicio.php';
session_start();

$controller = new controllerExercicio();
$id_perguntas = $_REQUEST['id_perguntas'];
$respostas = $_REQUEST['respostas'];
$id_exercicio = $_REQUEST['id_exercicio'];

if (isset($_GET['acao'])) {
    if ($_GET['acao'] == 'corrigir') {
        $resposta = $controller->corrigirQuestionario(explode(';', $id_perguntas), explode(';', $respostas), $id_exercicio);
    }
    if ($_GET['acao'] == 'submeter') {
        $porc_acertos = $_REQUEST['porc_acertos'];
        $resposta = $controller->submeterQuestionario(explode(';', $id_perguntas), explode(';', $respostas), $id_exercicio, $porc_acertos);
    }
}

echo( json_encode($resposta));
?>
