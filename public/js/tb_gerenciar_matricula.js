var oTable_matricula, elem_matricula, id_curso;

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