var verCurso, dialog, oTable, elem, nomeColunas = new Array();
            
function getGratuito(flag){
    if(flag == 1){
        return 'Sim';
    }
    if(flag == 0){
        return 'Não';
    }
}
function getStatus(status){
    if(status == 0){
        return 'Em construção';
    }
    if(status == 1){
        return 'Não avaliado';
    }
    if(status == 2){
        return 'Rejeitado';
    }
    if(status == 3){
        return 'Aprovado e indisponível';
    }
    if(status == 3){
        return 'Aprovado e disponível';
    }
        
}
            
function updateDataTables(_form, _data){//Adicionar essa função        
    var fields_value = new Array();
    for (var i=0; i<nomeColunas.length; i++) {
        if(i > 5){
            fields_value.push(_data[i]);
        }else{
            if(nomeColunas[i] == 'gratuito'){                                               
                fields_value.push(getGratuito($(_form).find('input[name="'+nomeColunas[i]+'"]:checked').val()));//com valor filtrado getGratuito()
            }else{                    
                if(i == 4){
                    fields_value.push(_data[i]);
                }else{                        
                    fields_value.push($(_form).find('#'+nomeColunas[i]).val());                
                }
            }                
        }
    }
    oTable.fnUpdate(fields_value, oTable.fnGetPosition(elem[0]));        
}
    
function updateDataTables_status(status){//Adicionar essa função        
    var _data = oTable.fnGetData(elem[0]);
    switch (status){            
        case 2:
            _data[11] = "<input type='checkbox' value='0' disabled='true' id='check_habilitar' />";
            _data[4] = "Rejeitado";
            break;
        case 3:
            _data[11] = "<input name="+$(elem).attr('id')+" type='checkbox' value='1' id='check_habilitar'/>";
            _data[4] = "Aprovado";
            break;
        case 4:
            _data[11] = "<input name="+$(elem).attr('id')+" type='checkbox' checked='checked' value='0' id='check_habilitar'/>";
            _data[4] = "Aprovado";
            break;
        default:
            _data[11] = "<input type='checkbox' value='0' disabled='true' id='check_habilitar'/>";
            _data[4] = "Não avaliado";
            break;
    }
    oTable.fnUpdate(_data, oTable.fnGetPosition(elem[0]));        
}        
    
function insertDataTables(_form, json){//Adicionar essa função  
    var fields_value = new Array();
    for (var i=0; i<6; i++) {
        if(i == 4){
            fields_value.push(getStatus(json.status));
        }else{
            if(nomeColunas[i] == 'gratuito'){
                fields_value.push(getGratuito($(_form).find('input[name="'+nomeColunas[i]+'"]:checked').val()));//com valor filtrado getGratuito()
            }else{
                fields_value.push($(_form).find('#'+nomeColunas[i]).val());
            }
        }
    }
    fields_value.push(json.numero_modulos);        
    fields_value.push(json.objetivo);       
    fields_value.push(json.justificativa);        
    fields_value.push(json.obs);        
    fields_value.push(json.id);        
    fields_value.push("<input type='checkbox' value='0' disabled='true' id='check_habilitar' />");
        
    oTable.fnAddData(fields_value, true);
}
    
