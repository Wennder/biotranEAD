<?php
    $editar = "false";
    if (isset($this->usuario)) {
        $this->usuario == null ? $editar = "false" : $editar = "true";
    }
?>

<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn.php'; ?>
<?php require 'structure/content.php'; ?>
<script src="js/crudTabelaUsuario.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css"/>

<script>
    $(document).ready(function(){
        $("#cadastro").validationEngine();
        if($("#i_editar").val() == "true"){
            $("#form_cadastro").show();
            $("#opcoes_cadastro").hide();
            $("#button_cadastrar").hide();
            $("#button_atualizar").show();
        }
        else{
            $("#form_cadastro").hide();
        }
        $("#editar").validationEngine();
        var papel = $("#i_papel");
        $("#id_papel").val(papel.val());
        var atuacao = $("#i_atuacao");
        $("#atuacao").val(atuacao.val());
        $("#tabela_usuarios").dataTable({
            "bPaginate": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bLengthMenu": false,
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
    
    

</script>

<div id="opcoes_cadastro">
    <input type="button" value="Cadastro" class="button" onclick="mostrar('cadastro');"/>
    <input type="button" value="Gerência" class="button" onclick="mostrar('gerenciar');" style="margin-left: 10px;"/>
</div>

<div id="form_cadastro" style="display: none;">
    <form id="cadastro" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_usuario">
        <fieldset style="width: 100%;">
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
                            <option value="Agrônomo">Agrônomo</option>
                            <option value="Estudante">Estudante</option>
                            <option value="Produtor">Produtor</option>
                            <option value="Técnico nível médio">Técnico nível médio</option>
                            <option value="Veterinário">Veterinário</option>
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
                        <input type="radio" name="sexo" id="sexoM" <?php echo ($this->usuario == null ? '' : ($this->usuario->getSexo() == "M") ? "checked" : ""); ?> value="M" class="validate[required] radio" data-prompt-position="centerRight">
                        <label class="label_cadastro">Masculino </label>
                        <input type="radio" name="sexo" id="sexoF" <?php echo ($this->usuario == null ? '' : ($this->usuario->getSexo() == "F") ? "checked" : ""); ?> value="F" class="validate[required] radio" data-prompt-position="centerRight">
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
                                                if($this->usuario == null){
                                                    echo '00.jpg'; 
                                                }
                                                else if(file_exists('img/profile/'.$this->usuario->getId_usuario().'.jpg')){
                                                    echo $this->usuario->getId_usuario().'.jpg';
                                                }else{
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
            <table id="endereço1">
                <legend>Endereço Residencial</legend>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Rua: </label>
                    </td>
                    <td style="width: 390px;">
                        <input type="text" id="rua_residencial" name="rua_residencial" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 390px"/>
                    </td>
                    <td style="width: 50px;">
                        <label class="label_cadastro">Número: </label>
                    </td>
                    <td style="width: 60px;">
                        <input type="text" id="numero_residencial" name="numero_residencial" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 60px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">Complemento: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="complemento_residencial" name="complemento_residencial" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">Bairro: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="bairro_residencial" name="bairro_residencial" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">Cidade: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="cidade_residencial" name="cidade_residencial" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        <fieldset style="width: 100%;">
            <legend>Endereço Comercial</legend>
            <table id="endereço2">
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Rua: </label>
                    </td>
                    <td style="width: 390px;">
                        <input type="text" id="rua_comercial" name="rua_comercial" class="text-input" data-prompt-position="centerRight" style="width: 390px"/>
                    </td>
                    <td style="width: 50px;">
                        <label class="label_cadastro">Número: </label>
                    </td>
                    <td style="width: 60px;">
                        <input type="text" id="numero_comercial" name="numero_comercial" class="text-input" data-prompt-position="centerRight" style="width: 60px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <label class="label_cadastro">Complemento: </label>
                    </td>
                    <td colspan="3">
                        <input type="text" id="complemento_comercial" name="complemento_comercial" class="text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <label class="label_cadastro">Bairro: </label>
                    </td>
                    <td colspan="3">
                        <input type="text" id="bairro_comercial" name="bairro_comercial" class="text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <label class="label_cadastro">Cidade: </label>
                    </td>
                    <td colspan="3">
                        <input type="text" id="cidade_comercial" name="cidade_comercial" class="text-input" data-prompt-position="centerRight" style="width: 200px"/>
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
        <input type="submit" id="button_cadastrar" name="button_cadastrar" value="Cadastrar" class="button"/>
        <input type="submit" id="button_atualizar" name="button_atualizar" value="Atualizar" class="button" style="display: none;"/>
    </form>
    </br></br>
</div>

<div id="form_gerenciar" style="display: none;">
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
</div>

<?php require 'structure/footer.php'; ?>
