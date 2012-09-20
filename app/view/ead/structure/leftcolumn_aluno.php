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
    <ul style="list-style-type:none;margin-left:0px;padding:0px;">
        <li>
            <p class="navbar_item homeIcon">
                <a href="index.php?c=ead"> Home </a>
            </p>
        </li>
        <li>
            <p class="navbar_item cursosIcon">
                <a href="index.php?c=ead&a=todos_cursos">Cursos</a>
            </p>
<!--            <ul style="list-style-type:none;">
                <li>
                    <p class="navbar_item usuariosIcon">
                        <a href="index.php?c=ead&a=gerenciar_usuarios"> Meus cursos</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item cursosIcon">
                        <a href="index.php?c=ead&a=gerenciar_cursos"> Mais cursos</a>
                    </p>
                </li>
            </ul>-->
        </li>
        <li>
            <p class="navbar_item forumIcon">
                <a href="#"> Fórum </a>
            </p>
        </li>
    </ul>
</div>