<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerExercicio.php';
include ROOT_PATH . '/app/controller/controllerModulo.php';

$acao = strtolower($_GET['acao']);
$param='';
if (isset($_REQUEST['id_exercicio'])) {
    $param = $_REQUEST['id_exercicio'];
} else {
    if (isset($_POST['id_exercicio'])){
        $param = $_POST['id_exercicio'];
    }
    if(isset($_POST['id_pergunta'])){
        $param = $_POST['id_pergunta'];
    }
}


$controller = new controllerExercicio();

if (method_exists($controller, $acao)) {
    $resposta = $controller->$acao($param);
} else {
    echo $acao;
    $resposta = false;
}

echo json_encode($resposta);
?>
