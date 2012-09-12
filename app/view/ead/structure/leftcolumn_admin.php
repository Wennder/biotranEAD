<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>

<script>
    $(function() {
        $( "#menu_accordion" ).accordion({
            active: false,
//            animated: 'bounceslice',
//            clearStyle: true,
//            fillSpace: true,
            autoHeight: false,
            navigation: true,
            collapsible: true
        });
    });
    
   </script>

<div id="page-leftcolumn" class="leftcolumn page-leftcolumn">
    <p class="navbar_item homeIcon">
        <a href="<?php echo "index.php?c=ead" ?>"> Home </a>
    </p>
    <div id="menu_accordion">
        <p class="navbar_item gerenciarIcon">
            <a href="#">Gerenciar</a>
        </p>
        <div>
            <ul style="list-style-type:none;">
                <li>
                    <p class="navbar_item usuariosIcon">
                        <a href="index.php?c=ead&a=gerenciar_usuarios"> Usuários</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item cursosIcon">
                        <a href="index.php?c=ead&a=gerenciar_cursos"> Cursos</a>
                    </p>
                </li>
            </ul>
        </div>
        <p class="navbar_item cursosIcon">
            <a href="index.php?c=ead&a=index"> Liberar Acesso</a>
        </p>
        <div></div>
        <p class="navbar_item gerenciarIcon">
            <a href="#">Gerenciar Curso</a>
        </p>
        <div>
            <ul style="list-style-type:none;">
                <li>
                    <p class="navbar_item moduloIcon">
                        <a href="index.php?c=ead&a=index"> Adicionar Módulo</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item videoIcon">
                        <a href="index.php?c=ead&a=index"> Adicionar Vídeo Aula</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item materialIcon">
                        <a href="index.php?c=ead&a=index"> Adicionar Bibliografia</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item materialIcon">
                        <a href="index.php?c=ead&a=index"> Adicionar Material Complementar</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item exerciciosIcon">
                        <a href="index.php?c=ead&a=index"> Adicionar Exercício</a>
                    </p>
                </li>
            </ul>
        </div>
    </div>
    <p class="navbar_item gerenciarIcon">
        <a href="#"> Gerenciar Sistema</a>
    </p>
</div>