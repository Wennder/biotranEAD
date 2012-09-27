<?php

require 'structure/header.php';
$controller = new controllerPapel();
$papel = $controller->getPapel("id_papel=".$_SESSION["usuarioLogado"]->getId_papel());

//left_column
require 'structure/leftcolumn_admin.php';

//content
require 'structure/content.php';

//index
if($papel->getPapel() == 'Administrador' || $papel->getPapel() == 'Gestor'){
    require 'sistema/'. strtolower($papel->getPapel()).'/index.php';
}else{
    require strtolower($papel->getPapel()).'/index.php';
}


//footer
require 'structure/footer.php';

?>
