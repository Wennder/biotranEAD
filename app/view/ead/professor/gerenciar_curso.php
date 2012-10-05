<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<script>
    var centro = 1;
    $(document).ready(function(){
        if(centro == 1){            
            centro = $('#center_content').load('index.php?c=ead&a=editar_curso&id='+$('#id_curso_1').val(), $('#id_curso_1').val(), function (){                    
                //$('#div_conteudo').append(centro);
            });
            
            $('#lista_de_modulos h3').live('click',function(e){
                if(centro!=1){            
                    centro.find('div').remove();
                } 
                var id = $(this).attr('id');
                centro = $('#center_content').load('index.php?c=ead&a=editar_modulo&id='+id, 'oi', function (){                    
                    $('#div_conteudo').append(centro);
                }); 
            });
        }
    });

    function openCenter(s){       
        if(centro!=1){            
            centro.find('div').remove();
        }  
        var _aux = $('#center_content').load(s, 'oi', function (){                    
        });                                   
        centro = _aux;
        $('#div_conteudo_professor_editar_modulo').append(centro);                
    }    
    
</script>

<style>
    #div_conteudo_professor_editar_modulo{
        position: relative;
       
        padding-top:0px;
    }

    #div_conteudo_professor_editar_modulo h4{
        margin:0;

        padding:0;
    }

    #disposicao_conteudo_professor_editar_modulo{
        position: relative;
      
    }
    
    #center_content{
        position: relative;
       
        padding-top:0px;
    }

    #center_content h4{
        margin:0;

        padding:0;
    }

    #center_content{
        position: relative;
        
    }
    
    #center_content *{
        position:relative;
    }
    
</style>



<div id="center_content"></div>

<div style="display: none;">
    <input type="text" id="id_curso_1" name="id_curso_1" value="<?php echo $this->curso->getId_curso(); ?>"/>
</div>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>