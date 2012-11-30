<script>
    $(document).ready(function(){
        $('dt a').click(function(){
            if($(this).parent().hasClass("fechado")) {
                $("dd:visible").slideUp("fast");
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
        
        $("dd a").click(function() {
            if(centro!=1){
                centro.find('div').remove();
            } 
            centro = $('#center_content').load($(this).attr('id'), function (){
            });               
        });
    });
</script>

<div id="page-leftcolumn" class="leftcolumn">
    <dl>
        <dt class="aberto">
        <a class="navbar_item gerenciarIcon" href="#">Conteúdo</a>
        </dt>
        <dd>
            <ul>
                <?php
                if (isset($_GET['id'])) {
                    $id_curso = $_GET['id'];
                    $controllerModulo = new controllerModulo();
                    echo $controllerModulo->lista_visualizarModulos_lefcolumn($id_curso);
                }
                ?>
            </ul>
        </dd>
    </dl>
</div>