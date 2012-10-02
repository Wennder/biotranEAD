<?php 
$a = $_REQUEST['acao'];
if($a == 1){
    $pagina = require ('../../app/view/ead/estudante/index.php');
}

if($a==2){
    $pagina = file_get_contents('../teste2.php');
}

echo( json_encode($pagina)); 
?>