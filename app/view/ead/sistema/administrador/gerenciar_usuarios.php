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


<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<script src="js/validarCpf_passaporteCadastro.js" type="text/javascript"></script>
<script src="js/crudTabelaUsuario.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="js/funcoes_gerenciar_usuarios.js" type="text/javascript"></script>

<link rel="stylesheet" href="css/jquery-ui-1.8.24.custom.css" type="text/css"/>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css"/>
<style type="text/css" title="currentStyle">

    @import "http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css";

</style>





<!--<div id="opcoes_cadastro">
    <input type="button" value="Cadastro" class="button" onclick="mostrar('cadastro');"/>
    <input type="button" value="Gerência" class="button" onclick="mostrar('gerenciar');" style="margin-left: 10px;"/>
</div>-->

<div id="dialog_form">
    <div id="form_cadastro" style="display: none; position: relative;">        
        <form id="_ID_FORM_" name="_ID_FORM_" class="form_cadastro" method="post" action="ajax/crud_usuario.php?acao=inserir" enctype="multipart/form-data">
            <fieldset style="width: 100%;">
                <legend>Dados Pessoais</legend>
                <table>
                    <tr>
                        <td style="width: 150px;">
                            <label class="label_cadastro">*Nome completo: </label>
                        </td>
                        <td style="width: 500px;">
                            <input type="text" id="_id_nome_completo" name="_id_nome_completo" value="#NOME_COMPLETO#" class="validate[required] text-input" data-prompt-position="topLeft" style="width: 500px"/>
                        </td>
                    </tr>
                    <?php
                    if ($_SESSION["usuarioLogado"]->getId_papel() == '1') {
                        echo ('<tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">*Permissão: </label>
                            </td>
                            <td style="width: 500px;">
                                <select id="_id_id_papel" name="_id_id_papel" class="validate[required]" data-prompt-position="centerRight">
                                    <option></option>                                    
                                    <option id="perm_Gestor" value="2">Gestor</option>
                                    <option id="perm_Professor" value="3">Professor</option>
                                    <option id="perm_Estudante" value="4">Estudante</option>
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
                            <select id="_id_atuacao" name="_id_atuacao" class="validate[required]" data-prompt-position="topLeft">
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
                            <input type="radio" name="_id_sexo" id="_id_Masculino" value="Masculino" class="validate[required] radio" data-prompt-position="centerRight">
                            <label class="label_cadastro">Masculino </label>
                            <input type="radio" name="_id_sexo" id="_id_Feminino" <?php echo ($this->usuario == null ? '' : ($this->usuario->getSexo() == "Feminino") ? "checked" : ""); ?> value="Feminino" class="validate[required] radio" data-prompt-position="topLeft">
                            <label class="label_cadastro">Feminino </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*CPF/Passaporte: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_cpf_passaporte" name="_id_cpf_passaporte" value="#CPF_PASSAPORTE#" class="validate[required, custom[onlyNumberSp], ajax[validarCpf_cadastro_ajax]] text-input" data-prompt-position="topLeft" style="width: 80px" maxlength="14"/>
                            <label class="label_cadastro_legend"> </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">RG: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_rg" name="_id_rg" value="#RG#" class="text-input" data-prompt-position="topLeft" style="width: 80px" maxlength="15"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Data de nascimento: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_data_nascimento" name="_id_data_nascimento" value="#DATA_NASCIMENTO#" class="text-input" data-prompt-position="topLeft" onKeyUp='mascara_data(this)' onkeypress="return apenas_numero(event);" style="width: 80px" maxlength="10"/>
                            <label class="label_cadastro_legend">DD/MM/AAAA </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Telefone Principal: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_tel_principal" name="_id_tel_principal" value="#TEL_PRINCIPAL#" class="text-input" data-prompt-position="topLeft" onkeypress="return apenas_numero(event);" style="width: 80px" maxlength="13"/>
                            <label class="label_cadastro_legend">(XX)XXXX-XXXX </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Telefone Secundário: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_tel_secundario" name="_id_tel_secundario" value="#TEL_SECUNDARIO#" class="text-input" data-prompt-position="topLeft" onkeypress="return apenas_numero(event);" style="width: 80px" maxlength="13"/>
                        </td>
                    </tr>
                    <tr>                    
                        <td>
                            <label class="label_cadastro">Identidade Profissional: </label>
                        </td>
                        <td>
                            <input type="text" id="_id_id_profissional" name="_id_id_profissional" value="#ID_PROFISSIONAL#" class="text-input" data-prompt-position="topLeft" style="width: 150px" maxlength="15"/>
                            <label class="label_cadastro_legend"> </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Descrição Pessoal: </label>
                        </td>
                        <td>
                            <textarea id="_id_descricao_pessoal" name="_id_descricao_pessoal" rows="3" class="text-input" data-prompt-position="topLeft" maxlength="100">#DESCRICAO_PESSOAL#</textarea>
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
                                            <img id="_id_img_usuario" onclick="preview()" src="img/profile/#ID_FOTO#.jpg" alt="" height="120" width="100" />
                                        </div>
                                    </td>
                                    <td>
                                        <input  type="file" name="_id_foto" id="_id_foto" class="text-input" data-prompt-position="topLeft" style="margin: 100px 0 0 10px;"/>
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
                            <input type="text" id="_id_endereco_rua" name="_id_endereco_rua" value="#RUA#" class="validate[required] text-input" data-prompt-position="topLeft" style="width: 390px"/>
                        </td>
                        <td style="width: 50px;">
                            <label class="label_cadastro">*Número: </label>
                        </td>
                        <td style="width: 60px;">
                            <input type="text" id="_id_endereco_numero" name="_id_endereco_numero" value="#NUMERO#" class="validate[required] text-input" data-prompt-position="topLeft" style="width: 60px"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label class="label_cadastro">Complemento: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <input type="text" id="_id_endereco_complemento" name="_id_endereco_complemento" value="#COMPLEMENTO#" class="text-input" data-prompt-position="topLeft" style="width: 200px"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label class="label_cadastro">*Bairro: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <input type="text" id="_id_endereco_bairro" name="_id_endereco_bairro" value="#BAIRRO#" class="validate[required] text-input" data-prompt-position="topLeft" style="width: 200px"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label class="label_cadastro">*Cidade: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <input type="text" id="_id_endereco_cidade" name="_id_endereco_cidade" value="#CIDADE#" class="validate[required] text-input" data-prompt-position="topLeft" style="width: 200px"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label class="label_cadastro">*País: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <input type="text" id="_id_endereco_pais" name="_id_endereco_pais" value="#PAIS#" class="validate[required] text-input" data-prompt-position="topLeft" style="width: 200px" onkeyup="paisBrasil()"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width: 150px;">
                            <label id="_id_label_estado" class="label_cadastro">*Estado: </label>
                        </td>
                        <td colspan="3" style="width: 500px;">
                            <select id="_id_endereco_estado" name="_id_endereco_estado" class="validate[required]" data-prompt-position="topLeft">
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
                            <input type="text" id="_id_email" name="_id_email" value="#EMAIL#" class="validate[required, custom[email], ajax[validarLogin_ajax]] text-input" data-prompt-position="topLeft"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Senha: </label>
                        </td>
                        <td>
                            <input type="password" id="_id_senha" name="_id_senha" class="validate[required] text-input" data-prompt-position="topLeft" style="width: 150px"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Confirmar Senha: </label>
                        </td>
                        <td>
                            <input type="password" id="_id_senha2" name="_id_senha2" class="validate[required,equals[senha]] text-input" data-prompt-position="topLeft" style="width: 150px"/>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <input type="submit" id="_b_button_cadastrar" name="_b_button_cadastrar" value="Cadastrar" class="button"/>
            <input type="button" id="_b_button_atualizar" name="_b_button_atualizar" value="Atualizar" class="button" style="display: none;"/>
            <div id="div_hidden" style="display: none;">
                <input type="text" id="id" name="id" value="#ID_USUARIO#"/>
            </div>
        </form>
        </br></br>
    </div>
</div>

<div id="form_gerenciar" style="">
    <input type="button" value="Adicionar usuario" id="btn_add" class="botao_gerencia_data_table" />
    <input type="button" value="Editar" id="btn_edit"  class="botao_gerencia_data_table"/>
    <input type="button" value="Remover" id="btn_del" class="botao_gerencia_data_table"/>
    <input type="button" value="Ver" id="btn_view" class="botao_gerencia_data_table"/>
    <input type="button" value="Gerenciar Matricula" id="btn_ger_matricula" class="botao_gerencia_data_table"/>
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

<?php require ROOT_PATH . '/app/view/ead/profile_dialog.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
