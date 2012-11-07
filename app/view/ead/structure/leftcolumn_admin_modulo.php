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

<div id="page-leftcolumn" class="leftcolumn page-leftcolumn">    
    <div class="accord navbar_item">
        <h3>
            <a>Conteúdo</a>
        </h3>
        <div class="accord_content">
            <ul style="list-style-type:none;">
                <?php
                if (isset($_GET['id'])) {
                    $id_curso = $_GET['id'];
                    $controllerModulo = new controllerModulo();
                    echo $controllerModulo->lista_visualizarModulos_lefcolumn($id_curso);
                }
                ?>
            </ul>
        </div>
    </div>
</div>