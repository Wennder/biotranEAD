<?php
$editar = "false";
if (isset($this->usuario)) {
    $this->usuario == null ? $editar = "false" : $editar = $this->usuario->getId_usuario();
} else {
    $this->usuario = null;
}
?>

<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php
$papel = $_SESSION["usuarioLogado"]->getId_papel();
switch ($papel) {
    case 1:
        require ROOT_PATH . '/app/view/ead/structure/leftcolumn_admin.php';
        break;
    case 2:
        require ROOT_PATH . '/app/view/ead/structure/leftcolumn_gestor.php';
        break;
}
?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>


<!--<script src="js/validarCpf_passaporteCadastro.js" type="text/javascript"></script>-->
<script src="js/crudTabelaUsuario.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/messages_pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.js" type="text/javascript"></script>
<link href='css/demo_table_jui.css' rel='stylesheet' type="text/css"/>

<script>
    var dialog, oTable, elem, nomeColunas = new Array();

    function updateDataTables(_form){//Adicionar essa função        
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
    }
    
    //    function preview(){
    //        alert($('#foto').value());
    //        $('#_id_img_usuario').attr('src', $('#foto').value());
    //        $('#_id_img_usuario').attr('width','100');
    //        $('#_id_img_usuario').attr('height','120');
    //    }
    
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
                { "sClass": "nome_usuario_datatable","aTargets":[0] }
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
                //retirando required dos campos de senha:
                //                $('#_id_senha').attr('class', 'text-input');
                //                $('#_id_senha2').attr('class', 'validate[equals[senha]] text-input');
                if(_data[18] == 'Brasil'){
                    $("#endereco_estado").show();
                    $("#label_estado").show();
                }else{
                    $("#endereco_estado").hide();
                    $("#label_estado").hide();
                }
                
                var _HTML = $('#dialog_form').html();
                
                
                var id_imagem = "00";
                $.getJSON('ajax/verificaImagem.php',{id: _data[20], tipo: "usuario", ajax: 'true'}, function(j){       
                    if(j == '1'){
                        id_imagem = _data[20];
                    }
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
                        show: { effect: 'drop', direction: "up"},
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
                show: { effect: 'drop', direction: "up"},
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
                $.getJSON('ajax/verificaImagem.php',{id: _data[20], tipo: "usuario", ajax: 'true'}, function(j){       
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
                        show: { effect: 'drop', direction: "up"},
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
    
        //        function removerUsuario(id){
        //            id = id.substr(6,6);
        //    
        //            var r = confirm('Deseja realmente deletar esse usuario?');
        //            if(r==true){
        //                $.getJSON('ajax/removerUsuario.php?search=',{
        //                    id_usuario: id,       
        //                    ajax: 'true'
        //                }, function(j){
        //                    //usuario excluido         
        //                    if(j == 1){
        //
        //                        $('#tabela_linha'+id).detach();
        //
        //                    }else{
        //                        //usuario nao pode ser excluido devido à restrições de chave estrangeira
        //                        if(j == 3){
        //                            alert('Endereço não excluído!');                
        //                        }else{
        //                            alert('Usuário não pode ser excluído!');                                
        //                        }
        //                    }
        //                });            
        //            }
        //        }
      
        //        function zeraForm(){
        //            $('#nome_completo').val();            
        //        }                

        //Captura o papel do usuário a ser editado e seta o combobox
        var papel = $("#i_papel");
        $("#id_papel").val(papel.val());
        //Captura a atuação do usuário a ser editado e seta o combobox
        var atuacao = $("#i_atuacao");
        $("#atuacao").val(atuacao.val());
        //Verifica se o país é Brasil, captura o estado do usuário a ser editado e seta o combobox
        var estado = $("#i_estado");
        if(paisBrasil()){
            $("#endereco_estado").val(estado.val());
        }
        else{
            $("#endereco_estado").hide();
        }
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
    //    function atualizarCadastro(idusuario){
    //        $('#cadastro').attr({action: 'index.php?c=ead&a=atualizar_cadastro_admin&id='+idusuario});
    //        $('#cadastro').submit();
    //    }
    
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

    //    $(document).ready(function (){
    //        $(".td_permissao").each(function(){
    //            $(this).attr({align:'center'});
    //        });
    //    })
    
    
</script>
<div id="dialog_form">
    <div id="form_cadastro" style="display: none; position: relative;">
        <form id="_ID_FORM_" name="_ID_FORM_" class="form_cadastro" method="post" action="ajax/crud_usuario.php?acao=inserir" enctype="multipart/form-data">
            <fieldset style="width: 100%;">
                <legend>Dados Pessoais</legend>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 150px;">
                            <label class="label_cadastro">*Nome completo: </label>
                        </td>
                        <td style="width: 500px;">
                            <input type="text" id="_id_nome_completo" name="_id_nome_completo" value="#NOME_COMPLETO#" style="width: 400px" class="text-input"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">
                            <label class="label_cadastro">*Permissão: </label>
                        </td>
                        <td style="width: 500px;">
                            <select id="_id_id_papel" name="_id_id_papel" style="width: auto;" <?php echo ($_SESSION["usuarioLogado"]->getId_papel() != '1' ? 'disabled="true"' : ''); ?> class="text-input">
                                <option value></option>
                                <option value="1">Administrador</option>
                                <option value="2">Gestor</option>
                                <option value="3">Professor</option>
                                <option value="4">Estudante</option>
                            </select>
                        </td>
                    </tr>
                    <?php
//                    if ($_SESSION["usuarioLogado"]->getId_papel() == '1') {
//                        echo ('<tr>
//                            <td style="width: 150px;">
//                                <label class="label_cadastro">*Permissão: </label>
//                            </td>
//                            <td style="width: 500px;">
//                                <select id="_id_id_papel" name="_id_id_papel" class="text-input" style="width: auto;">
//                                    <option></option>                                    
//                                    <option id="perm_Gestor" value="2">Gestor</option>
//                                    <option id="perm_Professor" value="3">Professor</option>
//                                    <option id="perm_Estudante" value="4">Estudante</option>
//                                </select>
//                            </td>
//                        </tr>');
//                    }
                    ?>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Atuação: </label>
                        </td>
                        <td>
                            <select id="_id_atuacao" name="_id_atuacao" class="text-input" style="width: auto;">
                                <option></option>
                                <option id="Agrônomo" value="Agrônomo">Agrônomo</option>
                                <option id="Estudante" value="Estudante">Estudante</option>
                                <option id="Produtor" value="Produtor">Produtor</option>
                                <option id="Técnico_nível_médio" value="Técnico nível médio">Técnico nível médio</option>
                                <option id="Veterinário" value="Veterinário">Veterinário</option>
                                <option id="Zootecnista" value="Zootecnista">Zootecnista</option>
                                <option id="Outros" value="Outros">Outros</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Sexo: </label>
                        </td>
                        <td>
                            <input type="radio" name="_id_sexo" id="_id_Masculino" value="Masculino" checked>
                            <label class="label_cadastro">Masculino </label>
                            <input type="radio" name="_id_sexo" id="_id_Feminino" value="Feminino">
                            <label class="label_cadastro">Feminino </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*CPF/Passaporte: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_cpf_passaporte" name="_id_cpf_passaporte" value="#CPF_PASSAPORTE#" style="width: 100px" maxlength="14" class="text-input"/>
                            <label class="label_cadastro_legend"> </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">RG: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_rg" name="_id_rg" value="#RG#" style="width: 100px" maxlength="15" class="text-input"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Data de nascimento: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_data_nascimento" name="_id_data_nascimento" value="#DATA_NASCIMENTO#" onKeyUp='mascara_data(this)' onkeypress="return apenas_numero(event);" style="width: 90px" maxlength="10" class="text-input"/>
                            <label class="label_cadastro_legend">DD/MM/AAAA </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Telefone Principal: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_tel_principal" name="_id_tel_principal" value="#TEL_PRINCIPAL#" onkeypress="return apenas_numero(event);" style="width: 80px" maxlength="13" class="text-input"/>
                            <label class="label_cadastro_legend">Somente números </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Telefone Secundário: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_tel_secundario" name="_id_tel_secundario" value="#TEL_SECUNDARIO#" onkeypress="return apenas_numero(event);" style="width: 80px" maxlength="13" class="text-input"/>
                        </td>
                    </tr>
                    <tr>                    
                        <td>
                            <label class="label_cadastro">Identidade Profissional: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_id_profissional" name="_id_id_profissional" value="#ID_PROFISSIONAL#" style="width: 150px" maxlength="15" class="text-input"/>
                            <label class="label_cadastro_legend"> </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Descrição Pessoal: </label>
                        </td>
                        <td>
                            <textarea id="_id_descricao_pessoal" name="_id_descricao_pessoal" rows="3" cols="50" maxlength="100" class="text-area">#DESCRICAO_PESSOAL#</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Foto (100x120): </label>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <div id="foto_usuario">
                                            <img id="_id_img_usuario" src="img/profile/#ID_FOTO#.jpg" alt="" height="120" width="100"/>
                                        </div>
                                    </td>
                                    <td>
                                        <table style="margin: 50px 0 0 0;">
                                            <tr><td><label class="error" for="foto" generated="true" style="display: none; position: relative;">Os formatos de foto aceitos são somente .jpg e .jpeg.</label></td></tr>
                                            <tr><td><input type="file" name="_id_foto" id="_id_foto" style="margin: 0 0 0 5px;"/></td></tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <fieldset style="width: 100%;">
                <table id="endereço" style="width: 100%;">
                    <legend>Endereço</legend>
                    <tr>
                        <td style="width: 150px;">
                            <label class="label_cadastro">*Rua: </label>
                        </td>
                        <td style="width: 500px;">
                            <input type="text" id="_id_endereco_rua" name="_id_endereco_rua" value="#RUA#" style="width: 390px" class="text-input"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">
                            <label class="label_cadastro">*Número: </label>
                        </td>
                        <td style="width: 500px;">
                            <input type="text" id="_id_endereco_numero" name="_id_endereco_numero" value="#NUMERO#" style="width: 60px" class="text-input"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label class="label_cadastro">Complemento: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <input type="text" id="_id_endereco_complemento" name="_id_endereco_complemento" value="#COMPLEMENTO#" style="width: 200px" class="text-input"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label class="label_cadastro">*Bairro: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <input type="text" id="_id_endereco_bairro" name="_id_endereco_bairro" value="#BAIRRO#" style="width: 200px" class="text-input"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label class="label_cadastro">*Cidade: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <input type="text" id="_id_endereco_cidade" name="_id_endereco_cidade" value="#CIDADE#" style="width: 200px" class="text-input"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label class="label_cadastro">*País: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <input type="text" id="_id_endereco_pais" name="_id_endereco_pais" value="#PAIS#" style="width: 200px" onkeyup="paisBrasil()" class="text-input"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label id="_id_label_estado" class="label_cadastro">*Estado: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <select id="_id_endereco_estado" name="_id_endereco_estado" class="text-input" style="width: auto;">
                                <option></option >
                                <option id="Acre" value="Acre">Acre</option >
                                <option id="Alagoas" value="Alagoas">Alagoas</option >
                                <option id="Amapá" value="Amapá">Amapá</option >
                                <option id="Amazonas" value="Amazonas">Amazonas</option >
                                <option id="Bahia" value="Bahia">Bahia</option >
                                <option id="Ceará" value="Ceará">Ceará</option >
                                <option id="Distrito_Federal" value="Distrito Federal">Distrito Federal</option >
                                <option id="Espirito_Santo" value="Espirito Santo">Espirito Santo</option >
                                <option id="Goiás" value="Goiás">Goiás</option >
                                <option id="Maranhão" value="Maranhão">Maranhão</option >
                                <option id="Mato_Grosso" value="Mato Grosso">Mato Grosso</option >
                                <option id="Mato_Grosso_do_Sul" value="Mato Grosso do Sul">Mato Grosso do Sul</option >
                                <option id="Minas_Gerais" value="Minas Gerais">Minas Gerais</option >
                                <option id="Pará" value="Pará">Pará</option >
                                <option id="Paraiba" value="Paraiba">Paraiba</option >
                                <option id="Paraná" value="Paraná">Paraná</option >
                                <option id="Pernambuco" value="Pernambuco">Pernambuco</option >
                                <option id="Piauí" value="Piauí">Piauí</option >
                                <option id="Rio_de_Janeiro" value="Rio de Janeiro">Rio de Janeiro</option >
                                <option id="Rio_Grande_do_Norte" value="Rio Grande do Norte">Rio Grande do Norte</option >
                                <option id="Rio_Grande_do_Sul" value="Rio Grande do Sul">Rio Grande do Sul</option >
                                <option id="Rondônia" value="Rondônia">Rondônia</option >
                                <option id="Roraima" value="Roraima">Roraima</option >
                                <option id="Santa_Catarina" value="Santa Catarina">Santa Catarina</option >
                                <option id="São_Paulo" value="São Paulo">São Paulo</option >
                                <option id="Sergipe" value="Sergipe">Sergipe</option >
                                <option id="Tocantis" value="Tocantis">Tocantis</option >
                            </select>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <fieldset style="width: 100%;">
                <legend>Acesso</legend>
                <table>
                    <tr>
                        <td style="width: 150px;">
                            <label class="label_cadastro">*E-mail (login): </label>
                        </td>
                        <td style="width: 500px;">
                            <input type="text" id="_id_email" name="_id_email" value="#EMAIL#" class="text-input"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Senha: </label>
                        </td>
                        <td>
                            <input type="password" id="_id_senha" name="_id_senha" style="width: 150px" class="text-input"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Confirmar Senha: </label>
                        </td>
                        <td>
                            <input type="password" id="_id_senha2" name="_id_senha2" style="width: 150px" class="text-input"/>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <input type="submit" id="_b_button_cadastrar" name="_b_button_cadastrar" value="Cadastrar" class="button2"/>
            <input type="submit" id="_b_button_atualizar" name="_b_button_atualizar" value="Atualizar" class="button2" style="display: none;"/>
            <div id="div_hidden" style="display: none;">
                <input type="text" id="_id_id" name="_id_id" value="#ID_USUARIO#"/>
            </div>
        </form>
        </br>
    </div>
</div>

<div>
    <div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
        <center><h3 style="margin: 0;">Gerenciar Usuários</h3></center>
        <div id="index_admin">
            <div id="form_gerenciar">   
                <input type="button" value="" id="btn_add" class="classeBotaoAdicionar" style="margin: 0 0 5px 5px;"/> Adicionar
                <input type="button" value="" id="btn_edit"  class="classeBotaoEditar" style="margin: 0 0 5px 10px;"/> Editar
                <input type="button" value="" id="btn_del" class="classeBotaoExcluir" style="margin: 0 0 5px 10px;"/> Remover
                <input type="button" value="" id="btn_view" class="classeBotaoVisualizar" style="margin: 0 0 5px 10px;"/> Visualizar
                <br>
                <?php echo $this->tabela; ?>
            </div>
        </div>
    </div>
</div>


<div id="div_hidden" style="display: none;">
    <input type="text" id="i_editar" name="i_editar" value="<?php echo $editar; ?>"/>
    <input type="text" id="i_papel" name="i_papel" value="<?php echo $this->usuario == null ? '' : $this->usuario->getId_papel(); ?>"/>
    <input type="text" id="i_atuacao" name="i_atuacao" value="<?php echo $this->usuario == null ? '' : $this->usuario->getAtuacao(); ?>"/>
    <input type="text" id="i_estado" name="i_estado" value="<?php echo $this->endereco == null ? '' : $this->endereco->getEstado(); ?>"/>    
</div>

<?php require ROOT_PATH . '/app/view/ead/profile_dialog.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
