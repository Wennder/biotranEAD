
<script src="js/accordion_1.js" type="text/javascript"></script>
<!--<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>-->
<link href="css/jquery-ui-1.8.24.custom.css" rel="stylesheet" type="text/css"/>   
<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<link href="css/jquery.dialog.css" rel="stylesheet" type="text/css"/>        
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>-->
<script src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.form.js"></script>

<style>
    @import "http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css";
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
/*       
    background: -webkit-gradient(linear, left top, left bottom, from(#fafafa), to(#f0f0f0));
    background: -webkit-linear-gradient(top, #fafafa, #f0f0f0);
    background: -moz-linear-gradient(top, #fafafa, #f0f0f0);
    background: -ms-linear-gradient(top, #fafafa, #f0f0f0);
    background: -o-linear-gradient(top, #fafafa, #f0f0f0);
    background: linear-gradient(top, #fafafa, #f0f0f0);*/
        border: 1px solid #e7e7e7;
        border-top:1px solid #f6f6f6;
        padding: 5px 12px;
        box-shadow: 0px 3px 3px #eeeeee ;
    -moz-box-shadow: 0px 3px 3px #eeeeee ;
    -webkit-box-shadow: 0px 3px 3px #eeeeee ;
    }
    
    [type = button]{
        border:1px solid #c9f0c9;
        background-color: #d9ffd9;
       border-radius: 5px;
       color:#606060;
       font-weight: 600;
       margin:5px;
    }
    

.accord_content_body{
    box-shadow: 0px 2px 2px #eeeeee inset;
    -moz-box-shadow: 0px 2px 2px #eeeeee inset;
    -webkit-box-shadow: 0px 2px 2px #eeeeee inset;
}


.btn_del{
    float:right;
}
.btn_edt{
    float:right;
}

.titulo_video{
    float:left;
}

.video_row{
    overflow: auto;
    padding:1px 5px;
    border-bottom:1px solid #f2f2f2;
    border-top:1px solid #f2f2f2;
}

</style>

<script> 
    
    var dialog;
    $(document).ready(function() {                                                        
        //_V_.options.flash.swf = "video-js.swf";              
        
        $(".btn_edt").live('click', function(){
            var btn = $(this);
            var r = confirm('Tem certeza de que deseja excluir esta video aula?');
            if(r == true){                  
                var id = btn.attr('id');               
                $.getJSON('ajax/crud_conteudo_modulo.php?acao=remover_'+btn.attr('name'),{
                    id: id,       
                    ajax: 'true'
                }, function(j){
                    //usuario excluido         
                    if(j > 0){
                        id = '#video_'+id;
                        $(id.toString()).remove();
                    }
                }); 
            }
        });
        
        $(".btn_del").live('click', function(){
            var btn = $(this);
            var r = confirm('Tem certeza de que deseja excluir esta video aula?');
            if(r == true){                  
                var id = btn.attr('id');               
                $.getJSON('ajax/crud_conteudo_modulo.php?acao=remover_'+btn.attr('name'),{
                    id: id,       
                    ajax: 'true'
                }, function(j){
                    //usuario excluido         
                    if(j > 0){
                        id = '#video_'+id;
                        $(id.toString()).remove();
                    }
                }); 
            }
        });
        
        $(".btn_add").live('click', function(){
            var btn = $(this);
            $('#dialog').load(btn.attr('id'), function(response, status, xhr) {
                if (status == "error") {
                    alert('erro');
                    var msg = "Sorry but there was an error: ";
                    $("#error").html(msg + xhr.status + " " + xhr.statusText);
                }else{
                    
                    var width = 0;var height = 0;
                    var tipo = btn.attr('name');
                    if(tipo == 'video'){
                        width = 800;height = 350;
                    }else{
                        if(tipo == 'texto'){
                            width = 500;height = 250;
                        }else{
                            if(tipo == 'material'){
                                width = 500;height = 200;
                            }else{//novo exercício
                                width = 700;
                                height = 300;
                            }
                        }
                    }                                            
                    dialog = $('#dialog').dialog({width:width, height:height,dialogClass:'dialogstyle',modal: true,
                        focus: function(event,ui){                                                
                            $('#form_cadastrar').ajaxForm({                                                    
                                uploadProgress: function(event, position, total, percentComplete) {
                                    $('progress').attr('value',percentComplete);
                                    $('#porcentagem').html(percentComplete+'%');
                                },                            
                                success: function(data) {                             
                                    $('progress').attr('value','100');
                                    $('#porcentagem').html('100%');
                                    $('pre').html(data);
                                    if(data != 0){                                         
                                        if(tipo == 'video'){                                        
                                            data = data.split('-');
                                            insereVideo(data);
                                        }else{//insere novo arquivo(texto/material)
                                    
                                        }
                                        alert('Video inserido!');
                                        $(dialog).dialog('close');
                                    }                       
                                }                    
                            });                    
                        },
                        close: function(event,ui){                     
                            $(dialog).dialog('destroy');
                            $(dialog).find('div').remove();
                        }                  
                
                    });
                }
            });
            
        });
        
        $(" #lista_video ").live('click',function() {            
            var tag = $(this);
            if(tag.attr('name') == 'video'){                
                $('#dialog_video').load(tag.attr('id'), 'oi', function (){                                    
                    var options = {width:700, height:400,dialogClass:'dialogstyle',modal: true,
                        open: function(event,ui){                                                                                
                        },
                        close: function(event,ui){                     
                            dialog_video.dialog('destroy');
                            dialog_video.find('div').remove();
                        }                                     
                    }
                    var dialog_video = $(this).dialog(options);
                }); 
            }
        });             
    });         
    
    function insereVideo(data){
        data[0] = data[0].replace('"', '');
        data[1] = data[1].replace('"', '');
        var editar = '<input id="'+data[0]+'" name="video" type="button" class="btn_edt" value="Editar"/>';
        var excluir = '<input id="'+data[0]+'" name="video" type="button" class="btn_del" value="Excluir"/>';
        var _HTML = '<li id=video_'+data[0]+'><h3 name="video" id="index.php?c=ead&a=janela_video&id='+data[0]+'">'+data[1] + '</h3>' + editar + excluir + '</li>';                
        $('.lista_video .ul_lista').append($(_HTML));
    }
    
    
