/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var dialog, oTable, elem, nomeColunas = new Array();
    
    
    
function updateDataTables(_form){
    var fields_value = new Array();
    var _data = oTable.fnGetData(elem[0]);
    for (var i=0; i<nomeColunas.length; i++) {
        if(nomeColunas[i] == 'sexo'){                
            fields_value.push($(_form).find('input[name="'+nomeColunas[i]+'"]:checked').val());
        }else{    
            valorCampo = $(_form).find('#'+nomeColunas[i]).val();
            if(nomeColunas[i] == 'id_papel'){
                valorCampo = _data[1];
            //                valorCampo = getNomePapel(valorCampo);
            }
            fields_value.push(valorCampo);                
        }
    }
    oTable.fnUpdate(fields_value, oTable.fnGetPosition(elem[0]));
}     
    
function insertDataTables(_form){//Adicionar essa função  
    var fields_value = new Array();
    for (var i=0; i<nomeColunas.length; i++) {
        if(nomeColunas[i] == 'sexo'){                
            fields_value.push($(_form).find('input[name="'+nomeColunas[i]+'"]:checked').val());
        }else{    
            valorCampo = $(_form).find('#'+nomeColunas[i]).val();
            if(nomeColunas[i] == 'id_papel'){
                valorCampo = getNomePapel(valorCampo);
            }
            fields_value.push(valorCampo);                
        }
    }
    oTable.fnAddData(fields_value, true);        
      
//        alert('merda');
//        $('#tabela_usuarios').load(oTable.$('tr').click());
}

    
$(document).ready(function a(){
    $('#foto').live('change',function(){
        $('#foto_usuario').html('<img src="img/gif/ajax-loader-f.gif" alt="Enviando..."/> Enviando...');
        /* Efetua o Upload sem dar refresh na pagina */
        $('#form_imagem').ajaxForm({
            target:'#foto_usuario' // o callback será no elemento com o id #visualizar
        }).submit();
        alert("c");
    });
    
    //capturando nome das colunas da tabela para lógica replace de ids
    i = 0;
    $('thead th').each(function(){            
        if($(this).text() == 'Nome'){
            nomeColunas[i++] = 'nome_completo';
        }else if($(this).text() == 'Permissão'){
            nomeColunas[i++] = 'id_papel';
        } else if ($(this).text() == 'Atuação'){
            nomeColunas[i++] = 'atuacao';                                
        }else nomeColunas[i++] = $(this).text();
    });
        
    oTable = $("#tabela_usuarios").dataTable({
        "aoColumnDefs": [ 
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 3 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 4 ], 
            "sTitle":"rendering"
        },
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
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 11 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 12 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 13 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 14 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 15 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 16 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 17 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 18 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 19 ], 
            "sTitle":"rendering"
        },
        {
            "bSearchable": false, 
            "bVisible": false, 
            "aTargets": [ 20 ], 
            "sTitle":"rendering"
        },
        {
            "sClass": "nome_usuario_datatable",
            "aTargets":[0]
        }
        ],
        "bJQueryUI":true
    });                   
        
    $('#tabela_usuarios tr').live('click',function(e){
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        } else {
            oTable.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });
                   
    $('#btn_edit').live('click',function(){
        elem = $('tbody tr.row_selected');
        if (elem.length) {
            var _data = oTable.fnGetData(elem[0]);
            var _column = oTable.fnGetData(elem[0]);                
                
            //preselecionando combos e radio inputs:                
            _data[2] = _data[2].replace(/\ /g, '_');
            _data[19] = _data[19].replace(/\ /g,'_');
            $('#perm_'+_data[1]).attr('selected', 'selected');//permissao
            $('#'+_data[2]).attr('selected', 'selected');//atuacao                                
            $('#'+_data[19]).attr('selected', 'selected');//estado
            $('#_id_'+_data[9]).attr('checked', 'true');//sexo
            if(_data[18] == 'Brasil'){
                $("#endereco_estado").show();
                $("#label_estado").show();
            }else{
                $("#endereco_estado").hide();
                $("#label_estado").hide();
            }
                
            var _HTML = $('#dialog_form').html();
            var id_imagem = "00";
            
            $.ajax({
                url: 'ajax/verificaImagem.php',
                dataType: 'json',                       
                data: {
                    id: _data[20], 
                    tipo: "usuario", 
                    ajax: 'true'
                },
                async: false,
                success: function(data, textStatus, jqXHR){
                    if(data == '1'){
                        id_imagem = _data[20];
                    }
                }
            });
            
            //alterando ids e names
            _HTML = _HTML.replace('_ID_FORM_', 'cadastro');                                
            _HTML = _HTML.replace('_ID_FORM_', 'cadastro');
            _HTML = _HTML.replace('_id_senha', 'senha');
            _HTML = _HTML.replace('_id_senha', 'senha');
            _HTML = _HTML.replace('_id_senha2', 'senha2');
            _HTML = _HTML.replace('_id_senha2', 'senha2');                                
            _HTML = _HTML.replace('_id_foto', 'foto');
            _HTML = _HTML.replace('_id_foto', 'foto');                                
            _HTML = _HTML.replace('_id_img_usuario', 'img_usuario');
            _HTML = _HTML.replace('_id_img_usuario', 'img_usuario');                                
            _HTML = _HTML.replace('_b_button_atualizar', 'button_atualizar');
            _HTML = _HTML.replace('_b_button_atualizar', 'button_atualizar');                                
            _HTML = _HTML.replace('_b_button_cadastrar', 'button_cadastrar');
            _HTML = _HTML.replace('_b_button_cadastrar', 'button_cadastrar');
            _HTML = _HTML.replace('_id_id', 'id');
            _HTML = _HTML.replace('_id_id', 'id');
            _HTML = _HTML.replace('_id_tr_id_papel', 'tr_id_papel');            
            for(i = 0; i < nomeColunas.length; i++){
                _HTML = _HTML.replace('_id_'+nomeColunas[i], nomeColunas[i]);
                _HTML = _HTML.replace('_id_'+nomeColunas[i], nomeColunas[i]);
                if(nomeColunas[i] == 'sexo'){
                    _HTML = _HTML.replace('_id_Masculino', 'Masculino');    
                    _HTML = _HTML.replace('_id_Feminino', 'Feminino');    
                }
            }
            //--
            //alterando valores
            _HTML = _HTML.replace('#NOME_COMPLETO#', _data[0]);
            _HTML = _HTML.replace('#CPF_PASSAPORTE#', _data[4]);
            _HTML = _HTML.replace('#RG#', _data[5]);
            _HTML = _HTML.replace('#DATA_NASCIMENTO#', _data[3]);
            _HTML = _HTML.replace('#TEL_PRINCIPAL#', _data[10]);
            _HTML = _HTML.replace('#TEL_SECUNDARIO#', _data[11]);
            _HTML = _HTML.replace('#ID_PROFISSIONAL#', _data[6]);
            _HTML = _HTML.replace('#DESCRICAO_PESSOAL#', _data[8]);
            _HTML = _HTML.replace('#RUA#', _data[13]);
            _HTML = _HTML.replace('#NUMERO#', _data[14]);
            _HTML = _HTML.replace('#COMPLEMENTO#', _data[15]);
            _HTML = _HTML.replace('#BAIRRO#', _data[16]);
            _HTML = _HTML.replace('#CIDADE#', _data[17]);
            _HTML = _HTML.replace('#PAIS#', _data[18]);                
            _HTML = _HTML.replace('#EMAIL#', _data[12]);                
            _HTML = _HTML.replace('#ID_USUARIO#', _data[20]);
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
                close: function(event,ui){                
                    var form = $(this).find('#cadastro');
                    //deselecionando combos                    
                    $('#perm_'+_data[1]).removeAttr('selected');//permissao
                    $('#'+_data[2]).removeAttr('selected');//atuacao
                    $('#'+_data[19]).removeAttr('selected');//estado                        
                    //                            $('#_id_'+_data[9]).removeAttr('checked');//sexo
                    //readcionando required nos campos senha
                    $('#_id_senha').attr('class', 'validate[required] text-input');
                    $('#_id_senha2').attr('class', 'validate[required,equals[senha]] text-input');                   
                    dialog.dialog('destroy');
                    dialog.remove();
                    $(".error").css("display","none");
                },
                open: function(event, ui) { 
                    //Habilita a validação automática no formulário de cadastro
                    var form = $(this).find('#cadastro');
                    $(this).find('#img_usuario').src = "img/profile/"+_data[20]+".jpg?" + new Date().getTime();
                    $('#button_cadastrar').hide();
                    $('#button_atualizar').show();
                    form.validate({
                        rules:{
                            nome_completo: {
                                required: true
                            },
                            id_papel: {
                                required: true
                            },
                            atuacao: {
                                required: true
                            },
                            sexo: {
                                required: true
                            },
                            cpf_passaporte: {
                                required: true,
                                number: true,
                                remote: 'ajax/validarCamposUnicos.php?acao=cpf_passaporte&controller=usuario&id='+$("#id").val()
                            },
                            endereco_rua: {
                                required: true
                            },
                            endereco_numero: {
                                required: true,
                                number: true
                            },
                            endereco_bairro: {
                                required: true
                            },
                            endereco_cidade: {
                                required: true
                            },
                            endereco_pais: {
                                required: true
                            },
                            email: {
                                required: true,
                                email: true,
                                remote: "ajax/validarCamposUnicos.php?acao=email&controller=usuario&id="+$("#id").val()
                            },
                            senha2: {
                                equalTo: "#senha"
                            }
                        },
                        messages:{
                            cpf_passaporte: {
                                remote: "Este CPF/Passaporte já está sendo utilizado"
                            },
                            email: {
                                remote: "Este login já está sendo utilizado."
                            }
                        }
                    }); //chamar a nova validação com as regras
                    $('#tr_id_papel').remove();//permissao
                    form.attr('action', 'ajax/crud_usuario.php?acao=atualizar');
                    form.live('submit',function(){
                        form.ajaxSubmit({
                            dataType:'json',
                            success:function(json){
                                if(json != false){
                                    updateDataTables(form);
                                    dialog.dialog('close');                                        
                                }                                                                        
                            }
                        })
                        return false;
                    });                        
                }                    
            });
        }
    });                    
        
        
    $('#btn_update').live('click',function(){//adicionar esse evento			
        //Chamada do AJAX            
        updateDataTables($(this).parent());
        $(dialog).dialog('destroy');
    });
        
    $('#btn_add').click(function(){                                              
        var _HTML2 = $('#dialog_form').html();
        //alterando ids e names                
        _HTML2 = _HTML2.replace('_ID_FORM_', 'cadastro2');                                
        _HTML2 = _HTML2.replace('_ID_FORM_', 'cadastro2');
        _HTML2 = _HTML2.replace('_id_senha', 'senha');
        _HTML2 = _HTML2.replace('_id_senha', 'senha');
        _HTML2 = _HTML2.replace('_id_senha2', 'senha2');
        _HTML2 = _HTML2.replace('_id_senha2', 'senha2');
        _HTML2 = _HTML2.replace('_id_foto', 'foto');
        _HTML2 = _HTML2.replace('_id_foto', 'foto');
        _HTML2 = _HTML2.replace('_b_button_cadastrar', 'button_cadastrar');
        _HTML2 = _HTML2.replace('_b_button_cadastrar', 'button_cadastrar');                                
        _HTML2 = _HTML2.replace('_b_button_atualizar', 'button_atualizar');
        _HTML2 = _HTML2.replace('_b_button_atualizar', 'button_atualizar');
        _HTML2 = _HTML2.replace('_id_id', 'id');
        _HTML2 = _HTML2.replace('_id_id', 'id');
        for(i = 0; i < nomeColunas.length; i++){
            _HTML2 = _HTML2.replace('_id_'+nomeColunas[i], nomeColunas[i]);
            _HTML2 = _HTML2.replace('_id_'+nomeColunas[i], nomeColunas[i]);
            if(nomeColunas[i] == 'sexo'){
                _HTML2 = _HTML2.replace('_id_Masculino', 'Masculino');    
                _HTML2 = _HTML2.replace('_id_Feminino', 'Feminino');    
            }
        }
        _HTML2 = _HTML2.replace('_ID_FORM_', 'formulario');
        _HTML2 = _HTML2.replace('#NOME_COMPLETO#', '');
        _HTML2 = _HTML2.replace('#CPF_PASSAPORTE#', '');
        _HTML2 = _HTML2.replace('#RG#', '');
        _HTML2 = _HTML2.replace('#DATA_NASCIMENTO#', '');
        _HTML2 = _HTML2.replace('#TEL_PRINCIPAL#', '');
        _HTML2 = _HTML2.replace('#TEL_SECUNDARIO#', '');
        _HTML2 = _HTML2.replace('#ID_PROFISSIONAL#', '');
        _HTML2 = _HTML2.replace('#DESCRICAO_PESSOAL#', '');
        _HTML2 = _HTML2.replace('#RUA#', '');
        _HTML2 = _HTML2.replace('#NUMERO#', '');
        _HTML2 = _HTML2.replace('#COMPLEMENTO#', '');
        _HTML2 = _HTML2.replace('#BAIRRO#', '');
        _HTML2 = _HTML2.replace('#CIDADE#', '');
        _HTML2 = _HTML2.replace('#PAIS#', 'Brasil');
        _HTML2 = _HTML2.replace('#EMAIL#', '');
        _HTML2 = _HTML2.replace('#ID_USUARIO#', -1);
        _HTML2 = _HTML2.replace('#ID_FOTO#', '00');
            
        dialog2 = $(_HTML2).dialog({
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
                var form = $(this).find('#cadastro2');                        
                dialog2.dialog('destroy');
                dialog2.remove();
                $(".error").css("display","none");
            },
            open: function(event, ui) { 
                //Habilita a validação automática no formulário de cadastro
                var form = $(this).find('#cadastro2');
                $('#button_cadastrar').show();
                $('#button_atualizar').hide(); 
                form.validate({
                    rules:{
                        nome_completo: {
                            required: true
                        },
                        id_papel: {
                            required: true
                        },
                        atuacao: {
                            required: true
                        },
                        sexo: {
                            required: true
                        },
                        cpf_passaporte: {
                            required: true,
                            number: true,
                            remote: 'ajax/validarCamposUnicos.php?acao=cpf_passaporte&controller=usuario&id='+$("#id").val()
                        },
                        endereco_rua: {
                            required: true
                        },
                        endereco_numero: {
                            required: true,
                            number: true
                        },
                        endereco_bairro: {
                            required: true
                        },
                        endereco_cidade: {
                            required: true
                        },
                        endereco_pais: {
                            required: true
                        },
                        email: {
                            required: true,
                            email: true,
                            remote: "ajax/validarCamposUnicos.php?acao=email&controller=usuario&id="+$("#id").val()
                        },
                        senha: {
                            required: true
                        },
                        senha2: {
                            required: true,
                            equalTo: "#senha"
                        }
                    },
                    messages:{
                        cpf_passaporte: {
                            remote: "Este CPF/Passaporte já está sendo utilizado."
                        },
                        email: {
                            remote: "Este login já está sendo utilizado."
                        }
                    }
                });
                form.live('submit',function(){//adicionar esse evento
                    $(this).ajaxSubmit({
                        dataType: 'json',
                        success: function(json){
                            if(json != false){           
                                json = json.replace('"', '');
                                json = json.replace('"', '');
                                json = json.replace(' ', '');                                        
                                form.find('#id').val(json);
                                insertDataTables(form);                                       
                                dialog2.dialog('close');                                    
                            }   
                        }
                    });                                    
                    return false;
                });
            }
        });            
    });
    
    
    $('#btn_view').click(function(){
        elem = $('tbody tr.row_selected');
        if (elem.length) {
            var _data = oTable.fnGetData(elem[0]);
            var _HTML = $('#dialog_profile').html();
                
            var id_imagem = "00";
            $.getJSON('ajax/verificaImagem.php',{
                id: _data[20], 
                tipo: "usuario", 
                ajax: 'true'
            }, function(j){       
                if(j == '1'){
                    id_imagem = _data[20];
                }
                _HTML = _HTML.replace('#ATUACAO#', _data[2]);
                _HTML = _HTML.replace('#SEXO#', _data[9]);
                _HTML = _HTML.replace('#PAPEL#', _data[1]);
                _HTML = _HTML.replace('#NOME_COMPLETO#', _data[0]);               
                _HTML = _HTML.replace('#DATA_NASCIMENTO#', _data[3]);                                
                _HTML = _HTML.replace('#DESCRICAO#', _data[8]);              
                _HTML = _HTML.replace('#CIDADE#', _data[17]);
                _HTML = _HTML.replace('#EMAIL#', _data[12]);
                _HTML = _HTML.replace('#FOTO#', id_imagem);
        
                $(_HTML).dialog({
                    draggable: false,
                    resizable: false,
                    position: [(($(window).width()-900)/2), 15],
                    show: {
                        effect: 'drop', 
                        direction: "up"
                    },
                    width:900,
                    height: 350,
                    modal:true
                });
            });
        }
    });
    
    $('#btn_del').live('click',function(){
        elem = $('tbody tr.row_selected');
        if (elem.length == 1) { 
            var r = confirm('Deseja realmente deletar esse usuario?');
            if(r == true){                    
                $.getJSON('ajax/crud_usuario.php?acao=remover',{
                    id_usuario: oTable.fnGetData(elem[0], 20),       
                    ajax: 'true'
                }, function(j){
                    //usuario excluido         
                    if(j == 1){                            
                        oTable.fnDeleteRow(elem[0], null, true);                            
                    }
                });  
            }
        }        
    });
    
    $('#btn_bloq').live('click',function(){
        elem = $('tbody tr.row_selected');
        if (elem.length == 1) { 
            var r = confirm('Deseja realmente bloquear/desbloquear esse usuario?');
            if(r == true){    
                var _data = oTable.fnGetData(elem[0]);
                $.getJSON('ajax/crud_usuario.php?acao=bloquear',{
                    id_usuario: oTable.fnGetData(elem[0], 20),       
                    ajax: 'true'
                }, function(j){
                    //usuario liberado
                    if(j == 1){                        
                        oTable.fnUpdate("Liberado", oTable.fnGetPosition(elem[0]), 21); 
                        alert('Usuario liberado!');
                    }else{
                        //usuario bloqueado
                        if(j == 0){                                                    
                            oTable.fnUpdate("Bloqueado", oTable.fnGetPosition(elem[0]), 21);
                            alert('Usuario bloqueado!');
                        }else{
                            alert('Erro no servidor, tente novamente mais tarde!');
                        }
                    }
                });  
            }
        }        
    });
        
    $('#btn_ger_matricula').live('click',function(){
        elem = $('tbody tr.row_selected');
        var _data = oTable.fnGetData(elem[0]);
        if(_data[1] == 'Estudante'){
            if (elem.length == 1) {
                $('#dialog').load('index.php?a=gerenciar_matricula&c=ead&id='+elem.attr('id'), function(response, status, xhr) {
                    if (status == "error") {
                        alert('erro');
                        var msg = "Sorry but there was an error: ";
                        $("#error").html(msg + xhr.status + " " + xhr.statusText);
                    }else{                                                                                    
                        dialog = $('#dialog').dialog({
                            draggable: false,
                            resizable: false,
                            position: [(($(window).width()-900)/2), 15],
                            width:970,
                            show: {
                                effect: 'drop', 
                                direction: "up"
                            },
                            height: 600,
                            modal:true,                   
                            close: function(event,ui){                     
                                $(dialog).dialog('destroy');
                                $(dialog).find('div').remove();
                            }                                        
                        });
                    }
                });
            }
        }else{
            alert('Usuário selecionado não é estudante.');
        }
    });            
        
    function matricular_usuario(){
        $.getJSON('ajax/ajax-gerenciar_matricula.php', {
            id_usuario:elem.attr('id')
        }, function(j){
            if(j == 1){
                alert('Matriculado com sucesso!');
            }
        });
    }              

    //Captura o papel do usuário a ser editado e seta o combobox
    var papel = $("#i_papel");
    $("#id_papel").val(papel.val());
    //Captura a atuação do usuário a ser editado e seta o combobox
    var atuacao = $("#i_atuacao");
    $("#atuacao").val(atuacao.val());
//Verifica se o país é Brasil, captura o estado do usuário a ser editado e seta o combobox
//    var estado = $("#i_estado");
//    if(paisBrasil()){
//        $("#endereco_estado").val(estado.val());
//    }
//    else{
//        $("#endereco_estado").hide();
//    }
});
    
function getNomePapel(id){
    if(id == '1'){
        return 'Administrador';
    }
    if(id == '2'){
        return 'Gestor';
    }
    if(id == '3'){
        return 'Professor';
    }
    if(id == '4'){
        return 'Estudante';
    }
}
    
//Máscara de data
function mascara_data(src){
    var mask = '##/##/####';
    var i = src.value.length;
    var saida = mask.substring(0,1);
    var texto = mask.substring(i);              
    if (texto.substring(0,1) != saida)
    {
        src.value += texto.substring(0,1);
    }             
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
    
//Verifica se o país informado é Brasil e libera o combo de estados
function paisBrasil(){
    var pais = $("#endereco_pais").val();
    if(pais == "Brasil" || pais == "brasil" || pais == "BRASIL"){
        $("#endereco_estado").show();
        $("#label_estado").show();
        return true;
    }
    else{
        $("#endereco_estado").hide();
        $("#label_estado").hide();
        return false;
    }
}
