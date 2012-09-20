<?php

include '../../library/Biotran/importar_app.php';
include ROOT_PATH . '/app/controller/controllerModulo.php';

$id_curso = $_REQUEST['id_curso'];

$controller= new controllerModulo();
$valores = $controller->numeracaoModulo($id_curso);

echo( json_encode($valores) );
?>
