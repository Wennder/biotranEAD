<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<script>
    $(document).ready(function(){
        $('#form_adicionar_comentario').validate({
            rules:{
                autor: {
                    required: true
                },
                comentario: {
                    required: true
                }
            }
        });
    });
    
    $('#form_adicionar_comentario').live('submit', function(){
        var form = $(this);
        $(this).ajaxSubmit({                        
            success: function(data){                                            
                if(!data){
                    alert('Operação não realizada, tente novamente mais tarde!');
                }else{                    
                    insereLinhaComentario(form, data);
                }
                dialog.dialog('close');
            }
        });
        return false;
    });
    
    $('.ref_ajax a:not(.link)').live('click', function(){
        var name = $(this).attr('name');
        var _HTML = $('#div_'+name).html();
        _HTML = _HTML.replace('_ID_FORM_', 'form_'+name);
        _HTML = _HTML.replace('_ID_SUBMIT_', 'submit');
        dialog = $(_HTML).dialog({
            draggable: false,
            resizable: false,
            position: [(($(window).width()-700)/2), 15],
            width:700,
            show: {
                effect: 'drop', 
                direction: "up"
            },
            height: 290,
            modal:true,                                          
            close: function(event,ui){                     
                $(dialog).dialog('destroy');
                $(dialog).find('div').remove();
            },
            open: function(event, ui){                                
            }
        });
    });
    
    function insereLinhaComentario(form, dados){        
        var autor = $(form).find('#autor').val();
        var comentario = $(form).find('#comentario').val();
        var data = dados.split('--');
        var id = data[0];
        data = data[1];
        var linha = "<div class='comentario b_2'><div><p><b>:: </b>" + data + " -<b> " + autor + "</b></p>";
        linha += "<span>" + comentario + "</span></div>";
        linha += "<div style='margin: 5px 0;'><a class='button3' href='index.php?c=ead&a=pini_comentarios&id=" + id + "'>Remover</a></div>";        
        linha += "</div>";
        $('#lista_comentario').append($(linha));
    }    
</script>

<?php require ROOT_PATH . '/app/view/ead/sistema/pagina_inicial/pini_adicionar_comentario.php'; ?>

<div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
    <h3 style="margin: 0;">Comentários</h3><br>
    <div id="comentarios_gerencia">
        <div class="ref_ajax">
            <a name="adicionar_comentario" href="#" id="index.php?c=ead&a=pini_adicionar_comentario" style="text-decoration: none;" class="button2"> Adicionar Comentário</a><br><br>
        </div>
        <div id="lista_comentario" style="border-top: 1px solid #ddd; border-right: 1px solid #ddd;">
            <?php
            $controller = new controllerSistema();
            echo $controller->listaComentarios();
            ?>
        </div>        
    </div>
    <br><br>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>