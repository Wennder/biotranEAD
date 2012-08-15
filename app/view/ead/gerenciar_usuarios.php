<?php
//$editar = "false";
$this->usuario == null ? $editar = "false" : $editar = "true";
?>

<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn.php'; ?>
<?php require 'structure/content.php'; ?>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>
    $(document).ready(function(){
        $("#cadastro").validationEngine();
        if($("#i_editar").val() == "true"){
            $("#form_cadastro").show();
        }
        else{
            $("#form_cadastro").hide();
        }
        var papel = $("#i_papel");
        $("#papel").val(papel.val());
        var atuacao = $("#i_atuacao");
        $("#atuacao").val(atuacao.val());
    });
   
    function mostrar(opcao){
        if(opcao == "cadastro"){
            $("#form_cadastro").show();
            $("#form_editar").hide();
        }
        else if(opcao == "editar"){
            $("#form_cadastro").hide();
            $("#form_editar").show();
        }
    }

</script>

<div id="opcoes_cadastro">
    <input type="button" value="Cadastrar" onclick="mostrar('cadastro');"/>
    <input type="button" value="Editar/Remover" onclick="mostrar('editar');"/>
</div>

<div id="form_cadastro" style="display: none;">
    <form id="cadastro" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_usuario">
        <fieldset style="width: 650px;">
            <legend>Dados Pessoais</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Nome completo: </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="nome_completo" name="nome_completo" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getNome_completo()); ?>" class="validate[required, custom[onlyLetterSp]] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Permissão: </label>
                    </td>
                    <td style="width: 500px;">
                        <select id="id_papel" name="id_papel" class="validate[required]" data-prompt-position="centerRight">
                            <option value></option>
                            <option value="1">Administrador</option>
                            <option value="2">Estudante</option>
                            <option value="3">Gestor</option>
                            <option value="4">Professor</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Data de nascimento: </label>
                    </td>
                    <td>
                        <input type="text" id="data_nascimento" name="data_nascimento" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getData_nascimento()); ?>" class="validate[required, custom[date]] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="10"/>
                        <label class="label_cadastro_legend">DD/MM/AAAA </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">CPF: </label>
                    </td>
                    <td>
                        <input type="text" id="cpf" name="cpf" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getCpf()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="14"/>
                        <label class="label_cadastro_legend">XXX.XXX.XXX-XX </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">RG: </label>
                    </td>
                    <td>
                        <input type="text" id="rg" name="rg" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getRg()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="12"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Atuação: </label>
                    </td>
                    <td>
                        <select id="atuacao" name="atuacao" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getAtuacao()); ?>" class="validate[required]" data-prompt-position="centerRight">
                            <option value></option>
                            <option value="Agronomo">Agrônomo</option>
                            <option value="Estudante">Estudante</option>
                            <option value="Produtor">Produtor</option>
                            <option value="Tecnico_nm">Técnico nível médio</option>
                            <option value="Veterinario">Veterinário</option>
                            <option value="Zootecnista">Zootecnista</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Identidade Profissional: </label>
                    </td>
                    <td>
                        <input type="text" id="id_profissional" name="id_profissional" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getId_profissional()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 150px"/>
                        <label class="label_cadastro_legend"> </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Sexo: </label>
                    </td>
                    <td>
                        <input type="radio" name="group0" id="sexoM" <?php echo ($this->usuario == null ? '' : ($this->usuario->getSexo() == "M") ? "checked" : ""); ?> value="M" class="validate[required] radio" data-prompt-position="centerRight">
                        <label class="label_cadastro">Masculino </label>
                        <input type="radio" name="group0" id="sexoF" <?php echo ($this->usuario == null ? '' : ($this->usuario->getSexo() == "F") ? "checked" : ""); ?> value="F" class="validate[required] radio" data-prompt-position="centerRight">
                        <label class="label_cadastro">Feminino </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Telefone Residencial: </label>
                    </td>
                    <td>
                        <input type="text" id="tel_residencial" name="tel_residencial" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getTel_residencial()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="13"/>
                        <label class="label_cadastro_legend">(XX)XXXX-XXXX </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Telefone Comercial: </label>
                    </td>
                    <td>
                        <input type="text" id="tel_comercial" name="tel_comercial" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getTel_comercial()); ?>" class="text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="13"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Celular 1: </label>
                    </td>
                    <td>
                        <input type="text" id="tel_celular1" name="tel_celular1" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getTel_celular1()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="13"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Celular 2: </label>
                    </td>
                    <td>
                        <input type="text" id="tel_celular2" name="tel_celular2" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getTel_celular2()); ?>" class="text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="13"/>
                    </td>
                </tr>            
                <tr>
                    <td>
                        <label class="label_cadastro">Descrição Pessoal: </label>
                    </td>
                    <td>
                        <textarea id="descricao_pessoal" name="descricao_pessoal" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"><?php echo ($this->usuario == null ? '' : $this->usuario->getDescricao_pessoal()); ?></textarea>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        <fieldset style="width: 650px;">
            <table id="endereço1">
                <legend>Endereço Residencial</legend>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Rua: </label>
                    </td>
                    <td style="width: 390px;">
                        <input type="text" id="rua1" name="rua1" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 390px"/>
                    </td>
                    <td style="width: 50px;">
                        <label class="label_cadastro">Número: </label>
                    </td>
                    <td style="width: 60px;">
                        <input type="text" id="num1" name="num1" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 60px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">Complemento: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="complemento1" name="complemento1" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">Bairro: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="bairro1" name="bairro1" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">Cidade: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="cidade1" name="cidade1" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        <fieldset style="width: 650px;">
            <legend>Endereço Comercial</legend>
            <table id="endereço2">
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Rua: </label>
                    </td>
                    <td style="width: 390px;">
                        <input type="text" id="rua2" name="rua2" class="text-input" data-prompt-position="centerRight" style="width: 390px"/>
                    </td>
                    <td style="width: 50px;">
                        <label class="label_cadastro">Número: </label>
                    </td>
                    <td style="width: 60px;">
                        <input type="text" id="num2" name="num2" class="text-input" data-prompt-position="centerRight" style="width: 60px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <label class="label_cadastro">Complemento: </label>
                    </td>
                    <td colspan="3">
                        <input type="text" id="complemento2" name="complemento2" class="text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <label class="label_cadastro">Bairro: </label>
                    </td>
                    <td colspan="3">
                        <input type="text" id="bairro2" name="bairro2" class="text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <label class="label_cadastro">Cidade: </label>
                    </td>
                    <td colspan="3">
                        <input type="text" id="cidade2" name="cidade2" class="text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        <fieldset style="width: 650px;">
            <legend>Acesso</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">E-mail (login): </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="email" name="email" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getEmail()); ?>" class="validate[required, custom[email]] text-input" data-prompt-position="centerRight"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Senha: </label>
                    </td>
                    <td>
                        <input type="password" id="senha" name="senha" class="<?php echo ($editar == "true" ? "" : "validate[required] "); ?>text-input" data-prompt-position="centerRight" style="width: 150px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Confirmar Senha: </label>
                    </td>
                    <td>
                        <input type="password" id="senha2" name="senha2" class="<?php echo ($editar == "true" ? "" : "validate[required] "); ?>validate[equals[senha]] text-input" data-prompt-position="centerRight" style="width: 150px"/>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        <input type="submit" id="button_cadastrar" name="button_cadastrar" value="Cadastrar"/>
    </form>
    </br></br>
</div>

<div id="form_edicao" style="display: none;">
    <form id="editar" class="form_editar" method="post">
        <table>
            <tr>
                <td>
                    <?php echo ($this->usuarios[0]->getNome_completo()); ?>
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="div_hidden" style="display: none;">
    <input type="text" id="i_editar" name="i_editar" value="<?php echo $editar; ?>"/>
    <input type="text" id="i_papel" name="i_papel" value="<?php echo $this->usuario == null ? '' : $this->usuario->getId_papel(); ?>"/>
    <input type="text" id="i_atuacao" name="i_atuacao" value="<?php echo $this->usuario == null ? '' : $this->usuario->getAtuacao(); ?>"/>
</div>

<?php require 'structure/footer.php'; ?>
