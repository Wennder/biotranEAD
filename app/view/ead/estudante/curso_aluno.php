<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>


<script>    
    $(document).ready(function(){        
        if(centro == 1){                      
            centro = $('#center_content').load('index.php?c=ead&a=pag_curso&id='+$('#id_curso_1').val(), $('#id_curso_1').val(), function (){
            pag_content = 'pag_curso';
            });            
            $('#lista_de_modulos h3').live('click',function(e){
                if(centro!=1){            
                    centro.find('div').remove();
                } 
                var id = $(this).attr('id');
                centro = $('#center_content').load('index.php?c=ead&a=pag_modulo&id='+id, 'oi', function (){                    
                    $('#div_conteudo').append(centro);                    
                }); 
                pag_content = 'pag_modulo';
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
        $('#div_conteudo_estudante_modulo').append(centro);                
    }    
    
</script>

<div id="center_content"></div>

<div style="display: none;">
    <input type="text" id="id_curso_1" name="id_curso_1" value="<?php echo $this->curso->getId_curso(); ?>"/>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>