</script>

<div id="dialog" style="display:none">
</div>
<div id="dialog_video" style="display:none">
</div>
<div id="div_conteudo_professor_editar_modulo">
    <div id="titulo_modulo"><h1>Modulo <?php echo $this->modulo->getNumero_modulo() ?>: <?php echo $this->modulo->getTitulo_modulo() ?></h1>
    <div id="disposicao_conteudo_professor_editar_modulo">
        <h4>Descricao: </h4>
        <div class="quadro_de_conteudo_especifico">
            <?php echo $this->modulo->getDescricao() ?>
        </div>
       

        <div class="">
            
            <div id="accordion_body2" class="" style="">
                <ul>
                    <li>
                        <div class="accordion_body">
                           
                            <div class='list_conteudo accord_body'>
                                
                                <img src="img/movie.png" style="float:left;" />  Video Aulas
                                
                            </div>      
                           
                            <div id="lista_video " class="accord_content_body" style="display:none;">                                                                
                                <ul class="add">
                                    
                                    <li>
                                        <input type="button" class="btn_add" name="video" id="index.php?c=ead&a=adicionar_videoaula&id=<?php echo $this->modulo->getId_modulo(); ?>" value="novo"/>
                                    </li>
                                    <?php echo $this->listaVideo; ?>                                    
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="accordion_body">
                            <div class='list_conteudo accord_body'>
                               
                                   <img src="img/text_enriched.png" />Textos de Referencia
                              
                            </div>                            
                            <div class="add accord_content_body" style="display:none;">
                                <ul>
                                    <?php echo $this->listaTexto; ?>
                                    <li>
                                        <input type="button" class="btn_add" name="texto" id="index.php?c=ead&a=adicionar_texto_referencia&id=<?php echo $this->modulo->getId_modulo(); ?>" value="novo"/>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="accordion_body">
                            <div class='list_conteudo accord_body'>
                               
                                <img src="img/folder-icon.png"/>Material Complementar
                               
                            </div>

                            <div class="add accord_content_body" style="display:none;">
                                <ul>
                                    <?php echo $this->listaMaterial; ?>
                                    <li>
                                        <input type="button" class="btn_add" name="material" id="index.php?c=ead&a=adicionar_material_complementar&id=<?php echo $this->modulo->getId_modulo(); ?>" value="novo"/>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="accordion_body">
                            <div class='list_conteudo accord_body'>
                                
                               <img src="img/check.png"/>     Exercicios
                                
                            </div>

                            <div class="add accord_content_body" style="display:none;">
                                <ul>
                                    <li>
                                        <input type="button" class="btn_add" name="exercicio" id="index.php?c=ead&a=adicionar_exercicio&id=<?php echo $this->modulo->getId_modulo(); ?>" value="novo"/>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</div>
