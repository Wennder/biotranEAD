<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>

<script>
    $(function() {
        $( "#menu_accordion" ).accordion({
            active: false,
            autoHeight: false,
            navigation: true,
            collapsible: true
        });
    });
</script>

<div id="page-leftcolumn" class="leftcolumn page-leftcolumn">
    <p class="navbar_item homeIcon">
        <a href="index.php?c=ead"> Home </a>
    </p>
    <p class="navbar_item cursosIcon">
        <a href="index.php?c=ead&a=todos_cursos"> Cursos </a>
    </p>
    <div id="menu_accordion">
        <p class="navbar_item moduloIcon">
            <a href="#">Módulos</a>
        </p>
        <div>
            <ul style="list-style-type:none;">
                <?php  $controllerCurso = new ControllerCurso();
                    echo $controllerCurso->modulosCurso();
                ?>
<!--                <li>
                    <p class="navbar_item materialIcon">
                        <a href="#"> Módulo 1</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item materialIcon">
                        <a href="#"> Módulo 2</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item materialIcon">
                        <a href="#"> Módulo 3</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item materialIcon">
                        <a href="#"> Módulo 4</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item materialIcon">
                        <a href="#"> Módulo 5</a>
                    </p>
                </li>-->
            </ul>
        </div>
    </div>
    <p class="navbar_item forumIcon">
        <a href="#"> Fórum </a>
    </p>
</div>