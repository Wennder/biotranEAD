
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

.conteudo_row{
    cursor: pointer;
    overflow: auto;
    padding:1px 5px;
    border-bottom:1px solid #f2f2f2;
    border-top:1px solid #f2f2f2;
}

.item_conteudo{
    float:left;
}

</style>

<script> 
    
    var dialog;
    $(document).ready(function() {                                                        
        //_V_.options.flash.swf = "video-js.swf";              
        
        //_V_.options.flash.swf = "video-js.swf";              
        
        $(".btn_edt").live('click', function(){                        
            var btn = $(this);
            $('#dialog').load(btn.attr('id'), function(response, status, xhr) {
                if (status == "error") {
                    alert('erro');
                    var msg = "Sorry but there was an error: ";
                    $("#error").html(msg + xhr.status + " " + xhr.statusText);
                }else{                                                                                    
                    dialog = $('#dialog').dialog({width:600, height:800,dialogClass:'dialogstyle',modal: true,
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
                                        insereLinha(data, tipo);
                                        alert('Arquivo inserido!');
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
        
        $(".btn_del").live('click', function(){            
            var btn = $(this);
            var r = confirm('Tem certeza de que deseja excluir este registro?');
            if(r == true){                  
                var id = btn.attr('id');                
                $.getJSON('ajax/crud_conteudo_modulo.php?acao=remover_'+btn.attr('name'),{
                    id: id,
                    ajax: 'true'
                }, function(j){
                    //usuario excluido  
                    if(j > 0){
                        id = '#li_'+btn.attr('name')+'_'+id;                        
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
                    
                    var width = 0;var height = 0; var title;
                    var tipo = btn.attr('name');
                    if(tipo == 'video'){
                        width = 800; height = 350; title = 'Adicionar Video Aula';
                    }else{
                        if(tipo == 'texto_referencia'){
                            width = 500; height = 250; title = 'Adicionar Texto de Referencia';
                        }else{
                            if(tipo == 'material_complementar'){
                                width = 500; height = 200; title = 'Adicionar Material Complementar';
                            }else{//novo exercício
                                width = 700; height = 300; title = 'Adicionar Exercicio';
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
                                        insereLinha(data, tipo);
                                        alert('Arquivo inserido!');
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
        
        $(".item_conteudo").live('click',function() {            
            var tag = $(this);            
            if(tag.attr('name') == 'video'){                
                $('#dialog_video').load(tag.attr('id'), 'oi', function (){                                    
                    var options = {width:700, height:400,dialogClass:'dialogstyle',
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
    
    function insereLinha(data, tipo){
        var id_modulo = $('#id_modulo').val();
        var id_curso = $('#id_curso').val();        
        data = data.split('-');
        data[0] = data[0].replace('"', '');
        data[1] = data[1].replace('"', '');        
        var excluir = '<input id="'+data[0]+'" name="'+tipo+'" type="button" class="btn_del" value="Excluir"/>';
        if(tipo == 'video' || tipo == 'exercicio'){
            var editar = '<input id="'+data[0]+'" name="'+tipo+'" type="button" class="btn_edt" value="Editar"/>';
            var _HTML = '<li id=li_'+tipo+'_'+data[0]+'><h3 class="item_conteudo" name="'+tipo+'" id="index.php?c=ead&a=janela_video&id='+data[0]+'">'+data[1] + '</h3>' + editar + excluir + '</li>';
        }else{            
            var _HTML = '<li id=li_'+tipo+'_'+data[0]+'><a name="'+tipo+'" href="cursos/'+id_curso+'/modulos/'+id_modulo+'/'+tipo+'/'+data[0]+'.pdf">'+data[1].toString() + '</a>' + excluir + '</li>';                            
        }
        tipo = '#lista_'+tipo+ ' .ul_lista';                
        $(tipo.toString()).aftappend($(_HTML));            
    }
    
    $('#btn_editar_modulo').click(function(){
        if($(this).attr('value') == 'Editar'){
            $('#titulo_modulo').removeAttr('readonly');
            $('#descricao').removeAttr('readonly');
            $('#div_atualizar_modulo').removeAttr('style');
            $(this).attr('value', 'Cancelar');            
        }else{
            $('#titulo_modulo').attr('readonly', 'true');
            $('#descricao').attr('readonly', 'true');
            $('#div_atualizar_modulo').attr('style', 'display:none;');
            $(this).attr('value', 'Editar');
        }
    });
    
    $('#btn_atualizar_modulo').click(function(){
        $.post('ajax/crud_conteudo_modulo.php?acao=atualizar_descritivo&id='+$('#id_modulo').val(), $('#form_descritivo').serialize(), function(json) {
            // handle response
            if(json != false){
                $('#titulo_modulo').attr('readonly', 'true');
                $('#descricao').attr('readonly', 'true');
                $('#div_atualizar_modulo').attr('style', 'display:none;');
                $('#btn_editar_modulo').attr('value', 'Editar');
                alert('Dados atualizados');
            }                                                                
        }, "json");                
    });        
    
</script>

<div id="dialog" style="display:none">
</div>
<div id="dialog_video" style="display:none">
</div>
<div id="div_conteudo_professor_editar_modulo">
    <div id="titulo_modulo"><h1>Modulo <?php echo $this->modulo->getNumero_modulo() ?></h1>
        <form id="form_descritivo">
            <div id="div_editar_modulo" align="right">
                <input type="button" name="btn_editar_modulo" id="btn_editar_modulo" value="Editar"/>
            </div>

            <h4>Titulo: </h4>        
            <input readonly="true" id="titulo_modulo" name="titulo_modulo" value="<?php echo $this->modulo->getTitulo_modulo(); ?>" />
            <h4>Descricao: </h4>        
            <textarea readonly="true" id="descricao" name="descricao"><?php echo $this->modulo->getDescricao() ?></textarea>                           

            <div id="div_atualizar_modulo" style="display: none">
                <input id="btn_atualizar_modulo" type="button" value="Atualizar"/>    
            </div>
        </form>    
    <div id="disposicao_conteudo_professor_editar_modulo">
        <h4>Descricao: </h4>
        <div class="quadro_de_conteudo_especifico">
            <?php echo $this->modulo->getDescricao() ?>
        </div>       
        <div class="">            
            <div id="accordion_body2">
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
                                    <li>
                                        <input type="button" class="btn_add" name="texto_referencia" id="index.php?c=ead&a=adicionar_texto_referencia&id=<?php echo $this->modulo->getId_modulo(); ?>" value="novo"/>
                                    </li>
                                    <?php echo $this->listaTexto; ?>
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
                                    <li>
                                        <input type="button" class="btn_add" name="material_complementar" id="index.php?c=ead&a=adicionar_material_complementar&id=<?php echo $this->modulo->getId_modulo(); ?>" value="novo"/>
                                    </li>
                                    <?php echo $this->listaMaterial; ?>
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
                                    <?php echo $this->listaExercicio; ?>
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
</div>
<div style="display:none;">
    <input type="text" name="id_modulo" id="id_modulo" value="<?php echo $this->modulo->getId_modulo(); ?>"/>
    <input type="text" name="id_curso" id="id_curso" value="<?php echo $this->modulo->getId_curso(); ?>"/>
</div>
