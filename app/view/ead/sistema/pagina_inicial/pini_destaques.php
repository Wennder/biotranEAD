<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>
<script>
    $('#form_adicionar_destaque').live('submit', function(){
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
                    insereLinhaDestaque($('#form_adicionar_destaque'), data);
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
            position: [(($(window).width()-600)/2), 15],
            width:600,
            show: {
                effect: 'drop', 
                direction: "up"
            },
            height: 180,
            modal:true,                                          
            close: function(event,ui){                     
                $(dialog).dialog('destroy');
                $('progress').attr('value','0');                
                $(dialog).remove();
            },
            open: function(event, ui){                                
            }
        });
    });
    
    function insereLinhaDestaque(form, dados){
        var id = dados.split('--');
        var src = id[0];
        id = id[1];
        var linha = "<div id='div_destaque_"+id+"'><div style='margin-bottom: 5px;'><a class='button3 remove_pini' name='div_destaque_"+id+"' href='#' id='index.php?c=ead&a=pini_destaques&id=" + id + "' style='position:relative; text-decoration:none;'>Remover</a></div><img src='" + src + "' /></div>"
        $('#lista_destaque').append($(linha));
    }   
</script>

<?php require ROOT_PATH . '/app/view/ead/sistema/pagina_inicial/pini_adicionar_destaque.php'; ?>

<div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
    <h3 style="margin: 0;">Destaques</h3><br>
    <div id="destaques_gerencia">
        <div class="ref_ajax">
            <a name="adicionar_destaque" href="#" id="index.php?c=ead&a=pini_adicionar_destaque" style="text-decoration: none;" class="button2"> Adicionar Destaque</a><br><br>
        </div>
        <div id="lista_destaque">
            <?php
            $controller = new controllerSistema();
            echo $controller->listaDestaques();
            ?>
        </div>
    </div>
    <br><br>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
