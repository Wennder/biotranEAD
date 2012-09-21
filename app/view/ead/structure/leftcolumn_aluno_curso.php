<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<script src="js/accordion.js" type="text/javascript"></script>

<div id="page-leftcolumn" class="leftcolumn page-leftcolumn">
    <h3 class="navbar_item homeIcon">
        <a href="index.php?c=ead"> Home </a>
    </h3>
    <h3 class="navbar_item cursosIcon">
        <a href="index.php?c=ead&a=todos_cursos"> Todos os Cursos </a>
    </h3>
    <div id="accordion_leftcolumn">
        <h3 class="navbar_item moduloIcon">
            <a> Meu Curso </a>
        </h3>
        <div>
            <ul style="list-style-type:none;">
                <?php  $controllerCurso = new ControllerCurso();
                    echo $controllerCurso->modulosCurso();
                ?>
            </ul>
        </div>
    </div>
    <h3 class="navbar_item forumIcon">
        <a href="#"> Fórum </a>
    </h3>
</div>