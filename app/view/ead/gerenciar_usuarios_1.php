<?php
$editar = "false";
if (isset($this->usuario)) {
    $this->usuario == null ? $editar = "false" : $editar = $this->usuario->getId_usuario();
} else {
    $this->usuario = null;
}
?>

<?php require 'structure/header_1.php'; ?>
<?php
$papel = $_SESSION["usuarioLogado"]->getId_papel();
switch ($papel) {
    case 1:
        require 'structure/leftcolumn_admin_1.php';
        break;
    case 2:
        require 'structure/leftcolumn_gestor.php';
        break;
}
?>
<?php require 'structure/content.php'; ?>
<!--<script src="js/jquery-1.8.0.min.js" type="text/javascript"></script>-->
<script src="js/validarCpf_passaporteCadastro.js" type="text/javascript"></script>
<script src="js/crudTabelaUsuario.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>

<!--<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>-->


<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css"/>
<style type="text/css" title="currentStyle">
    
    @import "http://code.jquery.com/ui/1.8.23/themes/base/jquery-ui.css";
    #div_update label {display:block;width:100%;padding:10px 0;}
    #form_gerenciar{
        padding: 50px;
        overflow: hidden;
        
    }
</style>



<script>
    
    var dialog, oTable, elem;
    
    
    
    function updateDataTables(_form){							//Adicionar essa função
        var form_fields = ['nome_completo','id_papel','atuacao','sexo','cpf_passaporte' , 'rg'];
        var fields_value = new Array();
        for (var i=0; i<form_fields.length; i++) {
            fields_value.push($(_form).find('input[name="'+form_fields[i]+'"]').val());
        }
        oTable.fnUpdate(fields_value, oTable.fnGetPosition(elem[0]));
    }
    
    $(document).ready(function(){
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
        
        oTable.$('tr').click(function(e){
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
            } else {
                oTable.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
        });
        
        
 
        
        $('#btn_edit').live('click',function(){
            elem = $('tr.row_selected');
            if (elem.length) {
                var _data = oTable.fnGetData(elem[0]);
                $('#button_cadastrar').hide();
                $('#button_atualizar').show();
                $('#'+_data[1]).attr('selected', 'selected');              
                _data[2] = _data[2].replace(/\ /g, '_');
                
                $('#'+_data[2]).attr('selected', 'selected');
                
                _data[19] = _data[19].replace(/\ /g,'_');
                
                $('#'+_data[19]).attr('selected', 'selected');
                var _HTML = $('#dialog_form').html();
            
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
                
                
                
                $(_HTML).dialog({width:800, height:600, modal: true});
                
            }
        });
        
        
        
        $('#btn_update').live('click',function(){			//adicionar esse evento
			
            //Chamada do AJAX

            updateDataTables($(this).parent());
            $(dialog).dialog('destroy');
        });
        
        $('#btn_add').click(function(){
            $('#button_cadastrar').show();
            $('#button_atualizar').hide();
            
            var _HTML = $('#dialog_form').html();
                
                _HTML = _HTML.replace('#NOME_COMPLETO#', '');
                _HTML = _HTML.replace('#CPF_PASSAPORTE#', '');
                _HTML = _HTML.replace('#RG#', '');
                _HTML = _HTML.replace('#DATA_NASCIMENTO#', '');
                _HTML = _HTML.replace('#TEL_PRINCIPAL#', '');
                _HTML = _HTML.replace('#TEL_SECUNDARIO#', '');
                _HTML = _HTML.replace('#ID_PROFISSIONAL#', '');
                _HTML = _HTML.replace('#DESCRICAO_PESSOAL#', '');
                _HTML = _HTML.replace('#RUA#', '');
                _HTML = _HTML.replace('#NUMERO#', '');
                _HTML = _HTML.replace('#COMPLEMENTO#', '');
                _HTML = _HTML.replace('#BAIRRO#', '');
                _HTML = _HTML.replace('#CIDADE#', '');
                _HTML = _HTML.replace('#PAIS#', '');
                _HTML = _HTML.replace('#EMAIL#', '');
            
            $(_HTML).dialog({width:800,height:600, modal:true});
        });
    
    
        $('#btn_view').click(function(){
            elem = $('tr.row_selected');
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
    
        $('btn_del').click(function(){
            var elem = $('tr.row_selected');
            if (elem.length) {
                
                
            }
        
        });
    
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

                        $('#tabela_linha'+id).detach();

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
      
        //Habilita a validação automática no formulário de cadastro
        $("#cadastro").validationEngine();
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
        if(paisBrasil()){
            $("#endereco_estado").val(estado.val());
        }
        else{
            $("#endereco_estado").hide();
        }
        //Instanciação e configuração da tabela
       
    });
   
    //Alterna entre a exibição do formulario de cadastro e a tabela de consulta
    function mostrar(opcao){
        if(opcao == "cadastro"){
            $("#form_cadastro").show();
            $("#form_gerenciar").hide();
        }
        else if(opcao == "gerenciar"){
            $("#form_cadastro").hide();
            $("#form_gerenciar").show();
        }
    }
    
    //Verifica se o e-mail informado pelo usuário já é cadastrado ou não
    function validaLogin_ajax(login_antigo){
        if($('#email').val() != login_antigo){
            $.getJSON('ajax/validarLoginCadastro.php?search=',{
                login: $('#email').val(),                         
                ajax: 'true'
            }, function(j){
                //usuario validado         
                if(j == 0){
                    alert('Este e-mail já está cadastrado.');                                
                    $('#email').val('');
                }
            });            
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

</script>

<!--<div id="opcoes_cadastro">
    <input type="button" value="Cadastro" class="button" onclick="mostrar('cadastro');"/>
    <input type="button" value="Gerência" class="button" onclick="mostrar('gerenciar');" style="margin-left: 10px;"/>
</div>-->

<div id="dialog_form">
    <div id="form_cadastro" style="display: none;">

        <form id="cadastro" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_usuario" enctype="multipart/form-data">
            <fieldset style="width: 100%;">
                <legend>Dados Pessoais</legend>
                <table>
                    <tr>
                        <td style="width: 150px;">
                            <label class="label_cadastro">*Nome completo: </label>
                        </td>
                        <td style="width: 500px;">
                            <input type="text" id="nome_completo" name="nome_completo" value="#NOME_COMPLETO#" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                        </td>
                    </tr>
                    <?php
                    if ($_SESSION["usuarioLogado"]->getId_papel() == '1') {
                        echo ('<tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">*Permissão: </label>
                            </td>
                            <td style="width: 500px;">
                                <select id="id_papel" name="id_papel" class="validate[required]" data-prompt-position="centerRight">
                                    <option></option>
                                    <option id="Administrador" value="1">Administrador</option>
                                    <option id="Gestor" value="2">Gestor</option>
                                    <option id="Professor" value="3">Professor</option>
                                    <option id="Estudante" value="4">Estudante</option>
                                </select>
                            </td>
                        </tr>');
                    }
                    ?>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Atuação: </label>
                        </td>
                        <td>
                            <select id="atuacao" name="atuacao" class="validate[required]" data-prompt-position="centerRight">
                                <option  value></option>
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
                            <input type="radio" name="sexo" id="Masculino" <?php echo ($this->usuario == null ? '' : ($this->usuario->getSexo() == "Masculino") ? "checked" : ""); ?> value="Masculino" class="validate[required] radio" data-prompt-position="centerRight">
                            <label class="label_cadastro">Masculino </label>
                            <input type="radio" name="sexo" id="Feminino" <?php echo ($this->usuario == null ? '' : ($this->usuario->getSexo() == "Feminino") ? "checked" : ""); ?> value="Feminino" class="validate[required] radio" data-prompt-position="centerRight">
                            <label class="label_cadastro">Feminino </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*CPF/Passaporte: </label>
                        </td>
                        <td>
                            <input type="text" id="cpf_passaporte" name="cpf_passaporte" value="#CPF_PASSAPORTE#" class="validate[required, custom[onlyNumberSp], ajax[validarCpf_cadastro_ajax]] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="14"/>
                            <label class="label_cadastro_legend">XXX.XXX.XXX-XX </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">RG: </label>
                        </td>
                        <td>
                            <input type="text" id="rg" name="rg" value="#RG#" class="text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="15"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Data de nascimento: </label>
                        </td>
                        <td>
                            <input type="text" id="data_nascimento" name="data_nascimento" value="#DATA_NASCIMENTO#" class="text-input" data-prompt-position="centerRight" onKeyUp='mascara_data(this)' onkeypress="return apenas_numero(event);" style="width: 115px" maxlength="10"/>
                            <label class="label_cadastro_legend">DD/MM/AAAA </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Telefone Principal: </label>
                        </td>
                        <td>
                            <input type="text" id="tel_principal" name="tel_principal" value="#TEL_PRINCIPAL#" class="text-input" data-prompt-position="centerRight" onkeypress="return apenas_numero(event);" style="width: 115px" maxlength="13"/>
                            <label class="label_cadastro_legend">(XX)XXXX-XXXX </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Telefone Secundário: </label>
                        </td>
                        <td>
                            <input type="text" id="tel_secundario" name="tel_secundario" value="#TEL_SECUNDARIO#" class="text-input" data-prompt-position="centerRight" onkeypress="return apenas_numero(event);" style="width: 115px" maxlength="13"/>
                        </td>
                    </tr>
                    <tr>                    
                        <td>
                            <label class="label_cadastro">Identidade Profissional: </label>
                        </td>
                        <td>
                            <input type="text" id="id_profissional" name="id_profissional" value="#ID_PROFISSIONAL#" class="text-input" data-prompt-position="centerRight" style="width: 150px" maxlength="15"/>
                            <label class="label_cadastro_legend"> </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Descrição Pessoal: </label>
                        </td>
                        <td>
                            <textarea id="descricao_pessoal" name="descricao_pessoal" rows="3" class="text-input" data-prompt-position="centerRight" maxlength="100">#DESCRICAO_PESSOAL#</textarea>
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
                                            <img src="img/profile/<?php
                    if ($this->usuario == null) {
                        echo '00.jpg';
                    } else if (file_exists('img/profile/' . $this->usuario->getId_usuario() . '.jpg')) {
                        echo $this->usuario->getId_usuario() . '.jpg';
                    } else {
                        echo '00.jpg';
                    }
                    ?>" alt="" height="120" width="100" />
                                        </div>
                                    </td>
                                    <td>
                                        <input type="file" name="foto" id="foto" class="text-input" data-prompt-position="centerRight" style="margin: 100px 0 0 10px;"/>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <fieldset style="width: 100%;">
                <table id="endereço">
                    <legend>Endereço</legend>
                    <tr>
                        <td style="width: 150px;">
                            <label class="label_cadastro">*Rua: </label>
                        </td>
                        <td style="width: 390px;">
                            <input type="text" id="endereco_rua" name="endereco_rua" value="#RUA#" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 390px"/>
                        </td>
                        <td style="width: 50px;">
                            <label class="label_cadastro">*Número: </label>
                        </td>
                        <td style="width: 60px;">
                            <input type="text" id="endereco_numero" name="endereco_numero" value="#NUMERO#" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 60px"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label class="label_cadastro">Complemento: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <input type="text" id="endereco_complemento" name="endereco_complemento" value="#COMPLEMENTO#" class="text-input" data-prompt-position="centerRight" style="width: 200px"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label class="label_cadastro">*Bairro: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <input type="text" id="endereco_bairro" name="endereco_bairro" value="#BAIRRO#" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label class="label_cadastro">*Cidade: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <input type="text" id="endereco_cidade" name="endereco_cidade" value="#CIDADE#" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label class="label_cadastro">*País: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <input type="text" id="endereco_pais" name="endereco_pais" value="#PAIS#" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px" onkeyup=""/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label id="label_estado" class="label_cadastro">*Estado: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <select id="endereco_estado" name="endereco_estado" class="validate[required]" data-prompt-position="centerRight">
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
                            <input type="text" id="email" name="email" value="#EMAIL#" class="validate[required, custom[email], ajax[validarLogin_ajax]] text-input" data-prompt-position="centerRight"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Senha: </label>
                        </td>
                        <td>
                            <input type="password" id="senha" name="senha" class="<?php echo ($editar == "true" ? "" : "validate[required] "); ?>text-input" data-prompt-position="centerRight" style="width: 150px"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Confirmar Senha: </label>
                        </td>
                        <td>
                            <input type="password" id="senha2" name="senha2" class="<?php echo ($editar == "true" ? "" : "validate[required] "); ?>validate[equals[senha]] text-input" data-prompt-position="centerRight" style="width: 150px"/>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <input type="submit" id="button_cadastrar" name="button_cadastrar" value="Cadastrar" class="button"/>
            <input type="button" id="button_atualizar" onclick="atualizarCadastro(<?php echo ($this->usuario == null ? '' : $this->usuario->getId_usuario()); ?>)" name="button_atualizar" value="Atualizar" class="button" style="display: none;"/>
            <div id="div_hidden" style="display: none;">
                <input type="text" id="id" name="id" value="<?php echo $editar; ?>"/>
            </div>
        </form>
        </br></br>
    </div>
</div>

<div id="form_gerenciar" style="">
    <input type="button" value="Adicionar usuario" id="btn_add" />
    <input type="button" value="Editar" id="btn_edit" />
    <input type="button" value="Remover" id="btn_del" />
    <input type="button" value="Ver" id="btn_view" />
    <?php
    if (!isset($this->tabela)) {
        $controllerUsuario = new controllerUsuario();
        $this->tabela = $controllerUsuario->tabelaUsuarios();
    }
    echo $this->tabela;
    ?>
</div>

<div id="div_hidden" style="display: none;">
    <input type="text" id="i_editar" name="i_editar" value="<?php echo $editar; ?>"/>
    <input type="text" id="i_papel" name="i_papel" value="<?php echo $this->usuario == null ? '' : $this->usuario->getId_papel(); ?>"/>
    <input type="text" id="i_atuacao" name="i_atuacao" value="<?php echo $this->usuario == null ? '' : $this->usuario->getAtuacao(); ?>"/>
    <input type="text" id="i_estado" name="i_estado" value="<?php echo $this->endereco == null ? '' : $this->endereco->getEstado(); ?>"/>    
</div>

<?php require 'profile.php'; ?>
<?php require 'structure/footer_1.php'; ?>
