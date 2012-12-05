<?php
$id_curso = $_GET['id'];
$controllerModulo = new controllerModulo();
$controllerCurso = new controllerCurso();
?>

<script>
    $(document).ready(function(){
        $('dd').hide();
        $('dt a:not(.link)').click(function(){
            if($(this).parent().hasClass("fechado")) {
                $("dd:visible").slideUp("fast");
                $('dt').each(function(){
                    $(this).removeClass("aberto");
                    $(this).addClass("fechado");
                });
                $(this).parent().next().slideDown("fast");
                $(this).parent().removeClass("fechado");
                $(this).parent().addClass("aberto");
            }
            else if($(this).parent().hasClass("aberto")) {
                $(this).parent().next().slideUp("fast");
                $(this).parent().removeClass("aberto");
                $(this).parent().addClass("fechado");
            }
        });
        
        $("dd a, .desc").click(function() {
            if(centro!=1){
                centro.find('div').remove();
            } 
            $(centro).append('<div style="aling:right;" id="div_loading"><img src="img/gif/ajax-loader-f.gif" /></div>');            
            centro = $('#center_content').load($(this).attr('id'), function (){
//                centro.find("#div_loading").remove();
            });               
        });
    }); 
</script>

<div id="page-leftcolumn" class="leftcolumn">
    <dl>
        <dt>
        <a class="navbar_item homeIcon link" href="index.php?c=ead">Home</a>
        </dt>
        <dt class="fechado">
        <a class="navbar_item cursosIcon" href="index.php?c=ead&a=cursos_professor">Todos os Cursos</a>
        </dt>
    </dl>
    <span style="border: 1px solid #00689B; width: 208px; margin: 8px 0 0 0; position: absolute;"></span><br>
    <dl>
        <dt>
        <a class="navbar_item descricaoIcon link desc" href="#" id="index.php?c=ead&a=editar_curso&id=<?php echo $id_curso ?>">Página do Curso</a>
        </dt>
        <dt class="fechado">
        <a class="navbar_item modulosIcon" href="#">Módulos</a>
        </dt>
        <dd>
            <ul>
                <?php echo $controllerModulo->listaAdicionar_conteudo_modulo($id_curso); ?>
            </ul>
        </dd>
        <dt>
        <?php
        if ($controllerCurso->getCurso("id_curso=" . $id_curso)->getStatus(1) == 4) {
            echo "<a class='navbar_item forumIcon link desc' href='#' id='index.php?c=ead&a=forum&id=" . $id_curso . "'>Fórum</a>";
        }
        ?>
        </dt>
    </dl>
</div>