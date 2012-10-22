<?php
$editar = "false";
if (isset($this->curso)) {
    $this->curso == null ? $editar = "false" : $editar = $this->curso->getId_curso();
    echo $this->curso->getId_curso();
}
?>

<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn_admin.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<script src="js/crudTabelaCurso.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="js/jquery-picklist.js" type="text/javascript"></script>
<script src="js/validarNomeCurso.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery-ui-1.8.24.custom.css" type="text/css"/>

<style type="text/css" title="currentStyle">
    @import "http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css";

    #div_update label {display:block;width:100%;padding:10px 0;}
    #form_gerenciar{
        padding: 50px;
        overflow: hidden;

    }

    .botao_gerencia_data_table{
        padding: 7px 7px;
        color: #444444;
        background-color: #eeeeee;
        border:1px solid #999999;
        font-weight: 600;
        border-radius: 5px;
    }

    .botao_gerencia_data_table:hover{
        cursor:pointer;
        border:1px solid #111111;
    }
    
    .ui-dialog-titlebar{
        background-image: url('img/header_ead_background.png');
        background-repeat: repeat;
        height: 10px;
    }
</style>

<script>
    
    var dialog, oTable, elem, nomeColunas = new Array();
            
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
                { "bSearchable": false, "bVisible": false, "aTargets": [ 5 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 6 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 7 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 8 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 9 ], "sTitle":"rendering" },
                { "bSearchable": false, "bVisible": false, "aTargets": [ 10 ], "sTitle":"rendering" },                
            ],
            "bJQueryUI":true,
            "bPaginate": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bLengthMenu": true,
            "sPaginationType": "full_numbers",
            "oLanguage": {
                "sLengthMenu": "Mostrar _MENU_ usuário(s)",
                "sZeroRecords": "Nada encontrado",
                "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 usuário(s)",
                "sInfo": "Mostrando _START_ até _END_ de _TOTAL_ usuário(s)",
                "sSearch": "Pesquisar"
            }
            
        });
        
        $('#tabela_cursos tr').live('click',function(e){
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
                if(_data[2] == 'Sim'){
                    $('#_id_gratuitoSim').attr('checked', 'true');//sexo                    
                }else{
                    $('#_id_gratuitoNao').attr('checked', 'true');//sexo                    
                }
                
                var _HTML = $('#dialog_form').html();                                
                //preparando picklist do curso:                
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
                    //--
                    //alterando valores
                    _HTML = _HTML.replace('#NOME#', _data[0]);
                    _HTML = _HTML.replace('#TEMPO#', _data[1]);                
                    _HTML = _HTML.replace('#VALOR#', _data[3]);
                    _HTML = _HTML.replace('#DESCRICAO#', _data[5]);
                    _HTML = _HTML.replace('#ID_CURSO#', _data[10]);
                    _HTML = _HTML.replace('#ID_FOTO#', _data[10]);
                    //--gerando dialog
                    dialog = $(_HTML).dialog({
                        width:800, 
                        height:600, 
                        modal: true,
                        zIndex: 3999,
                        //                        dialogClass:'dialogstyle',
                        close: function(event,ui){                
                            var form = $(this).find('#cadastro');
                            //des-preselecionando combos e radio inputs: 
                            if(_data[2] == 1){
                                $('#_id_gratuitoSim').removeAttr('checked');//sexo                    
                            }else{
                                $('#_id_gratuitoNao').removeAttr('checked');//sexo                    
                            }
                            form.validationEngine("detach");                        
                            dialog.dialog('destroy');
                            dialog.remove();
                        },
                        open: function(event, ui) { 
                            //Habilita a validação automática no formulário de cadastro
                            var form = $(this).find('#cadastro');
                            $(this).find('#img_curso').src = "img/cursos/"+_data[10]+".jpg?" + new Date().getTime();
                            $('#button_cadastrar').hide();
                            $('#button_atualizar').show();       
                            form.validationEngine('attach', {scroll: false});                                                
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
                                if(form.validationEngine('validate')){                                       
                                    form.ajaxSubmit({
                                        dataType: 'json',
                                        success:function (json){
                                            if(json != false){
                                                updateDataTables(form, _data);
                                                dialog.dialog('close');                                        
                                            }                                                                        
                                        }
                                    });                                              
                                }
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
                        width:800, 
                        height:600, 
                        modal: true,   
                        dialogClass:'dialogstyle',
                        close: function(event,ui){                                           
                            var form = $(this).find('#cadastro');
                            form.validationEngine("detach");                        
                            dialog.dialog('destroy');
                            dialog.remove();
                        },
                        open: function(event, ui) { 
                            //Habilita a validação automática no formulário de cadastro
                            var form = $(this).find('#cadastro');
                            form.validationEngine('attach', {scroll: false});
                            $('#button_cadastrar').show();
                            $('#button_atualizar').hide(); 
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
                            form.attr('action', 'ajax/crud_curso.php?acao=inserir&getCurso=1')
                            form.live('submit',function(){//adicionar esse evento
                                if(form.validationEngine('validate')){                                
                                    form.ajaxSubmit({
                                        dataType: 'json',
                                        success: function(json){
                                            if(json != false){ 
                                                //                                        form.find('#id').val(json.id);
                                                insertDataTables(form, json);
                                                dialog.dialog('close');                                        
                                            }  
                                        }
                                    });
                                    //                                    $.post('ajax/crud_curso.php?acao=inserir&getCurso=1', form.serialize(), function(json) {
                                    //                                        // handle response
                                    //                                        var data = new Array();
                                    //                                        if(json != false){ 
                                    //                                            //                                        form.find('#id').val(json.id);
                                    //                                            insertDataTables(form, json);
                                    //                                            dialog.dialog('close');                                        
                                    //                                        }                                                                        
                                    //                                    }, "json");
                                    //Chamada do AJAX            
                                }
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
        
        $('#btn_view').live('click', function(){
            alert('Em construção!');
        })
    });       
        
    
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
            
    function apenas_numero(e){
        var tecla=(window.event)?event.keyCode:e.which;   
        if((tecla>47 && tecla<58)) return true;
        else{
            if (tecla==8 || tecla==0) return true;
            else  return false;
        }
    }        

</script>
<style>
    .origem, .destino {
        float:left;
        display:inline; 
    }
    .botoes{
        float:left;
        display:inline;         
    }

    #destino {
        display:block;
        width:100px;
    }
</style>

<!--<div id="opcoes_cadastro">
    <input type="button" value="Cadastro" class="button" onclick="mostrar('cadastro');"/>
    <input type="button" value="Gerência" class="button" onclick="mostrar('gerenciar');" style="margin-left: 10px;"/>
</div>-->
<div id="dialog_form">
    <div id="form_cadastro" style="display: none;">
        <form id="_id_cadastro" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_curso" enctype="multipart/form-data">
            <fieldset style="width: 100%;">
                <legend>Dados do Curso</legend>
                <table>
                    <tr>
                        <td style="width: 150px;">
                            <label class="label_cadastro">*Nome: </label>
                        </td>
                        <td style="width: 600px;">
                            <input type="text" id="_id_nome" name="_id_nome" value="#NOME#" class="validate[required, ajax[validarNomeCurso_ajax]] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Descrição: </label>
                        </td>
                        <td>
                            <textarea id="_id_descricao" name="_id_descricao" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100">#DESCRICAO#</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Tempo de duração: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_tempo" name="_id_tempo" value="#TEMPO#" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 40px" maxlength="3"/>
                            <label class="label_cadastro_legend">dia(s)</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Valor: </label>
                        </td>
                        <td>
                            <label class="label_cadastro_legend">R$</label>
                            <input type="text" id="_id_valor" name="_id_valor" value="#VALOR#" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 80px" maxlength="7"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Gratuito: </label>
                        </td>
                        <td>
                            <input type="radio" name="gratuito" id="_id_gratuitoSim" value="1" class="validate[required] radio" data-prompt-position="centerRight">
                            <label class="label_cadastro">Sim </label>
                            <input type="radio" name="gratuito" id="_id_gratuitoNao" value="0" class="validate[required] radio" data-prompt-position="centerRight">
                            <label class="label_cadastro">Não </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Professores do curso: </label>
                        </td>
                        <td>
                            <div class="container">
                                <div class="origem">
                                    <select size="5" multiple="multiple" id="_id_origem">   
                                        #OPTIONS_TODOS_PROFESSORES#
                                    </select>
                                </div>
                                <div class="botoes">
                                    <input type="button" id="_id_add" value=" Adicionar" />
                                    <input type="button" id="_id_remover" value=" Remover" />
                                </div>
                                <div class="destino">
                                    <select id="_id_destino" name="destino[]" multiple="multiple" class="validate[required] text-input" data-prompt-position="centerRight">                                    
                                        #OPTIONS_PROFESSORES_RESPONSAVEIS#
                                    </select>                                
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Imagem (240x180): </label>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <div id="imagem_curso">
                                            <img id="_id_img_curso" src="img/cursos/#ID_FOTO#.jpg" alt="" height="180" width="240" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="file" name="_id_imagem" id="_id_imagem" class="text-input" data-prompt-position="centerRight"/>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <input type="submit" id="_b_button_cadastrar" name="_b_button_cadastrar" value="Cadastrar" class="button"/>
            <input type="submit" id="_b_button_atualizar"  name="_b_button_atualizar" value="Atualizar" class="button" style="display: none;"/>
            <div id="div_hidden" style="display: none;">
                <input type="text" id="id" name="id" value="#ID_CURSO#"/>
            </div>
        </form>
        </br></br>
    </div>
</div>

<div id="form_gerenciar" style="">
    <input type="button" value="Adicionar curso" id="btn_add" class="botao_gerencia_data_table" />
    <input type="button" value="Editar" id="btn_edit"  class="botao_gerencia_data_table"/>
    <input type="button" value="Remover" id="btn_del" class="botao_gerencia_data_table"/>
    <input type="button" value="Ver" id="btn_view" class="botao_gerencia_data_table"/>
    <?php
    if (!isset($this->tabela)) {
        $controllerCurso = new controllerCurso();
        $this->tabela = $controllerCurso->tabelaCursos();
    }
    echo $this->tabela;
    ?>
</div>

<div id="div_hidden" style="display: none;">
    <input type="text" id="i_editar" name="i_editar" value="<?php echo $editar; ?>"/>
    <input type="text" id="i_professores" name="i_professores" value="<?php echo $this->professores; ?>"/>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
