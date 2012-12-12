<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<script>
    $('#form_adicionar_foto').live('submit', function(){
        var form = $(this);
        $(this).ajaxSubmit({    
            uploadProgress: function(event, position, total, percentComplete) {
                $('#progress').attr('value',percentComplete);
                $('#porcentagem').html(percentComplete+'%');
            },
            success: function(data){                                            
                if(!data){
                    alert('Operação não realizada, tente novamente mais tarde!');
                }else{                    
                    insereLinhaFoto(form, data);
                }
                dialog.dialog('close');
            }
        });
        return false;
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
    
    $('.ref_ajax a:not(.link)').live('click', function(){    
        var name = $(this).attr('name');
        var id = $(this).attr('id');        
        var _HTML = $('#div_'+name).html();
        _HTML = _HTML.replace('_ID_FORM_', 'form_'+name);
        _HTML = _HTML.replace('_ID_SUBMIT_', 'submit');
        _HTML = _HTML.replace('_ID_PORCENTAGEM_', 'porcentagem');
        _HTML = _HTML.replace('_ID_PROGRESS_', 'progress');
        dialog = $(_HTML).dialog({
            draggable: false,
            resizable: false,
            position: [(($(window).width()-900)/2), 15],
            width:900,
            show: {
                effect: 'drop', 
                direction: "up"
            },
            height: (300),
            modal:true,                                          
            close: function(event,ui){                     
                $(dialog).dialog('destroy');
                $(dialog).remove();
            },
            open: function(event, ui){                                
            }
        });
    });
    
    function insereLinhaFoto(form, dados){
        var id = dados.split('--');
        var src = id[0];
        id = id[1];
        var linha = "<div id='div_foto_"+id+"'><div style='margin-bottom: 5px;'><a class='button3 remove_pini' name='div_foto_"+id+"' href='#' id='index.php?c=ead&a=pini_fotos&id=" + id + "' style='position:relative; text-decoration:none;'>Remover</a></div><img src='" + src + "' /></div>"
        $('#lista_fotos').append($(linha));
    }   
</script>

<?php require ROOT_PATH . '/app/view/ead/sistema/pagina_inicial/pini_adicionar_foto.php'; ?>

<h2 style="margin-bottom: 50px; margin-left: 30px;">Foto</h2>

<div id="fotos_gerencia">
    <div class="ref_ajax">
        <a name="adicionar_foto" href="#" id="index.php?c=ead&a=pini_adicionar_foto">adicionar foto</a>
    </div>

    <div id="lista_fotos">
        <?php $controller = new controllerSistema();
        echo $controller->listaFotos(); ?>
    </div>
</div>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
