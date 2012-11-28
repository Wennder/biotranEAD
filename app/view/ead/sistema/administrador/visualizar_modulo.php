<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn_admin_modulo.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<style>
    /*@import "http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css";*/
    .quadro_de_conteudo_especifico{
        margin:0px;
        margin-bottom:20px;
        border:0px solid #eeeeee;
        padding: 10px;
        color: #888888;
        box-shadow: 0px 2px 3px #eeeeee inset;
        -moz-box-shadow: 0px 2px 3px #eeeeee inset;
        -webkit-box-shadow: 0px 2px 3px #eeeeee inset;
    }

    ul{
        list-style: none;
    }

    .quadro_de_conteudo_especifico ul{
        margin:0;
        padding: 0;
        list-style: none;
    }

    .quadro_de_conteudo_especifico ul li{
        color: #888888;
        background-color: #eeeeee;
        border:1px solid #e0e0e0;
        padding:4px;
    }

    .quadro_de_conteudo_especifico ul li:hover{
        border:1px solid black;

    }

    .quadro_de_conteudo_especifico ul a:hover,a:active,a:visited{
        text-decoration: none;
        outline: none;

    }

    #disposicao_conteudo_professor_editar_modulo{
        padding:20px;
    }

    #btn_editar_modulo{
        float:right;
        background-image: url('img/document_edit.png');
        background-repeat: no-repeat;
        background-position: left;
        padding-left: 24px;
        margin-left:8px;
    }

    .list_conteudo{
        border-bottom:1px solid #eeeeee;
        border-top:1px solid #fefefe;
        background-color: #fafafa;
    }


    .list_conteudo:first-letter{
        font-weight: 600;
    }

    .list_conteudo img{
        float:left; margin-right: 5px;
    }

    #titulo_modulo{
        background: #ffffff;        
        border: 1px solid #e7e7e7;
        border-top:1px solid #f6f6f6;
        padding: 5px 12px;
        box-shadow: 0px 3px 3px #eeeeee ;
        -moz-box-shadow: 0px 3px 3px #eeeeee ;
        -webkit-box-shadow: 0px 3px 3px #eeeeee ;
    }

    .conteudo_row{
        overflow: auto;
        padding:1px 10px;
        border-bottom:1px solid #f2f2f2;
        border-top:1px solid #f2f2f2;
        cursor:pointer;
    }

    .conteudo_row h3{
        float:left;
        font-size:18px;
        font-weight: 600;
        line-height: 38px;
    }

</style>

<script>         
    $(document).ready(function() {        
        if(centro == 1){
            centro = $('#center_content').load('index.php?c=ead&a=conteudo_modulo', {id_curso: $('#id_curso_1').val()}, function (){
                pag_content = 'conteudo_modulo';
            });            
//            $('#lista_de_modulos h3').live('click',function(e){
//                if(centro!=1){
//                    centro.find('div').remove();
//                } 
//                var id = $(this).attr('id');
//                centro = $('#center_content').load('index.php?c=ead&a=editar_modulo&id='+id, 'oi', function (){
//                    $('#div_conteudo').append(centro);
//                });
//                pag_content = 'editar_modulo';
//            });
        }
    });                        
</script>

<div id="center_content"></div>

<div style="display: none;">
    <input type="text" id="id_curso_1" name="id_curso_1" value="<?php echo $this->curso->getId_curso(); ?>"/>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>