<?php

require 'structure/header.php';

$papel = $_SESSION["usuarioLogado"]->getId_papel();
switch ($papel) {
    case 1:
        require 'structure/leftcolumn_admin.php';
        break;
    case 2:
        require 'structure/leftcolumn_gestor.php';
        break;
    case 3:
        require 'structure/leftcolumn_professor_home.php';
        break;
    case 4:
        require 'structure/leftcolumn_aluno_home.php';
        break;
}

require 'structure/content.php';
switch ($papel) {
    case 1:
        require 'structure/index_admin.php';
        break;
    case 2:
        require 'structure/index_gestor.php';
        break;
    case 3:
        require 'structure/index_professor.php';
        break;
    case 4:
        require 'structure/index_aluno.php';
        break;
}
require 'structure/footer.php';

?>