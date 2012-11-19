/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var dialog, oTable, oTable_matricula, elem, flag_tb_matricula = 0, nomeColunas = new Array();
    
    
    
    function updateDataTables(_form){
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
        oTable.fnUpdate(fields_value, oTable.fnGetPosition(elem[0]));        
    }
    
    function updateDataTables(){
        
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
    
    function preview(){
        alert($('#foto').value());
        $('#_id_img_usuario').attr('src', $('#foto').value());
        $('#_id_img_usuario').attr('width','100');
        $('#_id_img_usuario').attr('height','120');
    }
    
    $(document).ready(function a(){        
        
        
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
                { "bSearchable": false, "bVisible": false, "aTargets": [ 3 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 4 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 5 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 6 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 7 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 8 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 9 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 10 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 11 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 12 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 13 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 14 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 15 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 16 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 17 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 18 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 19 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 20 ], "sTitle":"rendering" },
                {"sClass": "nome_usuario_datatable",
                    "aTargets":[0]            
                },                
            ],                        
            "bJQueryUI":true,
            "bPaginate": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bLengthMenu": true            
        });                
        
        $('#tabela_usuarios tr').live('click',function(e){
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
            } else {
                oTable.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
        });
        
        $('#tabela_matricula_cursos tr').live('click',function(e){
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
            } else {
                oTable.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
                if(flag_tb_matricula == 1){
                    flag_tb_matricula = 0;
                    matricular_usuario($(this).attr('id'));
                }
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
                //retirando required dos campos de senha:
                $('#_id_senha').attr('class', 'text-input');
                $('#_id_senha2').attr('class', 'validate[equals[senha]] text-input');
                if(_data[18] == 'Brasil'){                      
                    $("#endereco_estado").show();
                    $("#label_estado").show();
                }else{
                    $("#endereco_estado").hide();
                    $("#label_estado").hide();
                }
                
                var _HTML = $('#dialog_form').html();
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
                for(i = 0; i < nomeColunas.length; i++){
                    _HTML = _HTML.replace('_id_'+nomeColunas[i], nomeColunas[i]);
                    _HTML = _HTML.replace('_id_'+nomeColunas[i], nomeColunas[i]);
                    if(nomeColunas[i] == 'sexo'){
                        _HTML = _HTML.replace('_id_Masculino', 'Masculino');    
                        _HTML = _HTML.replace('_id_Feminino', 'Feminino');    
                    }
                }
                
                var id_imagem = "00";
                $.getJSON('ajax/verificaImagem.php',{id: _data[20], tipo: "usuario", ajax: 'true'}, function(j){       
                    if(j == '1'){
                        id_imagem = _data[20];
                    }
                });
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
                    width:800, 
                    height:600, 
                    modal: true,                       
                    close: function(event,ui){                
                        var form = $(this).find('#cadastro');
                        //deselecionando combos
                        $('#'+_data[1]).removeAttr('selected');//atuacao                                 
                        $('#'+_data[2]).removeAttr('selected');//permissao
                        $('#'+_data[19]).removeAttr('selected');//estado                        
                        $('#_id_'+_data[9]).removeAttr('checked');//sexo
                        //readcionando required nos campos senha
                        $('#_id_senha').attr('class', 'validate[required] text-input');
                        $('#_id_senha2').attr('class', 'validate[required,equals[senha]] text-input');
                        
                        form.validationEngine("detach");                        
                        dialog.dialog('destroy');
                        dialog.remove();
                    },
                    open: function(event, ui) { 
                        //Habilita a validação automática no formulário de cadastro
                        var form = $(this).find('#cadastro');
                        $(this).find('#img_usuario').src = "img/profile/"+_data[20]+".jpg?" + new Date().getTime();
                        $('#button_cadastrar').hide();
                        $('#button_atualizar').show();
                        form.validationEngine('attach', {scroll: true});
                        //console.log(form.html());
                        form.attr('action', 'ajax/crud_usuario.php?acao=atualizar');
                        form.live('submit',function(){//adicionar esse evento
                            if(form.validationEngine('validate')){                                
                                form.ajaxSubmit({
                                    dataType:'json',
                                    success:function(json){
                                        if(json != false){
                                            updateDataTables(form);
                                            dialog.dialog('close');                                        
                                        }                                                                        
                                    }
                                })                                
                            }
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
            
            dialog2 = $(_HTML2).dialog({width:900,height:600, modal:true,
                close: function(event,ui){                
                    var form = $(this).find('#cadastro2');
                    form.validationEngine("detach");                         
                    dialog2.dialog('destroy');
                    dialog2.remove();
                },
                open: function(event, ui) { 
                    //Habilita a validação automática no formulário de cadastro
                    var form = $(this).find('#cadastro2');
                    form.validationEngine();   
                    $('#button_cadastrar').show();
                    $('#button_atualizar').hide(); 
                    //console.log(form.html());
                    form.live('submit',function(){//adicionar esse evento                                                        
                        if($(this).validationEngine('validate')){ 
                            dataType: 'json',
                            $(this).ajaxSubmit({
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
                            //Chamada do AJAX            
                        }
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
                
                _HTML = _HTML.replace('#ATUACAO#', _data[2]);
                _HTML = _HTML.replace('#SEXO#', _data[9]);
                _HTML = _HTML.replace('#PAPEL#', _data[1]);
                _HTML = _HTML.replace('#NOME_COMPLETO#', _data[0]);               
                _HTML = _HTML.replace('#DATA_NASCIMENTO#', _data[3]);                                
                _HTML = _HTML.replace('#DESCRICAO#', _data[8]);              
                _HTML = _HTML.replace('#CIDADE#', _data[17]);               
                _HTML = _HTML.replace('#EMAIL#', _data[12]);
                
                $(_HTML).dialog({width:800,height:600, modal:true});
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
        
        $('#btn_ger_matricula').live('click',function(){
            elem = $('tbody tr.row_selected');
            if (elem.length == 1) {                
                $('#dialog').load('index.php?a=gerenciar_matricula&c=ead&id='+elem.attr('id'), function(response, status, xhr) {
                        if (status == "error") {
                            alert('erro');
                            var msg = "Sorry but there was an error: ";
                            $("#error").html(msg + xhr.status + " " + xhr.statusText);
                        }else{                                                                                    
                            dialog = $('#dialog').dialog({width:800, height:600,dialogClass:'dialogstyle', modal:true,                        
                                close: function(event,ui){                     
                                    $(dialog).dialog('destroy');
                                    $(dialog).find('div').remove();
                                }                                        
                            });
                        }
                    });
            }
        
        });
        
        $('#btn_matricular_curso').live('click', function(){
            flag_tb_matricula = 1;            
        });
        
        function matricular_usuario(){
            $.getJSON('ajax/ajax-gerenciar_matricula.php', {id_usuario:elem.attr('id')}, function(j){
                if(j == 1){
                    alert('Matriculado com sucesso!');
                }
            });
        }
        
        function removerUsuario(id){
            id = id.substr(6,6);
    
            var r = confirm('Deseja realmente deletar esse usuario?');
            if(r==true){
                $.getJSON('ajax/removerUsuario.php?search=',{
                    id_usuario: id,       
                    ajax: 'true'
                }, function(j){
                    //usuario excluido         
                    if(j == 1){

                        $('#'+id).detach();

                    }else{
                        //usuario nao pode ser excluido devido à restrições de chave estrangeira
                        if(j == 3){
                            alert('Endereço não excluído!');                
                        }else{
                            alert('Usuário não pode ser excluído!');                                
                        }
                    }
                });            
            }
        }
      
        function zeraForm(){
            $('#nome_completo').val();            
        }                
              
        //Verifica se é o modo de edição
        if($("#i_editar").val() != "false"){
            $("#form_cadastro").show();
            $("#opcoes_cadastro").hide();
            $("#button_cadastrar").hide();
            $("#button_atualizar").show();
        }
        else{
            $("#id").val(-1);
            $("#form_cadastro").hide();
        }
        //Habilita a validação automática no formulário de edição
        $("#editar").validationEngine();
        //Captura o papel do usuário a ser editado e seta o combobox
        var papel = $("#i_papel");
        $("#id_papel").val(papel.val());
        //Captura a atuação do usuário a ser editado e seta o combobox
        var atuacao = $("#i_atuacao");
        $("#atuacao").val(atuacao.val());
        //Verifica se o país é Brasil, captura o estado do usuário a ser editado e seta o combobox
        var estado = $("#i_estado");                               
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
    
    //Altera a action do form e submete para atualização dos dados do usuário
    function atualizarCadastro(idusuario){
        $('#cadastro').attr({action: 'index.php?c=ead&a=atualizar_cadastro_admin&id='+idusuario});
        $('#cadastro').submit();
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
    
    function getId_usuario(){
        return $("#id_usuario").val();
    }
    
    //Se gestor estiver logado, seta o combo papel como estudante
    function setarCombo(){
        $("#id_papel").val(4);
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