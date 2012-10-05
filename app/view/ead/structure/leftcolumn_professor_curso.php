<?php
if (isset($_GET['id'])) {
    $id_curso = $_GET['id'];
    $controllerModulo = new controllerModulo();
    $controllerCurso = new controllerCurso();
    ?>
    <div id="page-leftcolumn" class="leftcolumn page-leftcolumn">
        <h3 class="navbar_item homeIcon">
            <a href="<?php echo "index.php?c=ead" ?>"> Home </a>
        </h3>
        <h3 class="navbar_item gerenciarIcon">
            <a href="index.php?c=ead&a=listaCursos_professor">Cursos</a>
        </h3>
        <div class="accordion_leftcolumn navbar_item">
            <h3>
                <img src="img/seta_gray.png"/>
                <a href="index.php?c=ead&a=editar_curso&id=<?php echo $id_curso ?>"><?php echo $controllerCurso->getCurso("id_curso=" . $id_curso)->getNome() ?></a>
            </h3>
            <div class="accordion_leftcolumn_content">
                <ul style="list-style-type:none;">
                    <?php
                    echo $controllerModulo->listaAdicionar_conteudo_modulo($id_curso);
                }
                ?>
            </ul>
        </div>
    </div>
</div>
