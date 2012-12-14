<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerCurso.php';
include ROOT_PATH . '/app/controller/controllerExercicio.php';
include ROOT_PATH . '/app/controller/controllerModulo.php';
session_start();

$controller = new controllerExercicio();
$id_perguntas = $_REQUEST['id_perguntas'];
$respostas = $_REQUEST['respostas'];
$id_exercicio = $_REQUEST['id_exercicio'];

//echo $id_perguntas . '-' . $respostas . '-' . $id_exercicio;die();

if (isset($_GET['acao'])) {
    if ($_GET['acao'] == 'corrigir') {
        $resposta = $controller->corrigirQuestionario(explode(';', $id_perguntas), explode(';', $respostas), $id_exercicio);
    }
    if ($_GET['acao'] == 'submeter') {
        $porc_acertos = $_REQUEST['porc_acertos'];
        $resposta = $controller->submeterQuestionario(explode(';', $id_perguntas), explode(';', $respostas), $id_exercicio, $porc_acertos);
    }
}
$r = json_encode($resposta);
echo($r);
?>
