<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerUsuario.php';
include ROOT_PATH . '/app/controller/controllerCurso.php';

$acao = $_GET['acao'] . 'Curso';
if (isset($_REQUEST['id_curso'])) {
    $id_curso = $_REQUEST['id_curso'];
} else {
    echo (json_encode(3));
}

$controller = new controllerCurso();

if (method_exists($controller, $acao)) {
    if ($_GET['acao'] == 'habilitar') {
        $chave = $_REQUEST['chave_disponibilizar'];
        $resposta = $controller->$acao($id_curso, $chave);
    } else {
        $resposta = $controller->$acao($id_curso);
    }
} else {
    $resposta = false;
}

echo( json_encode($resposta));
?>
