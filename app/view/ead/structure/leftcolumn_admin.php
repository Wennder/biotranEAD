<style>    
    .accord {
        cursor: pointer;
        font-weight: 600;
        line-height: 100%;
    }
</style>

<script>     
    $(document).ready(function() {        
        //Se clicar no link, redireciona
        $(".accord h3").click(function() {
            location = ($(this).attr('id'));
        });                    
    }); 
</script>
<div id="page-leftcolumn" class="leftcolumn page-leftcolumn">
    <h3 class="navbar_item homeIcon">
        <a style="font-size:16px;" href="index.php?c=ead"> Home </a>
    </h3>
    <div id="accordion_leftcolumn navbar_item">
        <div class="accord">
            <h4 class="navbar_item" style="float:left">></h4>
            <!--<h3 class="navbar_item" style="color:white;font-weight: 600;line-height: 100%;font-size: 16px;">Gerenciar</h3>-->
            <h3 id="index.php?c=ead"> Gerenciar</h3>
            <!--<a style="font-size:16px;" href="index.php?c=ead"> Gerenciar </a>-->
        </div>
        <div class="accord_content" style="display: none;">
            <ul style="list-style-type: none;">
                <li><p><a style="font-size:16px;" href="index.php?c=ead&a=gerenciar_usuarios"> Usuarios </a></p></li>
                <li><p><a style="font-size:16px;" href="index.php?c=ead&a=gerenciar_cursos"> Cursos </a></p></li>
                <li><p><a style="font-size:16px;" href="#" onclick="alert('em construção!')"> Pagina Inicial </a></p></li>
            </ul>
        </div>
    </div>


</div>
