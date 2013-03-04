$('#form_add_modulo').live('submit', function(){        
    var form = $(this);
    $(this).ajaxSubmit({
        data:{
            acao: "adicionar", 
            id: $('#id').val()
            },
        dataType: 'json',
        success: function(data){                                            
            if(data){
                alert('Módulo adicionado, recarregando página!');
                document.location.reload();
            }
            dialog.dialog('close');
        }
    });
    return false;
});

$('#btn_add_modulo').live('click', function(){
    var HTML = '<div><form id="form_add_modulo" method="post" action="ajax/crud_modulo.php" enctype="multipart/form-data">'
    +'<table>'
    +'<tr>'
    +'<td>'
    +'<label>Numero do Módulo: </label>'
    +'</td>'
    +'<td>'
    +'<input type="text" name="numero_modulo" class="text-input" style="width: 40px;"/>'
    +'</td>'
    +'</tr>'
    +'<tr>'
    +'<td>'
    +'<label><b>Título: </b></label>'
    +'</td>'
    +'<td>'
    +'<input id="titulo_modulo" type="text" name="titulo_modulo" class="text-input" /><br>'
    +'</td>'
    +'</tr>'
    +'<tr>'
    +'<td>'
    +'<label style="margin: -10px 0 0 0;"><b>Descrição: </b></label>'
    +'</td>'
    +'<td>'
    +'<textarea type="text" id="descricao" name="descricao" class="text-area" rows="2" cols="29"></textarea>'
    +'</td>'
    +'</tr>'
    +'<tr><td><div>'
    +'<input id="btn_add_novo_modulo" type="submit" class="button2" value="Adicionar"/>'
    +'</div><td></tr>'
    +'</table>'
    +'</form></div>';
    var _HTML = $(HTML).html();        
    dialog = $(_HTML).dialog({
        draggable: false,
        resizable: false,
        position: [(($(window).width()-900)/2), 15],
        width:400,
        show: {
            effect: 'drop', 
            direction: "up"
        },
        height: (300),
        modal:true,                                          
        close: function(event,ui){                     
            $(dialog).dialog('destroy');
            $(dialog).find('div').remove();
            $(dialog).remove();
        },
        open: function(event, ui){                
        }
    });
});
    
$('#btn_del_modulo').live('click', function(){
    var r = confirm("Todo o conteúdo do módulo será apagado, tem certeza?");
    if(r){
        $.ajax({
            dataType:'json',
            data: {
                acao:'remover', 
                id: $('#id_modulo').val()
                },
            url: 'ajax/crud_modulo.php',
            success: function(data){
                if(data){
                    alert("Removido com sucesso, recarregando..");
                    document.location.reload();
                }else{
                    alert("Operação não realizada, tente novamente!");
                }
            }
        })
    }
});