var oTable_matricula, flag_tb_matricula = 0, elem_matricula, id_curso;

function updateDataTables_matricula(){   
    elem_matricula = $('tbody tr.row_selected');
    if(elem_matricula.length > 0){
        var fields_value = new Array();
        var _data = oTable_matricula.fnGetData(elem_matricula[0])        
        fields_value.push(_data[0]);
        fields_value.push("<input type='checkbox' value='1' id='check_liberar_matricula'/>");
        fields_value.push(_data[2]);
        fields_value.push(_data[3]);
    }
    oTable_matricula.fnUpdate(fields_value, oTable_matricula.fnGetPosition(elem_matricula[0]));        
}

$('#tabela_matricula_cursos tr').live('click',function(e){   
    alert('tr');
    if ( $(this).hasClass('row_selected') ) {
        $(this).removeClass('row_selected');
    } else {
        oTable_matricula.$('tr.row_selected').removeClass('row_selected');
        $(this).addClass('row_selected');  
        if(flag_tb_matricula == 1){
            flag_tb_matricula = 0;                        
            var id_usuario = elem.attr('id');            
            $.getJSON("ajax/ajax-gerenciar_matricula.php", {
                acao: 'matricular',
                id_usuario: id_usuario, 
                id_curso: id_curso
            }, function(j){
                if(j == 1){
                    //deu certo                    
                    updateDataTables_matricula();
                }else{
                //deu errado
                }
            });
        }
    }
});

//acao do botão matricular - matricula o usuario selecionado no curso
$('.btn_matricular').live('click', function(){
    alert('botao');
    if(flag_tb_matricula == 0){
        flag_tb_matricula = 1;
        id_curso = $(this).attr('id');        
    }
    alert(flag_tb_matricula);
//    var id_curso = $(this).attr('id');
//    var id_usuario = elem.attr('id');    
//    alert('aqui!!');
//    $.getJSON("ajax/ajax-gerenciar_matricula.php", {
//        acao: 'matricular',
//        id_usuario: id_usuario, 
//        id_curso: id_curso
//    }, function(j){
//        if(j == 1){
//            //deu certo
//            flag_tb_matricula = 1;
//            updateDataTables_matricula();
//        }else{
//        //deu errado
//        }
//    });
})

$('#check_liberar_matricula').live('change', function(){                                
    var id_curso = $(this).attr('name');                       
    var chave = $(this).val();
    var check = this;
    $.getJSON('ajax/avaliar_curso.php', {
        chave_disponibilizar: chave, 
        id_curso: id_curso, 
        acao:'habilitar'
    }, function(j){
        if(j == 1){
            $(check).removeAttr('value');                        
            if(chave == 1){
                $(check).attr('value', '0');                            
                alert("Curso disponibilizado");
            }else{                            
                $(check).attr('value', '1');                            
                alert("Curso indisponibilizado");
            }
        }else{
            alert('erro ao disponibilizar');
        }
    });
});