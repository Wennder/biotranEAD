<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerCurso.php';
include ROOT_PATH . '/app/controller/controllerUsuario.php';


if($_GET['acao']=='comID'){
    $id_curso = $_REQUEST['id_curso'];
    $controller = new controllerCurso();

    $resposta = array(
        'prof_dispo' => $controller->comboProfessoresDisponiveis($id_curso),
        'prof_curso' => $controller->comboProfessores_curso($id_curso)
    );
}else{
    $controller = new controllerCurso();
    $resposta = $controller->comboTodos_Professores();
}


echo( json_encode($resposta));

?>
