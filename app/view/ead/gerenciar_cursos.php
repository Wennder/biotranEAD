<?php
$editar = "false";
if (isset($this->curso)) {
    $this->curso == null ? $editar = "false" : $editar = $this->curso->getId_curso();
    echo $this->curso->getId_curso();
}
?>

<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn_admin.php'; ?>
<?php require 'structure/content.php'; ?>
<script src="js/crudTabelaCurso.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="js/jquery-picklist.js" type="text/javascript"></script>
<script src="js/validarNomeCurso.js" type="text/javascript"></script>

<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css"/>

<style type="text/css" title="currentStyle">
    
    @import "http://code.jquery.com/ui/1.8.23/themes/base/jquery-ui.css";
    #div_update label {display:block;width:100%;padding:10px 0;}
    #form_gerenciar{
        padding: 50px;
        overflow: hidden;
        
    }
    
    .ui-dialog-titlebar{
        background-image: url('img/header_ead_background.png');
        background-repeat: repeat;
        height: 10px;
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
</style>

<script>
    $(document).ready(function(){
        $("#cadastro").validationEngine();
        $("#editar").validationEngine();
        
        
        
        $("#tabela_cursos").dataTable({
            "aoColumnDefs": [ 
               
                                
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
        
        //JS DO PICKLIST DO JAN
        $('#add').click(function(){
            $('#origem option:selected').each(function(){
                $('#destino').append('<option selected="selected" value="'+$(this).val()+'">'+$(this).text()+'</option>');
                $(this).remove();
            });
        });
	
        $('#remover').click(function(){
            $('#destino option:selected').each(function(){
                $('#origem').append('<option value="'+$(this).val()+'">'+$(this).text()+'</option>');
                $(this).remove();
            });
        });                
        //-----------fim js janquery picklist
    });
   
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
    
    function atualizarCadastro(idcurso){
        $('#cadastro').attr({action: 'index.php?c=ead&a=atualizar_curso&id='+idcurso});
        $('#cadastro').submit();
    }
    
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
<div>
<div id="form_cadastro" style="display: none;">
    <form id="cadastro" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_curso" enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Dados do Curso</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">*Nome: </label>
                    </td>
                    <td style="width: 600px;">
                        <input type="text" id="nome" name="nome" value="<?php echo ($this->curso == null ? '' : $this->curso->getNome()); ?>" class="validate[required, ajax[validarNomeCurso_ajax]] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Descrição: </label>
                    </td>
                    <td>
                        <textarea id="descricao" name="descricao" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"><?php echo ($this->curso == null ? '' : $this->curso->getDescricao()); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Tempo de duração: </label>
                    </td>
                    <td>
                        <input type="text" id="tempo" name="tempo" value="<?php echo ($this->curso == null ? '' : $this->curso->getTempo()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 40px" maxlength="3"/>
                        <label class="label_cadastro_legend">dia(s)</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Valor: </label>
                    </td>
                    <td>
                        <label class="label_cadastro_legend">R$</label>
                        <input type="text" id="valor" name="valor" value="<?php echo ($this->curso == null ? '' : $this->curso->getValor()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 80px" maxlength="7"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Gratuito: </label>
                    </td>
                    <td>
                        <input type="radio" name="gratuito" id="gratuitoSim" <?php echo ($this->curso == null ? '' : ($this->curso->getGratuito(1) == "1") ? "checked" : ""); ?> value="1" class="validate[required] radio" data-prompt-position="centerRight">
                        <label class="label_cadastro">Sim </label>
                        <input type="radio" name="gratuito" id="gratuitoNao" <?php echo ($this->curso == null ? 'checked' : ($this->curso->getGratuito(1) == "0") ? "checked" : ""); ?> value="0" class="validate[required] radio" data-prompt-position="centerRight">
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
                                <select size="5" multiple="multiple" id="origem">
                                    <?php
                                    if ($this->curso == null) {
                                        echo $this->optionsTP;
                                    } else {
                                        echo $this->optionsPD;
                                    }
                                    ?>                            
                                </select>
                            </div>
                            <div class="botoes">
                                <input type="button" id="add" value=" Adicionar" />
                                <input type="button" id="remover" value=" Remover" />
                            </div>
                            <div class="destino">
                                <select id="destino" name="destino[]" multiple="multiple" class="validate[required] text-input" data-prompt-position="centerRight">
                                    <?php
                                        if($this->curso != null){
                                            echo $this->optionsPC;
                                        }
                                    ?>
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
                                        <img src="img/cursos/<?php
                                    if ($this->curso == null) {
                                        echo '00.jpg';
                                    } else if (file_exists('img/cursos/' . $this->curso->getId_curso() . '.jpg')) {
                                        echo $this->curso->getId_curso() . '.jpg';
                                    } else {
                                        echo '00.jpg';
                                    }
                                    ?>" alt="" height="180" width="240" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="file" name="imagem" id="imagem" class="text-input" data-prompt-position="centerRight"/>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        <input type="submit" id="button_cadastrar" name="button_cadastrar" value="Cadastrar" class="button"/>
        <input type="submit" id="button_atualizar" onclick="atualizarCadastro(<?php echo ($this->curso == null ? '' : $this->curso->getId_curso()); ?>)" name="button_atualizar" value="Atualizar" class="button" style="display: none;"/>
        <div id="div_hidden" style="display: none;">
            <input type="text" id="id" name="id" value="<?php echo $editar; ?>"/>
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

<?php require 'structure/footer.php'; ?>
