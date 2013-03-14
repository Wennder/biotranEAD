var HTML_desempenho = '<div id="dialog_desempenho">'
        + '<div id="desempenho" style="display:none;">'
        +'<center><b>--#NOMECURSO#--</b></center>'
        +'<center><b>Desempenho de #NOMEUSUARIO#</b></center>'
        +'<fieldset>'
        +'<legend>Desempenho</legend>'
        +'<table style="width: 100%;">'
        +'<tr><td><table><tr>'
        +'<td>'
        +'<label class="label_profile">Média de acertos por exercícios realizados: </label>'
        +'<label class="label_profile">#MEDIA_EXERCICIO#%</label>'
        +'</td>'
        +'</tr>'
        +'<tr>'
        +'<td>'
        +'<label class="label_profile">Progresso no curso: </label>'
        +'<label class="label_profile">#PROGRESSO#</label>'
        +'</td></tr></table></td>'
        +'</tr>'
        +'<tr>'
        +'<td>'
        +'**Aqui explica como foi calculado o desempenho'
        +'</td>'
        +'</tr>'
        +'<tr><td colspan="2"</td></tr>'
        +'</table>'
        +'</fieldset>'
        +'</div>'
        +'</div>';
    
$(document).ready(function(){                
    $('#btn_ver_desempenho').live('click', function(){
        var id_matricula_curso = $(this).attr('name');            
        var nome_curso = $('#i_nome_curso').val();
        var nome_usuario = $('#i_nome_usuario').val();
        var _HTML = $(HTML_desempenho).html();
        var desempenho = 0;
        $.ajax({
            dataType: 'json',
            data: {
                id_matricula_curso: id_matricula_curso
            },
            url: 'ajax/ajax-gerenciar_matricula.php?acao=calcular_desempenho',
            async: false,
            success: function(data){
                desempenho = data;
            }
        });
        _HTML = _HTML.replace('#NOMECURSO#', nome_curso);
        _HTML = _HTML.replace('#MEDIA_EXERCICIO#', desempenho);
        _HTML = _HTML.replace('#NOMEUSUARIO#', nome_usuario);
        _HTML = _HTML.replace('#PROGRESSO#', '100% - finalizado');
        dialog_desempenho = $(_HTML).dialog({
            draggable: false,
            resizable: false,
            position: [(($(window).width()-900)/2), 15],
            width:300,
            show: {
                effect: 'drop', 
                direction: "up"
            },
            height: 300,
            modal:true,                                          
            close: function(event,ui){                     
                $(dialog_desempenho).dialog('destroy');
                $(dialog_desempenho).find('div').remove();
            },
            open: function(event, ui){
            }
        });                        
    });
});