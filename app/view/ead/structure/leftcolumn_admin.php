<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>

<style> .accord{
        cursor:pointer;
        color:#0069D6;
} </style>

<script>
    
    $(document).ready(function(){
        //On click any <h3> within the container
    $('#menu_accordion p').click(function(e) {

        //Close all <div> but the <div> right after the clicked <a>
            $(e.target).next('div').siblings('div').slideUp('fast');

        //Toggle open/close on the <div> after the <h3>, opening it if not open.
            $(e.target).next('div').slideToggle('fast');
        });
    });
    
//    $(function() {
//        $( "#menu_accordion" ).accordion({
//            clearStyle: true,
//            active: false,
////            animated: 'bounceslice',
////            clearStyle: true,
////            fillSpace: true,
//            autoHeight: false,
//            navigation: true,
//            collapsible: true
//        });
//    });
//    
   </script>

<div id="page-leftcolumn" class="leftcolumn page-leftcolumn">
    <p class="navbar_item homeIcon">
        <a  href="<?php echo "index.php?c=ead" ?>"> Home </a>
    </p>
    <div id="menu_accordion">
        <p class="navbar_item gerenciarIcon accord">
            Gerenciar
        </p>
        <div class="acord_content" style="display:none;">
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
        <p class="navbar_item cursosIcon accord">
            <a href="index.php?c=ead&a=index"> Liberar Acesso</a>
        </p>
        <div></div>
        <p class="navbar_item gerenciarIcon accord">
            Gerenciar Curso
        </p>
        <div class="acord_content" style="display:none;">
            <ul style="list-style-type:none;">
                <li>
                    <p class="navbar_item moduloIcon">
                        <a href="index.php?c=ead&a=gerenciar_conteudo"> Gerenciar Conteúdo do Curso</a>
                    <div>
                        <ul>
                            <li>
                                <a href="index.php?c=ead&a=adicionar_modulo"> Adicionar Módulo </a>
                            </li>
                        </ul>
                    </div>
                    </p>
                </li>
                <li>
                    <p class="navbar_item videoIcon">
                        <a href="index.php?c=ead&a=adicionar_videoaula"> Adicionar Vídeo Aula</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item materialIcon">
                        <a href="index.php?c=ead&a=adicionar_bibliografia"> Adicionar Bibliografia</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item materialIcon">
                        <a href="index.php?c=ead&a=adicionar_materialcomplementar"> Adicionar Material Complementar</a>
                    </p>
                </li>
                <li>
                    <p class="navbar_item exerciciosIcon">
                        <a href="index.php?c=ead&a=adicionar_exercicio"> Adicionar Exercício</a>
                    </p>
                </li>
            </ul>
        </div>
    </div>
    <p class="navbar_item gerenciarIcon">
        <a href="#"> Gerenciar Sistema</a>
    </p>
</div>
