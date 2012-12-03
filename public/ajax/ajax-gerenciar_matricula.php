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
    $retorno = $controller->novaMatricula($id_curso, $usuario, 0);
    echo json_encode($retorno);
}

if($acao == 'liberar_acesso'){
    $id_matricula_curso = $_REQUEST['id_matricula_curso'];
    $chave = $_REQUEST['chave_disponibilizar'];
    //--
    $controller = new controllerMatricula_curso();      
    $retorno = $controller->liberarAcesso($id_matricula_curso, $chave);
    echo json_encode($retorno);
}

if($acao == 'atualizar_data'){
    $id_matricula_curso = $_REQUEST['id_matricula_curso'];
    $data = $_REQUEST['data'];
    //--
    $controller = new controllerMatricula_curso();
    $mc = $controller->getMatricula_curso('id_matricula_curso = '.$id_matricula_curso);
    $mc->setData_fim($data);
    $retorno = $controller->updateMatricula_curso($mc);
    echo json_encode($retorno);
}

?>
