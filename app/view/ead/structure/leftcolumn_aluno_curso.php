<script> 
    var left_column_dialog;
    $(document).ready(function() {        
        //Se clicar no link, redireciona
        $(".accord h3").click(function() {
            if(centro!=1){            
                centro.find('div').remove();
            } 
            var id = $(this).attr('id');
            centro = $('#center_content').load($(this).attr('id'), 'oi', function (){                                    
            });               
        });                    
    }); 
</script>

<?php
if (isset($_GET['id'])) {
    $id_curso = $_GET['id'];
    $controllerModulo = new controllerModulo();
    $controllerCurso = new controllerCurso();
}
?>
<div id="page-leftcolumn" class="leftcolumn page-leftcolumn">
    <h3 class="navbar_item ">
        <a href="index.php?c=ead"> Home </a>
    </h3>
    <h3 class="navbar_item ">
        <a href="index.php?c=ead&a=todos_cursos"> Cursos </a>
    </h3>
    <div class="navbar_item">
        <div class="accord">
            <h4 style="float:left;">></h4>
            <h3 name="pag_cursos" id="index.php?c=ead&a=pag_curso&id=<?php echo $id_curso ?>"><?php echo $controllerCurso->getCurso("id_curso=" . $id_curso)->getNome() ?></h3>
        </div>
        <div class="accord_content">
            <?php
            echo $controllerModulo->lista_visualizarModulos_lefcolumn_aluno($id_curso);
            ?>            
            <h3 class="navbar_item ">
                <a href="index.php?a=forum&c=ead&id=<?php echo $_GET['id'] ?>"> Fórum </a>
            </h3>
        </div>
    </div>
</div>