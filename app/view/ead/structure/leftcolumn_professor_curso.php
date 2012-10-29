

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



<div id="left_column_dialog"></div>

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
        <div class="navbar_item">
            <div class="accord">
                <h4 style="float:left;">></h4>
                <h3 name="editar_curso" id="index.php?c=ead&a=editar_curso&id=<?php echo $id_curso ?>"><?php echo $controllerCurso->getCurso("id_curso=" . $id_curso)->getNome() ?></h3>
            </div>
            <div class="accord_content">
                <ul style="list-style-type:none;">
                    <?php
                    echo $controllerModulo->listaAdicionar_conteudo_modulo($id_curso);
                }
                ?>
            </ul>
        </div>
    </div>
</div>
