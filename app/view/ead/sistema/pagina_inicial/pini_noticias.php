<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<script>        
    $('#form_adicionar_noticia').live('submit', function(){
        var form = $(this);
        $(this).ajaxSubmit({
            uploadProgress: function(event, position, total, percentComplete) {
                $('progress').attr('value',percentComplete);
                $('#porcentagem').html(percentComplete+'%');
            },
            success: function(data){                                            
                $('progress').attr('value','100');
                $('#porcentagem').html('100%');
                if(!data){
                    alert('Operação não realizada, tente novamente mais tarde!');
                }else{                    
                    insereLinhaNoticia(form, data);
                }
                //                $('progress').attr('value',0);
                dialog.dialog('close');
            }
        });
        return false;
    });
    
    $('#form_editar_noticia').live('submit', function(){
        var form = $(this);
        $(this).ajaxSubmit({  
            uploadProgress: function(event, position, total, percentComplete) {
                $('progress').attr('value',percentComplete);
                $('#porcentagem').html(percentComplete+'%');
            },
            success: function(data){       
                $('progress').attr('value','100');
                $('#porcentagem').html('100%');
                if(!data){
                    alert('Operação não realizada, tente novamente mais tarde!');
                }else{                    
                    editarLinhaNoticia(form, data);
                }                
                dialog.dialog('close');
            }
        });
        return false;
    });
    
    $('.ref_ajax a:not(.link)').live('click', function(){    
        var name = $(this).attr('name');
        var id = $(this).attr('id');
        var _HTML = $('#div_'+name).html();
        _HTML = _HTML.replace('_ID_FORM_', 'form_'+name);
        _HTML = _HTML.replace('_ID_SUBMIT_', 'submit');
        _HTML = _HTML.replace('_ID_PORCENTAGEM_', 'porcentagem');
        _HTML = _HTML.replace('_ID_PROGRESS_', 'progress');
        if(name == 'adicionar_noticia'){            
            _HTML = _HTML.replace('_ID_NOTICIA_', 'noticia');            
        }
        dialog = $(_HTML).dialog({
            draggable: false,
            resizable: false,
            position: [(($(window).width()-900)/2), 15],
            width:900,
            show: {
                effect: 'drop', 
                direction: "up"
            },
            height: 540,
            modal:true,                                          
            close: function(event,ui){                     
                $(dialog).dialog('destroy');
                $('progress').attr('value',0);
                $(dialog).remove();
            },
            open: function(event, ui){
                if(name == 'adicionar_noticia'){           
                    $('#noticia').jqte();
                    $('#form_adicionar_noticia').validate({
                        rules:{
                            titulo: {
                                required: true
                            },
                            autor: {
                                required: true
                            },
                            manchete: {
                                required: true
                            },
                            noticia: {
                                required: true
                            }
                        }
                    });
                }
            }
        });                
    });
    
    $('.edtpini').live('click', function(){       
        var name = $(this).attr('name');
        var id = $(this).attr('id');            
        var _HTML = $('#div_edt').load(id, function(){            
            dialogEditar(_HTML);
        });        
    });
            
    $('.remove_pini').live('click', function(){
        var id = $(this).attr('id');
        var name = $(this).attr('name');
        $.ajax({
            url: id,
            dataType: 'json',
            async: false,
            success: function(data){
                if(data){
                    $('#'+name).remove();
                }else{
                    alert('Operação não realizada, tente novamente mais tarde!');
                }
            }
        });
    });
    
    function insereLinhaNoticia(form, dados){                
        var data = $(form).find('#data').val();
        var data = dados.split('--');
        var id = data[0];
        var titulo = data[2];
        var manchete = data[3];
        data = data[1];
        var linha = "<div id='div_comentario_"+id+"' class='comentario b_2'><div><p><b>:: </b>" + data + " -<b> " + titulo + "</b></p>";
        linha += "<span>" + manchete + "</span></div>";
        linha += "<div style='margin: 5px 0;'><a class='button3 edtpini' style='margin-right: 5px;' href='#' name='editar_noticia' id='index.php?c=ead&a=pini_editar_noticia&id=" + id + "'>Editar</a><a name='div_comentario_"+id+"' class='button3 remove_pini' href='#' id='index.php?c=ead&a=pini_noticias&id=" + id + "'>Remover</a></div>";        
        linha += "</div>";
        $('#lista_noticia').append($(linha));
    }
    
    function editarLinhaNoticia(form, dados){                
        var data = $(form).find('#data').val();
        var data = dados.split('--');
        var id = data[0];
        var titulo = data[2];
        var manchete = data[3];
        data = data[1];                 
        $('#div_noticia_'+id).html("<div><p><b>:: </b>" + data + " -<b> " + titulo + "</b></p><span>" + manchete + "</span></div><div style='margin: 5px 0;'><a class='button3 edtpini' style='margin-right: 5px;' href='#' name='editar_noticia' id='index.php?c=ead&a=pini_editar_noticia&id=" + id + "'>Editar</a><a name='div_comentario_"+id+"' class='button3 remove_pini' href='#' id='index.php?c=ead&a=pini_noticias&id=" + id + "'>Remover</a></div>");
        //        document.getElementById('div_comentario_'+id).innerHTML = "<div><p><b>:: </b>" + data + " -<b> " + titulo + "</b></p><span>" + manchete + "</span></div><div style='margin: 5px 0;'><a class='button3 edtpini' style='margin-right: 5px;' href='#' name='editar_noticia' id='index.php?c=ead&a=pini_editar_noticia&id=" + id + "'>Editar</a><a name='div_comentario_"+id+"' class='button3 remove_pini' href='#' id='index.php?c=ead&a=pini_noticias&id=" + id + "'>Remover</a></div>";        
    }
    
    function dialogEditar(_HTML){        
        dialog = _HTML.dialog({
            draggable: false,
            resizable: false,
            position: [(($(window).width()-900)/2), 15],
            width:900,
            show: {
                effect: 'drop', 
                direction: "up"
            },
            height: 500,
            modal:true,
            close: function(event,ui){                     
                $(dialog).dialog('destroy');
                $('progress').attr('value',0);
                $(dialog).find('#div_editar_noticia');
            },
            open: function(event, ui){                
                 
            }
        });         
    }
   
</script>

<?php require ROOT_PATH . '/app/view/ead/sistema/pagina_inicial/pini_adicionar_noticia.php'; ?>
<div style="display: none;" id="div_edt"></div>
<div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
    <h3 style="margin: 0;">Notícias</h3><br>
    <div id="noticias_gerencia">
        <div class="ref_ajax">        
            <a href="#" name="adicionar_noticia" id="index.php?c=ead&a=pini_adicionar_noticia" style="text-decoration: none;" class="button2"> Adicionar Notícia</a><br><br>
        </div>
        <div id="lista_noticia" style="border-top: 1px solid #ddd; border-right: 1px solid #ddd;">
            <?php
            $controller = new controllerSistema();
            echo $controller->listaNoticia();
            ?>
        </div>
    </div>
    <br><br>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
