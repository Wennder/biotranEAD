<?php

include '../../library/Biotran/importar_app.php';
session_start();
if(!empty($_REQUEST)){    
    $c = new controllerCurso();    
    $curso = $c->getCurso('id_curso='.$_REQUEST['id_curso']);
    $usuario = $_SESSION['usuarioLogado'];
    $c = new controllerMatricula_curso($curso, $usuario);
    /*resposta pode ser a url ou um booleano 0 se deu errado.
    */
    $resposta = $c->requisitarPagamento();
    echo json_encode($resposta);
}

?>
