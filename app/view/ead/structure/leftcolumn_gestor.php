<script>
    $(document).ready(function(){
        $('dd').hide();
        $('dt a:not(#link_home)').click(function(){
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
    });
</script>

<div id="page-leftcolumn" class="leftcolumn">
    <dl>
        <dt>
        <a id="link_home" class="navbar_item homeIcon" href="<?php echo "index.php?c=ead" ?>"> Home </a>
        </dt>
        <dt class="fechado">
        <a class="navbar_item gerenciarIcon" href="#">Gerenciar</a>
        </dt>
        <dd>
            <ul>
                <li><a class="navbar_item usuariosIcon" href="index.php?c=ead&a=gerenciar_usuarios"> Usuários</a></li>                
                <li><a class="navbar_item noticiasIcon" href="index.php?c=ead&a=pini_noticias"> Notícias</a></li>
                <li><a class="navbar_item comentariosIcon" href="index.php?c=ead&a=pini_comentarios"> Comentários</a></li>
                <li><a class="navbar_item destaquesIcon" href="index.php?c=ead&a=pini_destaques"> Destaques</a></li>
                <li><a class="navbar_item parceirosIcon" href="index.php?c=ead&a=pini_patrocinadores"> Parceiros</a></li>
                <li><a class="navbar_item fotosIcon" href="index.php?c=ead&a=pini_fotos"> Fotos</a></li>
            </ul>
        </dd>
    </dl>
</div>



<!--<div id="page-leftcolumn" class="leftcolumn page-leftcolumn">
    <p class="navbar_item homeIcon">
        <a href="<?php echo "index.php?c=ead" ?>"> Home </a>
    </p>
    <div class="accordion_leftcolumn">
        <p class="accord navbar_item gerenciarIcon">
            <a href="#">Gerenciar</a>
        </p>
        <div class="accord_content">
            <ul style="list-style-type:none;">
                <li>
                    <p class="navbar_item usuariosIcon">
                        <a href="index.php?c=ead&a=gerenciar_usuarios"> Usuários</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item gerenciarIcon">
                        <a href="index.php?c=ead&a=gerenciar_sistema"> Sistema</a>
                    </p>
                </li>
            </ul>
        </div>
    </div>
</div>-->