$(document).ready(function(){ 
    //capturando nome das colunas da tabela para lógica replace de ids        
    $('thead th').each(function(){
        var texto = $(this).text().split(' ');
        texto = texto[0].toLowerCase();
        nomeColunas.push(texto);
    });
        
    oTable = $("#tabela_cursos").dataTable({
        "aoColumnDefs": [ 
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 5 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 6 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 7 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 8 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 9 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 10 ], 
            "sTitle":"rendering"
        }
        ],
        "bJQueryUI":true
    });
            
    $('#check_habilitar').live('change', function(){
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
        
    $('#tabela_cursos tr').live('click',function(e){
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        } else {
            oTable.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });  
        
    $('#aprovar_curso').live('click', function(){                
        if (elem.length) {
            var id_curso = $(elem).attr('id');                    
            $.getJSON('ajax/avaliar_curso.php', {
                id_curso: id_curso, 
                acao:'aprovar'
            }, function(j){
                if(j == 1){
                    updateDataTables_status(3);
                    alert('Curso aprovado com sucesso!');
                    dialog.dialog('close');
                }else{
                    if(j == 0){
                        alert('Curso já avaliado');                                
                    }else{
                        alert('Curso em construção');
                    }                            
                }
            });
        }            
    });
        
    $('#reprovar_curso').live('click', function(){
        if (elem.length) {
            var id_curso = $(elem).attr('id');                    
            $.getJSON('ajax/avaliar_curso.php', {
                id_curso: id_curso, 
                acao:'reprovar'
            }, function(j){
                if(j == 1){
                    updateDataTables_status(2);
                    alert('Curso reprovado com sucesso!');
                    dialog.dialog('close');
                }else{
                    if(j == 0){
                        alert('Curso já avaliado');                                
                    }else{
                        alert('Curso em construção');
                    }
                }
            });
        }
    });
        
        
    $('#btn_analisar').live('click', function(){            
        elem = $('tbody tr.row_selected');
        if(elem.length){
            var _data = oTable.fnGetData(elem[0]);
            var _HTML = $('#dialog_avaliarCurso').html(); 
            var id_imagem = "00";
            $.getJSON('ajax/verificaImagem.php',{
                id: _data[10], 
                tipo: "curso", 
                ajax: 'true'
            }, function(j){       
                if(j == '1'){
                    id_imagem = _data[10];
                }
                _HTML = _HTML.replace('#NOME#', _data[0]);
                _HTML = _HTML.replace('#DESCRICAO#', _data[5]);
                _HTML = _HTML.replace('#JUSTIFICATIVA#', _data[8]);
                _HTML = _HTML.replace('#OBSERVACOES#', _data[9]);
                _HTML = _HTML.replace('#OBJETIVO#', _data[7]);
                _HTML = _HTML.replace('#IDCURSO#', _data[10]);
                _HTML = _HTML.replace('#IDCURSO#', _data[10]);                    
                _HTML = _HTML.replace('_id_img_curso', 'img_curso');
                _HTML = _HTML.replace('id_aprovar_curso', 'aprovar_curso');
                _HTML = _HTML.replace('id_reprovar_curso', 'reprovar_curso');
                _HTML = _HTML.replace('#ID_FOTO#', id_imagem);
                dialog = $(_HTML).dialog({
                    draggable: false,
                    resizable: false,
                    position: [(($(window).width()-900)/2), 15],
                    width:900,
                    show: {
                        effect: 'drop', 
                        direction: "up"
                    },
                    height: ($(window).height() - 40),
                    modal:true,                                          
                    close: function(event,ui){                     
                        $(dialog).dialog('destroy');
                        $(dialog).find('div').remove();
                    },
                    open: function(event, ui){
                    //                            $(this).find('#img_curso').src = "img/cursos/"+_data[10]+".jpg?" + new Date().getTime();
                    }
                });
            });
        }
    });
        
    $('#btn_edit').live('click',function(){
        elem = $('tbody tr.row_selected');
        if (elem.length) {
            var _data = oTable.fnGetData(elem[0]);
            var _column = oTable.fnGetData(elem[0]);                                
            //preselecionando combos e radio inputs:
            $('#_id_gratuito'+_data[2]).attr('checked', 'true');
            var _HTML = $('#dialog_form').html();                                
            var id_imagem = "00";
                    
            $.ajax({
                url: 'ajax/verificaImagem.php',
                dataType: 'json',                       
                data: {
                    id: _data[10], 
                    tipo: "curso", 
                    ajax: 'true'
                },
                async: false,
                success: function(data, textStatus, jqXHR){
                    if(data == '1'){
                        id_imagem = _data[10];
                    }
                }
            });
            $.getJSON('ajax/combosPickList_cadastroCurso.php?acao=comID',{
                id_curso: _data[10],       
                ajax: 'true'
            }, function(j){
                //preenchendo picklist
                _HTML = _HTML.replace('#OPTIONS_TODOS_PROFESSORES#', j.prof_dispo);                    
                _HTML = _HTML.replace('#OPTIONS_PROFESSORES_RESPONSAVEIS#', j.prof_curso);
                //alternando id's'
                //alterando ids e names                
                _HTML = _HTML.replace('_id_cadastro', 'cadastro');
                _HTML = _HTML.replace('_id_cadastro', 'cadastro');
                _HTML = _HTML.replace('_id_imagem', 'imagem');
                _HTML = _HTML.replace('_id_imagem', 'imagem');
                _HTML = _HTML.replace('_id_img_curso', 'img_curso');
                _HTML = _HTML.replace('_id_img_curso', 'img_curso');
                _HTML = _HTML.replace('_b_button_cadastrar', 'button_cadastrar');
                _HTML = _HTML.replace('_b_button_cadastrar', 'button_cadastrar');
                _HTML = _HTML.replace('_b_button_atualizar', 'button_atualizar');
                _HTML = _HTML.replace('_b_button_atualizar', 'button_atualizar');
                for(i = 0; i < nomeColunas.length; i++){
                    //inputs
                    _HTML = _HTML.replace('_id_'+nomeColunas[i], nomeColunas[i]);
                    _HTML = _HTML.replace('_id_'+nomeColunas[i], nomeColunas[i]);
                }
                //picklist
                _HTML = _HTML.replace('_id_origem', 'origem');
                _HTML = _HTML.replace('_id_origem', 'origem');
                _HTML = _HTML.replace('_id_add', 'add');
                _HTML = _HTML.replace('_id_remover', 'remover');
                _HTML = _HTML.replace('_id_destino', 'destino');
                _HTML = _HTML.replace('_id_destino', 'destino');
                _HTML = _HTML.replace('_id_id', 'id');
                _HTML = _HTML.replace('_id_id', 'id');
                //--
                //alterando valores
                _HTML = _HTML.replace('#NOME#', _data[0]);
                _HTML = _HTML.replace('#TEMPO#', _data[1]);                
                _HTML = _HTML.replace('#VALOR#', _data[3]);
                _HTML = _HTML.replace('#DESCRICAO#', _data[5]);
                _HTML = _HTML.replace('#ID_CURSO#', _data[10]);
                _HTML = _HTML.replace('#ID_FOTO#', id_imagem);
                //--gerando dialog
                dialog = $(_HTML).dialog({
                    draggable: false,
                    resizable: false,
                    position: [(($(window).width()-900)/2), 15],
                    width:900,
                    show: {
                        effect: 'drop', 
                        direction: "up"
                    },
                    height: ($(window).height() - 40),
                    modal:true,
                    zIndex: 3999,
                    //                        dialogClass:'dialogstyle',
                    close: function(event,ui){                
                        var form = $(this).find('#cadastro');
                        //des-preselecionando combos e radio inputs: 
                        if(_data[2] == 0){
                            $('#_id_gratuitoSim').removeAttr('checked');//sexo                    
                        }else{
                            $('#_id_gratuitoNao').removeAttr('checked');//sexo                    
                        }                        
                        dialog.dialog('destroy');
                        dialog.remove();
                    },
                    open: function(event, ui) { 
                        //Habilita a validação automática no formulário de cadastro
                        var form = $(this).find('#cadastro');
                        $(this).find('#img_curso').src = "img/cursos/"+_data[10]+".jpg?" + new Date().getTime();
                        $('#button_cadastrar').hide();
                        $('#button_atualizar').show();       
                        form.validate({
                            rules:{
                                nome: {
                                    required: true,
                                    remote: "ajax/validarCamposUnicos.php?acao=nome&controller=curso&id="+$("#id").val()
                                },
                                descricao: {
                                    required: true
                                },
                                tempo: {
                                    required: true,
                                    number: true
                                },
                                valor: {
                                    required: true
                                },
                                destino: {
                                    required: true
                                }
                            },
                            messages:{
                                nome: {
                                    remote: "Este nome de curso já está sendo utilizado"
                                }
                            }
                        });
                        //JS DO PICKLIST DO JAN
                        $(this).find('#add').live('click',function(){
                            $('#origem option:selected').each(function(){
                                $('#destino').append('<option selected="selected" value="'+$(this).val()+'">'+$(this).text()+'</option>');
                                $(this).remove();
                            });
                        });
	
                        $(this).find('#remover').live('click',function(){
                            $('#destino option:selected').each(function(){
                                $('#origem').append('<option value="'+$(this).val()+'">'+$(this).text()+'</option>');
                                $(this).remove();
                            });
                        });
                        //-----------fim js janquery picklist
                        form.attr('action', 'ajax/crud_curso.php?acao=atualizar');
                        form.live('submit',function(){//adicionar esse evento
                            form.ajaxSubmit({
                                dataType: 'json',
                                success:function (json){
                                    if(json != false){
                                        updateDataTables(form, _data);
                                        dialog.dialog('close');                                        
                                    }                                                                        
                                }
                            },
                            $("#destino option").each(function(){
                                $(this).attr({
                                    selected:'selected'
                                });
                            }));
                            return false;
                        });                        
                    }                    
                });                
            });
        }
    });               
        
    $('#btn_add').live('click',function(){                                                                   
        var _HTML = $('#dialog_form').html();      
        //preparando picklist do curso:                
        $.getJSON('ajax/combosPickList_cadastroCurso.php?acao=semID',{                       
            ajax: 'true'
        }, function(j){
            if(j != 'false'){                    
                //preenchendo picklist
                _HTML = _HTML.replace('#OPTIONS_TODOS_PROFESSORES#', j);                    
                _HTML = _HTML.replace('#OPTIONS_PROFESSORES_RESPONSAVEIS#', '');
                //alternando id's'
                //alterando ids e names                
                _HTML = _HTML.replace('_id_cadastro', 'cadastro');
                _HTML = _HTML.replace('_id_cadastro', 'cadastro');
                for(i = 0; i < nomeColunas.length; i++){
                    //inputs
                    _HTML = _HTML.replace('_id_'+nomeColunas[i], nomeColunas[i]);
                    _HTML = _HTML.replace('_id_'+nomeColunas[i], nomeColunas[i]);
                }
                //picklist
                _HTML = _HTML.replace('_id_origem', 'origem');
                _HTML = _HTML.replace('_id_origem', 'origem');
                _HTML = _HTML.replace('_id_add', 'add');
                _HTML = _HTML.replace('_id_remover', 'remover');
                _HTML = _HTML.replace('_id_destino', 'destino');
                _HTML = _HTML.replace('_id_destino', 'destino');                    
                _HTML = _HTML.replace('_id_imagem', 'imagem');
                _HTML = _HTML.replace('_id_imagem', 'imagem');
                _HTML = _HTML.replace('_id_img_curso', 'img_curso');
                _HTML = _HTML.replace('_id_img_curso', 'img_curso');
                _HTML = _HTML.replace('_b_button_cadastrar', 'button_cadastrar');
                _HTML = _HTML.replace('_b_button_cadastrar', 'button_cadastrar');
                _HTML = _HTML.replace('_b_button_atualizar', 'button_atualizar');
                _HTML = _HTML.replace('_b_button_atualizar', 'button_atualizar');
                _HTML = _HTML.replace('_id_id', 'id');
                _HTML = _HTML.replace('_id_id', 'id');
                //--
                //alterando valores
                _HTML = _HTML.replace('#NOME#', '');
                _HTML = _HTML.replace('#TEMPO#', '');                
                _HTML = _HTML.replace('#VALOR#', '');
                _HTML = _HTML.replace('#DESCRICAO#', '');
                _HTML = _HTML.replace('#ID_CURSO#', -1);
                _HTML = _HTML.replace('#ID_FOTO#', '00');
                //--gerando dialog
                dialog = $(_HTML).dialog({
                    draggable: false,
                    resizable: false,
                    position: [(($(window).width()-900)/2), 15],
                    width:900,
                    show: {
                        effect: 'drop', 
                        direction: "up"
                    },
                    height: ($(window).height() - 40),
                    modal:true,  
                    //                            dialogClass:'dialogstyle',
                    close: function(event,ui){                                           
                        var form = $(this).find('#cadastro');                     
                        dialog.dialog('destroy');
                        dialog.remove();
                    },
                    open: function(event, ui) { 
                        //Habilita a validação automática no formulário de cadastro
                        var form = $(this).find('#cadastro');
                        form.validate({
                            rules:{
                                nome: {
                                    required: true,
                                    remote: "ajax/validarCamposUnicos.php?acao=nome&controller=curso&id="+$("#id").val()
                                },
                                descricao: {
                                    required: true
                                },
                                tempo: {
                                    required: true,
                                    number: true
                                },
                                valor: {
                                    required: true
                                },
                                destino: {
                                    required: true
                                }
                            },
                            messages:{
                                nome: {
                                    remote: "Este nome de curso já está sendo utilizado"
                                }
                            }
                        });
                        $('#button_cadastrar').show();
                        $('#button_atualizar').hide(); 
                        $(this).find('#add').live('click',function(){
                            $('#origem option:selected').each(function(){
                                $('#destino').append('<option selected="selected" value="'+$(this).val()+'">'+$(this).text()+'</option>');
                                $(this).remove();
                            });
                        });
	
                        $(this).find('#remover').live('click',function(){
                            $('#destino option:selected').each(function(){
                                $('#origem').append('<option value="'+$(this).val()+'">'+$(this).text()+'</option>');
                                $(this).remove();
                            });
                        });
                        //-----------fim js janquery picklist
                        form.attr('action', 'ajax/crud_curso.php?acao=inserir&getCurso=1')
                        form.live('submit',function(){//adicionar esse evento                               
                            form.ajaxSubmit({
                                dataType: 'json',
                                success: function(json){
                                    if(json != false){ 
                                        //                                        form.find('#id').val(json.id);
                                        insertDataTables(form, json);
                                        dialog.dialog('close');                                        
                                    }  
                                }
                            },
                            $("#destino option").each(function(){
                                $(this).attr({
                                    selected:'selected'
                                });
                            }));
                            return false;
                        });                   
                    }
                });                
            }else{
                alert('Não existe usuário professor para ser vinculado!');
            }
        });            
    });
        
    $('#btn_del').live('click',function(){
        elem = $('tbody tr.row_selected');
        if (elem.length == 1) { 
            var r = confirm('Deseja realmente deletar esse curso?');
            if(r == true){                    
                $.getJSON('ajax/crud_curso.php?acao=remover',{
                    id_curso: oTable.fnGetData(elem[0], 10),       
                    ajax: 'true'
                }, function(j){
                    //usuario excluido         
                    if(j == 1){                            
                        oTable.fnDeleteRow(elem[0], null, true);                            
                    }else{
                        if(j == 0){
                            alert('Existem dados no banco atrelados a este curso');
                        }
                    }
                });  
            }
        }
        
    });
});

function mascara_moeda(src){
    var tmp = src.value.replace(/[\D]+/g,'')+'';
    tmp = tmp.replace(/([0-9]{2})$/g, ",$1");  
    if( tmp.length > 6 )  
        tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");  
    src.value = tmp;
}

//Faz o input aceitar apenas números
function apenas_numero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
        if (tecla==8 || tecla==0) return true;
        else  return false;
    }
}