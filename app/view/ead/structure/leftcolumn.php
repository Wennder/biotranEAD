<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<script src="js/accordion.js" type="text/javascript"></script>
<?php
$usuario = $_SESSION["usuarioLogado"]->getId_papel();
if (isset($_GET['id'])) {
    $id_curso = $_GET['id'];
}
$controllerModulo = new controllerModulo();
$controllerCurso = new ControllerCurso();
?>
<div id="leftcolumn">
    <h4>
        <a href="<?php echo "index.php?c=ead" ?>"><h4>Home</h4></a>
    </h4>
    <?php
    switch ($usuario) {
        case 1:
            echo "<div class='accordion_leftcolumn'>
                <h4>Gerenciar</h4><div><ul>
                    <li><p><a href='index.php?c=ead&a=gerenciar_usuarios'>Usuários</a></p></li>
                    <li><p><a href='index.php?c=ead&a=gerenciar_cursos'>Cursos</a></p></li>
                    <li><p><a href='#'>Sistema</a></p></li>
                </ul></div></div>";
            break;
        case 2:
            echo "<div class='accordion_leftcolumn'>
                <h4>Gerenciar</h4><div><ul>
                    <li><p><a href='index.php?c=ead&a=gerenciar_usuarios'>Usuários</a></p></li>
                    <li><p><a href='index.php?c=ead&a=index'>Sistema</a></p></li>
                </ul></div></div>";
            break;
        case 3:
            if ($_GET['a'] == "professor_editar_curso") {
                echo "<a href='index.php?c=ead&a=listaCursos_professor'><h4>Todos os Cursos</h4></a>
                    <div class='accordion_leftcolumn'>
                        <h4>Gerenciar Curso</h4><div><ul>"
                            .$controllerModulo->listaAdicionar_conteudo_modulo($id_curso).
                        "</ul></div></div>";
            } else {
                echo "<a href='index.php?c=ead&a=listaCursos_professor'><h4>Todos os Cursos</h4></a>";
            }
            break;
        case 4:
            if ($_GET['a'] == "curso") {
                echo "<a href='index.php?c=ead&a=todos_cursos'><h4>Todos os Cursos</h4></a>
                    <div class='accordion_leftcolumn'>
                        <h4>Meu Curso</h4><div><ul>"
                            .$controllerCurso->modulosCurso($id_curso).
                        "</ul></div>
                    <a href='#'><h4>Forum</h4></a></div>";
            } else {
                echo "<a href='index.php?c=ead&a=todos_cursos'><h4>Todos os Cursos</h4></a>";
            }
            break;
    }
    ?>
</div>