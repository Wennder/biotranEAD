<?php

$id = $_REQUEST['id'];
$tipo = $_REQUEST['tipo'];

if($tipo == "curso"){
    $existe = file_exists("../img/cursos/$id.jpg") ? "1" : "0";
    if(file_exists("../img/cursos/ass-$id.jpg")){
        if($existe){
            $existe = 2;
        }else{
            $existe = 3;
        }
    }
}
else if($tipo == "usuario")
    $existe = file_exists("../img/profile/$id.jpg") ? "1" : "0";
else if($tipo == "usuario_pic")
    $existe = file_exists("../img/profile/pic/$id.jpg") ? "1" : "0";

echo($existe);

?>