<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerExercicio.php';
include ROOT_PATH . '/app/controller/controllerModulo.php';

$acao = $_GET['acao'] . '_exercicio';
$param='';
if (isset($_REQUEST['id'])) {
    $param = $_REQUEST['id'];
} else {
    if (isset($_POST['id'])){
        $param = $_POST['id'];
    }
}


$controller = new controllerExercicio();

if (method_exists($controller, $acao)) {
    $resposta = $controller->$acao($param);
} else {
    $resposta = false;
}

echo( json_encode($resposta));
?>
