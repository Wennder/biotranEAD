<?php
include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerUsuario.php';
include ROOT_PATH . '/app/controller/controllerCurso.php';

$acao = $_REQUEST['acao'];

if($acao == 'matricular'){
    $controller = new controllerUsuario();
    $usuario = $controller->getUsuario('id_usuario='.$_REQUEST['id_usuario']);
    $id_curso = $_REQUEST['id_curso'];
    //--
    $controller = new controllerMatricula_curso();      
    $retorno = $controller->novaMatricula($id_curso, $usuario);
    echo json_encode($retorno);
}

?>
