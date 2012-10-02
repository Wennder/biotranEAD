
<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<script src="js/accordion.js" type="text/javascript"></script>
<script> $(function() {
     //Se clicar no header, expande
   $('.accordion_leftcolumn h3').click(function() {
		$(this).next().toggle();
		return false;
	}).next().hide();
        //Se clicar no link, redireciona
   $(".accordion_leftcolumn h3 a").click(function() {
      window.location = $(this).attr('href');
      return false;
   });
             
}); </script>
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
                <a href="index.php?c=ead&a=professor_editar_curso&id=<?php echo $id_curso ?>"><?php echo $controllerCurso->getCurso("id_curso=". $id_curso)->getNome() ?></a>
            </h3>
            <div>
                <ul style="list-style-type:none;">
                    <?php
                   
                        echo $controllerModulo->listaAdicionar_conteudo_modulo($id_curso);
                    }
                    ?>
            </ul>
        </div>
    </div>
</div>
