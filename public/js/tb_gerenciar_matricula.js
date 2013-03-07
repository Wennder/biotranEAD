var oTable_matricula, elem_matricula, id_curso, HTML_desempenho, dialog_desempenho;

HTML_desempenho = '<div id="dialog_desempenho">'
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

oTable_matricula = $('#tabela_matricula_cursos').dataTable({
    "bJQueryUI":true
});

function updateDataTables_matricula(){   
    //    elem_matricula = $('tbody tr.row_selected');
    if(elem_matricula.length > 0){
        var fields_value = new Array();
        var _data = oTable_matricula.fnGetData(elem_matricula[0])   
        var id_matricula = elem_matricula.attr('id');        
        fields_value.push(_data[0]);
        fields_value.push("<input type='checkbox' value='1' id='check_liberar_matricula' name='"+id_matricula+"'/>");
        fields_value.push(_data[2]);
        fields_value.push(_data[3]);
        fields_value.push("<input type='text' value='' id='data-"+id_matricula+"' name='"+id_matricula+"' class='i_data_termino' />");
    }
    oTable_matricula.fnUpdate(fields_value, oTable_matricula.fnGetPosition(elem_matricula[0]));
    $('#data-'+id_matricula).datepicker({
        dateFormat: "dd/mm/yy",
        minDate: 1,
        onClose: function (selected, dpinstance){                                
            if(selected != ''){
                $.getJSON('ajax/ajax-gerenciar_matricula.php', {
                    data: selected,
                    id_matricula_curso: $(this).attr('name'),
                    acao:'atualizar_data'
                }, function(j){
                    if(j != 1){                            
                        alert('erro ao alterar data, tente novamente');
                    }
                });
            }
        }
    });
}

$('#tabela_matricula_cursos tr').live('click',function(e){   
    if ( $(this).hasClass('row_selected') ) {
        $(this).removeClass('row_selected');
    } else {
        oTable_matricula.$('tr.row_selected').removeClass('row_selected');
        $(this).addClass('row_selected');  
    }
});

//acao do botão matricular - matricula o usuario selecionado no curso
$('#btn_matricular').live('click', function(){    
    elem_matricula = $('#tbody_tb_ger_matricula tr.row_selected');    
    if (elem_matricula.length && (elem_matricula.attr('name') == 'nova_matricula')) {
        var r = confirm("Tem certeza? Uma vez matriculado não será possível remover a matrícula, apenas bloquear.");
        if(r){
            id_curso = elem_matricula.attr('id');        
            var id_usuario = elem.attr('id');        
            $.getJSON("ajax/ajax-gerenciar_matricula.php", {
                acao: 'matricular',
                id_usuario: id_usuario, 
                id_curso: id_curso
            }, function(j){
                if(j != 0){
                    //deu certo
                    oTable_matricula.$('tr.row_selected').attr('id',j);
                    elem_matricula = oTable_matricula.$('tr.row_selected');
                    updateDataTables_matricula();
                }else{
                //deu errado
                }
            });                        
        }
    }else{
        if(elem_matricula.attr('name') == 'matricula'){
            alert('Já matriculado!');
        }
    }
})

//acao do botão visualizar desemepnho - Desemepenho do usuario selecionado no curso
$('#btn_desempenho').live('click', function(){    
    elem_matricula = $('#tbody_tb_ger_matricula tr.row_selected');    
    if (elem_matricula.length && (elem_matricula.attr('name') == 'matricula')) {        
        var _data = oTable.fnGetData(elem[0]);
        var _datamc = oTable_matricula.fnGetData(elem_matricula[0]);
        var _HTML = $(HTML_desempenho).html();
        var desempenho = 0;
        $.ajax({
           dataType: 'json',
           data: {id_matricula_curso: elem_matricula.attr('id')},
           url: 'ajax/ajax-gerenciar_matricula.php?acao=calcular_desempenho',
           async: false,
           success: function(data){
               desempenho = data;
           }
        });
        _HTML = _HTML.replace('#NOMECURSO#', _datamc[0]);
               _HTML = _HTML.replace('#MEDIA_EXERCICIO#', desempenho);
        _HTML = _HTML.replace('#NOMEUSUARIO#', _data[0]);
        _HTML = _HTML.replace('#PROGRESSO#', _datamc[2]);                
        dialog_desempenho = $(_HTML).dialog({
            draggable: false,
            resizable: false,
            position: [(($(window).width()-900)/2), 15],
            width:300,
            show: {
                effect: 'drop', 
                direction: "up"
            },
            height: ($(window).height() - 40),
            modal:true,                                          
            close: function(event,ui){                     
                $(dialog_desempenho).dialog('destroy');
                $(dialog_desempenho).find('div').remove();
            },
            open: function(event, ui){
            }
        });            
    }
})

$('#check_liberar_matricula').live('change', function(){                                
    var id_matricula_curso = $(this).attr('name');                       
    var chave = $(this).val();
    var check = this;
    $.getJSON('ajax/ajax-gerenciar_matricula.php', {
        chave_disponibilizar: chave, 
        id_matricula_curso: id_matricula_curso, 
        acao:'liberar_acesso'
    }, function(j){
        if(j == 1){
            $(check).removeAttr('value');                        
            if(chave == 1){
                $(check).attr('value', '0');                            
                alert("Matricula liberada");
            }else{                            
                $(check).attr('value', '1');                            
                alert("Matricula bloqueada");
            }
        }else{
            alert('erro ao liberar');
        }
    });
});