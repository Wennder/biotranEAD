<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<script>
    $('#form_adicionar_patrocinador').live('submit', function(){
        $(this).ajaxSubmit({    
            uploadProgress: function(event, position, total, percentComplete) {
                $('#progress').attr('value',percentComplete);
                $('#porcentagem').html(percentComplete+'%');
            },
            success: function(data){                                            
                if(!data){
                    alert('Operação não realizada, tente novamente mais tarde!');
                }else{                    
                    insereLinhaPatrocinador($('#form_adicionar_patrocinador'), data);
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
                $(dialog).remove();
            },
            open: function(event, ui){                                
            }
        });
    });
    
    function insereLinhaPatrocinador(form, dados){
        var id = dados.split('--');
        var src = id[0];
        id = id[1];
        var linha = "<tr id='tr_patrocinador_"+id+"'><td><div style='margin: 5px;'><div><a class='button3 remove_pini' href='#' name='tr_patrocinador_"+id+"' id='index.php?c=ead&a=pini_patrocinadores&id=" + id + "' style='position:relative; float:right; text-decoration:none; margin-bottom: 5px;'>Remover</a></div><img src='" + src + "' /></div></td></tr>";
        $('#table_lista').append($(linha));
    }   
</script>

<?php require ROOT_PATH . '/app/view/ead/sistema/pagina_inicial/pini_adicionar_patrocinador.php'; ?>

<div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
    <h3 style="margin: 0;">Parceiros</h3><br>
    <div id="patrocinadores_gerencia">
        <div class="ref_ajax">
            <a name="adicionar_patrocinador" href="#" id="index.php?c=ead&a=pini_adicionar_patrocinador" style="text-decoration: none;" class="button2"> Adicionar Parceiro</a><br><br>
        </div>
        <div id="lista_destaque">
            <?php $controller = new controllerSistema();
            echo $controller->listaPatrocinadores(); ?>
        </div>
    </div>
    <br><br>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
