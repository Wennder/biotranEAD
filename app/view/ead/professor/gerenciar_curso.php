<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>
<script type="text/javascript">
    //mudança de cor na lista de fórum
    var corDestaque = "rgb(144, 177, 214)";//"#90B1D6";
    var corClick = "rgb(180, 209, 241)";//"#B4D1F1";

    function mouseover(elemento){
        if(elemento.style.backgroundColor != corClick){
            elemento.style.backgroundColor = corDestaque;
        }
    }

    function mouseout(elemento, corAntiga){
        if(elemento.style.backgroundColor != corClick){
            elemento.style.backgroundColor = corAntiga;
        }
    }

    function mouseclick(elemento, corOriginal){
        if(elemento.style.backgroundColor != corClick){
            elemento.style.backgroundColor = corClick;
        }else{
            elemento.style.backgroundColor = corOriginal;
        }
        mouseover(elemento);
    }
</script>
<script>    
    $(document).ready(function(){        
        //forms forum
        $('#form_adicionar_topico').live('submit',function(){
            $(this).ajaxSubmit({
                clearForm: true,
                success: function(data){
                    if(data != 0){
                        if(centro!=1){            
                            centro.find('div').remove();
                        }                         
                        centro = $('#center_content').load("index.php?c=ead&a=topico&id="+data, function (){
                            $('#div_conteudo').append(centro);
                        });                        
                    }else{
                        alert('Operação não realizada, tente novamente mais tarde!');
                    }
                }
            });
            return false;
        }); 
        
        $('#form_responder_topico').live('submit',function(){
            $(this).ajaxSubmit({
                clearForm: true,
                success: function(data){
                    if(data != 0){
                        if(centro!=1){            
                            centro.find('div').remove();
                        }                         
                        centro = $('#center_content').load("index.php?c=ead&a=topico&id="+data, function (){
                            $('#div_conteudo').append(centro);
                        });                        
                    }else{
                        alert('Operação não realizada, tente novamente mais tarde!');
                    }
                }
            });
            return false;
        }); 
        
        $('.btn_excluir_topico').live('click', function(){
            var id = $(this).attr('id');
            var pag = $(this).attr('name');
            var r = confirm('Tem certeza de que deseja excluir este tópico?');
            if(r){
                $.ajax({
                    url: 'index.php?c=ead&a=forum&d='+id,
                    dataType: 'json',
                    async: false,
                    success: function(data, textStatus, jqXHR){
                        if(data){
                            if(pag != 'topico'){
                                $('#lista_topicos-'+id).remove();                                                            
                            }else{
                                if(centro!=1){            
                                    centro.find('div').remove();
                                } 
                                centro = $('#center_content').load('index.php?c=ead&a=forum&id='+$('#id_curso_1').val(), function (){                    
                                    $('#div_conteudo').append(centro);                    
                                }); 
                            }
                        }else{
                            alert('Operação não realizada, tente novamente mais tarde!');
                        }
                    }
                });
            }
        });
        
        $('.btn_excluir_resposta').live('click', function(){
            var id_resposta = $(this).attr('id');
            var id_topico = $(this).attr('name');            
            var r = confirm('Tem certeza de que deseja excluir esta resposta?');
            if(r){
                $.ajax({
                    url: 'index.php?c=ead&a=topico&d='+id_resposta,
                    dataType: 'json',
                    async: false,
                    success: function(data, textStatus, jqXHR){                            
                        if(data){
                            var ac = document.getElementsByName(id_resposta);
                            $(ac).remove();
//                            if(centro!=1){            
//                                centro.find('div').remove();
//                            }
//                            centro = $('#center_content').load('index.php?c=ead&a=topico&id='+id_topico, function (){                    
//                                $('#div_conteudo').append(centro);                    
//                            })
                        }else{
                            alert('Operação não realizada, tente novamente mais tarde!');
                        }
                    }
                });
            }
        });
    
        if(centro == 1){            
            centro = $('#center_content').load('index.php?c=ead&a=editar_curso&id='+$('#id_curso_1').val(), $('#id_curso_1').val(), function (){                    
                pag_content = 'editar_curso';
            });            
            $('#lista_modulos li').live('click',function(e){
                if(centro!=1){            
                    centro.find('div').remove();
                } 
                var id = $(this).attr('id');
                centro = $('#center_content').load('index.php?c=ead&a=editar_modulo&id='+id, function (){                    
                    $('#div_conteudo').append(centro);                    
                }); 
                pag_content = 'editar_modulo';
            });
            
            $('fr a:not(.link)').live('click',function(e){                
                if(centro!=1){            
                    centro.find('div').remove();
                } 
                var id = $(this).attr('id');
                centro = $('#center_content').load(id, function (){                    
                    $('#div_conteudo').append(centro);
                });
                pag_content = 'editar_modulo';
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
    
    $(document).ready(function() {        
        $('.accord_body').live('click', function(e) {
            $(this).next('.accord_content_body').slideToggle('fast');                  
        }); 
    });
    
</script>

<div id="center_content"></div>

<div style="display: none;">
    <input type="text" id="id_curso_1" name="id_curso_1" value="<?php echo $this->curso->getId_curso(); ?>"/>
</div>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
