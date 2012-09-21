<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>

<style> .accord{
        cursor:pointer;
        color:white;
    } </style>

<script>
    
    $(document).ready(function(){
        //On click any <h3> within the container
        $('#menu_accordion p').click(function(e) {

            //Close all <div> but the <div> right after the clicked <a>
            //$(e.target).next('div').siblings('div').slideUp('fast');
            
            //Toggle open/close on the <div> after the <h3>, opening it if not open.
            $(e.target).next('div').slideToggle('fast');
        });
    });
    
//    oTable.$('tr').click(function(e){
//            if ( $(this).hasClass('row_selected') ) {
//                $(this).removeClass('row_selected');
//            } else {
//                oTable.$('tr.row_selected').removeClass('row_selected');
//                $(this).addClass('row_selected');
//            }
//        });
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
<style>
    #page-leftcolumn{
        background-image: url('img/header_ead_background.png');
    }
</style>
<div id="page-leftcolumn" class="leftcolumn page-leftcolumn">

    <div id="menu_accordion">
        
            
                <p class="navbar_item ">
                    <a  href="<?php echo "index.php?c=ead" ?>"> Home </a>
                </p>
                
            
            
                 <p class="navbar_item accord">   
                     Gerenciar
                 </p>
           
            <div class="acord_content" style="display:none;">
                
                    <ul style="list-style-type:none; padding-left: 3px;">
                        <li>
                            <p class="navbar_item ">
                                <a href="index.php?c=ead&a=gerenciar_usuarios"> Usuários</a>
                            </p>
                        </li>
                        <li>
                            <p class="navbar_item ">
                                <a href="index.php?c=ead&a=gerenciar_cursos"> Cursos</a>
                            </p>
                        </li>
                    </ul>
                
            </div>
            
                <p class="navbar_item ">
                    <a href="index.php?c=ead&a=index"> Liberar Acesso</a>
                </p>
            
            
                <p class="navbar_item accord">
                    Gerenciar Curso
                </p>
            
            <div class="acord_content" style="display: none;">
                <ul style="list-style-type:none; padding-left:3px;">
                    <li>
                        <p class="navbar_item ">
                            <a href="index.php?c=ead&a=gerenciar_conteudo"> Gerenciar Conteúdo do Curso</a>

                        <ul class="lista_sem_decoracao">
                            <li >
                                <a href="index.php?c=ead&a=adicionar_modulo"> Adicionar Módulo </a>
                            </li>
                            <li>
                                <a href="index.php?c=ead&a=adicionar_videoaula"> Adicionar Vídeo Aula</a>
                            </li>
                            <li>
                                <a href="index.php?c=ead&a=adicionar_bibliografia"> Adicionar Bibliografia</a>
                            </li>
                            <li>
                                <a href="index.php?c=ead&a=adicionar_materialcomplementar"> Adicionar Material Complementar</a>
                            </li>
                            <li>
                                <a href="index.php?c=ead&a=adicionar_exercicio"> Adicionar Exercício</a>
                            </li>
                        </ul>

                        </p>
                    </li>

                </ul>
            </div>
           
                <p class="navbar_item ">
                    <a href="#"> Gerenciar Sistema</a>
                </p>
           
        

    </div>

</div>
