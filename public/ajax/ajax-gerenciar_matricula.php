<?php
include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerUsuario.php';
include ROOT_PATH . '/app/controller/controllerCurso.php';
include ROOT_PATH . '/app/controller/controllerModulo.php';

$acao = $_REQUEST['acao'];

if($acao == 'matricular'){
    $controller = new controllerUsuario();
    $usuario = $controller->getUsuario('id_usuario='.$_REQUEST['id_usuario']);
    $id_curso = $_REQUEST['id_curso'];
    //--
    $controller = new controllerCurso();
    $c = $controller->getCurso("id_curso=$id_curso");
    $controller = new controllerMatricula_curso();
    $retorno = $controller->novaMatricula($c, $usuario, 0);
    echo json_encode($retorno);
}

if($acao == 'calcular_desempenho'){
    $controller = new controllerMatricula_curso();
    $id_matricula_curso = $_REQUEST['id_matricula_curso'];
    $mc = $controller->getMatricula_curso('id_matricula_curso='.$id_matricula_curso);
    //--
    $controller = new controllerCurso();
    $c = $controller->getCurso('id_curso='.$mc->getId_curso());
    $retorno = $controller->analise_desempenho($c, $mc);
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
