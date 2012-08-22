<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn.php'; ?>
<?php require 'structure/content.php'; ?>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>
    $(document).ready(function(){
        $("#editar").validationEngine();
        var papel = $("#i_papel");
        $("#id_papel").val(papel.val());
        var atuacao = $("#i_atuacao");
        $("#atuacao").val(atuacao.val());
    });
</script>

<div id="form_editar">
    <h2>Alterar Dados Pessoais</h2>
    <form id="editar" class="form_editar" method="post" action="index.php?c=ead&a=atualizar_cadastro_usuario" enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Dados Pessoais</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">*Nome completo: </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="nome_completo" name="nome_completo" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getNome_completo()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">*Permissão: </label>
                    </td>
                    <td style="width: 500px;">
                        <select id="id_papel" name="id_papel" disabled="true" class="validate[required]" data-prompt-position="centerRight">
                            <option value></option>
                            <option value="1">Administrador</option>
                            <option value="2">Gestor</option>
                            <option value="3">Professor</option>
                            <option value="4">Estudante</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Atuação: </label>
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
                        <label class="label_cadastro">*Sexo: </label>
                    </td>
                    <td>
                        <input type="radio" name="sexo" id="sexoM" <?php echo ($this->usuario == null ? '' : ($this->usuario->getSexo() == "Masculino") ? "checked" : ""); ?> value="Masculino" class="validate[required] radio" data-prompt-position="centerRight">
                        <label class="label_cadastro">Masculino </label>
                        <input type="radio" name="sexo" id="sexoF" <?php echo ($this->usuario == null ? '' : ($this->usuario->getSexo() == "Feminino") ? "checked" : ""); ?> value="Feminino" class="validate[required] radio" data-prompt-position="centerRight">
                        <label class="label_cadastro">Feminino </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*CPF/Passaporte: </label>
                    </td>
                    <td>
                        <input type="text" id="cpf_passaporte" name="cpf_passaporte" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getCpf_passaporte()); ?>" class="validate[required, custom[onlyNumberSp]] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="14"/>
                        <label class="label_editar_legend">XXX.XXX.XXX-XX </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">RG: </label>
                    </td>
                    <td>
                        <input type="text" id="rg" name="rg" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getRg()); ?>" class="text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="15"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Data de nascimento: </label>
                    </td>
                    <td>
                        <input type="text" id="data_nascimento" name="data_nascimento" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getData_nascimento()); ?>" class="text-input" data-prompt-position="centerRight" onKeyUp='mascara_data(this)' onkeypress="return apenas_numero(event);" style="width: 115px" maxlength="10"/>
                        <label class="label_editar_legend">DD/MM/AAAA </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Telefone Principal: </label>
                    </td>
                    <td>
                        <input type="text" id="tel_principal" name="tel_principal" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getTel_principal()); ?>" class="text-input" data-prompt-position="centerRight" onkeypress="return apenas_numero(event);" style="width: 115px" maxlength="13"/>
                        <label class="label_editar_legend">(XX)XXXX-XXXX </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Telefone Secundário: </label>
                    </td>
                    <td>
                        <input type="text" id="tel_secundario" name="tel_secundario" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getTel_secundario()); ?>" class="text-input" data-prompt-position="centerRight" onkeypress="return apenas_numero(event);" style="width: 115px" maxlength="13"/>
                    </td>
                </tr>
                <tr>                    
                    <td>
                        <label class="label_cadastro">Identidade Profissional: </label>
                    </td>
                    <td>
                        <input type="text" id="id_profissional" name="id_profissional" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getId_profissional()); ?>" class="text-input" data-prompt-position="centerRight" style="width: 150px" maxlength="15"/>
                        <label class="label_cadastro_legend"> </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Descrição Pessoal: </label>
                    </td>
                    <td>
                        <textarea id="descricao_pessoal" name="descricao_pessoal" rows="3" class="text-input" data-prompt-position="centerRight" maxlength="100"><?php echo ($this->usuario == null ? '' : $this->usuario->getDescricao_pessoal()); ?></textarea>
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
                        <label class="label_cadastro">Rua: </label>
                    </td>
                    <td style="width: 390px;">
                        <input type="text" id="endereco_rua" name="endereco_rua" value="<?php echo ($this->endereco == null ? '' : $this->endereco->getRua()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 390px"/>
                    </td>
                    <td style="width: 50px;">
                        <label class="label_cadastro">Número: </label>
                    </td>
                    <td style="width: 60px;">
                        <input type="text" id="endereco_numero" name="endereco_numero" value="<?php echo ($this->endereco == null ? '' : $this->endereco->getNumero()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 60px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">Complemento: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="endereco_complemento" name="endereco_complemento" value="<?php echo ($this->endereco == null ? '' : $this->endereco->getComplemento()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">Bairro: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="endereco_bairro" name="endereco_bairro" value="<?php echo ($this->endereco == null ? '' : $this->endereco->getBairro()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">Cidade: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="endereco_cidade" name="endereco_cidade" value="<?php echo ($this->endereco == null ? '' : $this->endereco->getCidade()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
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
                        <label class="label_editar">E-mail (login): </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="email" name="email" value="<?php echo $this->usuario->getEmail(); ?>" class="validate[required, custom[email]] text-input" data-prompt-position="centerRight"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_editar">Senha: </label>
                    </td>
                    <td>
                        <input type="password" id="senha" name="senha" class="text-input" data-prompt-position="centerRight" style="width: 150px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_editar">Confirmar Senha: </label>
                    </td>
                    <td>
                        <input type="password" id="senha2" name="senha2" class="validate[equals[senha]] text-input" data-prompt-position="centerRight" style="width: 150px"/>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        <input type="submit" id="button_salvar" name="button_salvar" value="Salvar" class="button"/>
    </form>
    </br></br>
</div>

<div id="div_hidden" style="display: none;">
    <input type="text" id="i_papel" name="i_papel" value="<?php echo $this->usuario->getId_papel(); ?>"/>
    <input type="text" id="i_atuacao" name="i_atuacao" value="<?php echo $this->usuario->getAtuacao(); ?>"/>
</div>

<?php require 'structure/footer.php'; ?>
