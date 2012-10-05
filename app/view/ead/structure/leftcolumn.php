<!--<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>-->
<!--<script src="js/accordion.js" type="text/javascript"></script>-->


<?php
$usuario = $_SESSION["usuarioLogado"]->getId_papel();
if (isset($_GET['id'])) {
    $id_curso = $_GET['id'];
}
$controllerModulo = new controllerModulo();
$controllerCurso = new ControllerCurso();

switch ($usuario) {
    case 1: require 'leftcolumn_admin.php';break;
    case 2: require 'leftcolumn_gestor.php';break;
    case 3:
        if ($_GET['a'] == "gerenciar_curso" || $_GET['a'] == "cadastrar_primeiro_acesso_curso") {
            require 'leftcolumn_professor_curso.php';
        } else {
            require 'leftcolumn_professor_home.php';
        }
        break;
    case 4: 
        if (Biotran_Mvc::pegarInstancia()->pegarAcao() == "curso") {
            require 'leftcolumn_aluno_curso.php';
        } else {
            require 'leftcolumn_aluno_home.php';
        }
}
?>

