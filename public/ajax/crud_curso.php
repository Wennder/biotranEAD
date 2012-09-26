<?php
include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerUsuario.php';
include ROOT_PATH . '/app/controller/controllerCurso.php';

$acao = $_GET['acao'] . 'Curso';
if (isset($_REQUEST['id_curso'])) {
    $id_curso = $_REQUEST['id_curso'];
} else {
    $id_curso = $_POST['id'];
}

$controller = new controllerCurso();

if (method_exists($controller, $acao)) {
    $resposta = $controller->$acao($id_curso);
    if($_GET['acao'] == 'inserir'){        
        $resposta = array(
            'status' => 0,
            'numero_modulos' => '',
            'objetivo' => '',
            'justificativa' => '',
            'obs' => '',
            'id' => $resposta,
            );
    }
} else {
    $resposta = false;
}

echo( json_encode($resposta));



?>
