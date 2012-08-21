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
    <form id="editar" class="form_editar" method="post" action="index.php?c=ead&a=atualizar_usuario">
        <fieldset style="width: 100%;">
            <legend>Dados Pessoais</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_editar">Nome completo: </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="nome" name="nome" value="<?php echo $this->usuario->getNome_completo(); ?>" class="validate[required, custom[onlyLetterSp]] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_editar">Permissão: </label>
                    </td>
                    <td style="width: 500px;">
                        <select id="id_papel" name="id_papel" disabled="disabled" class="validate[required]" data-prompt-position="centerRight">
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
                        <label class="label_editar">Data de nascimento: </label>
                    </td>
                    <td>
                        <input type="text" id="dataNascimento" name="dataNascimento" value="<?php echo $this->usuario->getData_nascimento(); ?>" class="validate[required, custom[date]] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="10"/>
                        <label class="label_editar_legend">DD/MM/AAAA </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_editar">CPF: </label>
                    </td>
                    <td>
                        <input type="text" id="cpf" name="cpf" value="<?php echo $this->usuario->getCpf(); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="14"/>
                        <label class="label_editar_legend">XXX.XXX.XXX-XX </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_editar">RG: </label>
                    </td>
                    <td>
                        <input type="text" id="rg" name="rg" value="<?php echo  $this->usuario->getRg(); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="12"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_editar">Atuação: </label>
                    </td>
                    <td>
                        <select id="atuacao" name="atuacao" value="<?php echo $this->usuario->getAtuacao(); ?>" class="validate[required]" data-prompt-position="centerRight">
                            <option value></option>
                            <option value="Agronômo">Agrônomo</option>
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
                        <label class="label_editar">Identidade Profissional: </label>
                    </td>
                    <td>
                        <input type="text" id="indentidade_profissional" name="indentidade_profissional" value="<?php echo $this->usuario->getId_profissional(); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 150px"/>
                        <label class="label_editar_legend"> </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_editar">Sexo: </label>
                    </td>
                    <td>
                        <input type="radio" name="group0" id="sexoM" <?php echo $this->usuario->getSexo() == "M" ? "checked" : ""; ?> value="M" class="validate[required] radio" data-prompt-position="centerRight">
                        <label class="label_editar">Masculino </label>
                        <input type="radio" name="group0" id="sexoF" <?php echo $this->usuario->getSexo() == "F" ? "checked" : ""; ?> value="F" class="validate[required] radio" data-prompt-position="centerRight">
                        <label class="label_editar">Feminino </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_editar">Telefone Residencial: </label>
                    </td>
                    <td>
                        <input type="text" id="telResidencial" name="telResidencial" value="<?php echo  $this->usuario->getTel_residencial(); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="13"/>
                        <label class="label_editar_legend">(XX)XXXX-XXXX </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_editar">Telefone Comercial: </label>
                    </td>
                    <td>
                        <input type="text" id="telComercial" name="telComercial" value="<?php echo $this->usuario->getTel_comercial(); ?>" class="text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="13"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_editar">Celular 1: </label>
                    </td>
                    <td>
                        <input type="text" id="cel1" name="cel1" value="<?php echo $this->usuario->getTel_celular1(); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="13"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_editar">Celular 2: </label>
                    </td>
                    <td>
                        <input type="text" id="cel2" name="cel2" value="<?php echo $this->usuario->getTel_celular2(); ?>" class="text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="13"/>
                    </td>
                </tr>            
                <tr>
                    <td>
                        <label class="label_editar">Descrição Pessoal: </label>
                    </td>
                    <td>
                        <textarea id="descricaoPessoal" name="descricaoPessoal"rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"><?php echo $this->usuario->getDescricao_pessoal(); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_editar">Foto (100x120): </label>
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
                        <label class="label_editar">Rua: </label>
                    </td>
                    <td style="width: 390px;">
                        <input type="text" id="rua1" name="rua1" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 390px"/>
                    </td>
                    <td style="width: 50px;">
                        <label class="label_editar">Número: </label>
                    </td>
                    <td style="width: 60px;">
                        <input type="text" id="num1" name="num1" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 60px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_editar">Complemento: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="complemento1" name="complemento1" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_editar">Bairro: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="bairro1" name="bairro1" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_editar">Cidade: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="cidade1" name="cidade1" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
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
                        <label class="label_editar">Rua: </label>
                    </td>
                    <td style="width: 390px;">
                        <input type="text" id="rua2" name="rua2" class="text-input" data-prompt-position="centerRight" style="width: 390px"/>
                    </td>
                    <td style="width: 50px;">
                        <label class="label_editar">Número: </label>
                    </td>
                    <td style="width: 60px;">
                        <input type="text" id="num2" name="num2" class="text-input" data-prompt-position="centerRight" style="width: 60px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <label class="label_editar">Complemento: </label>
                    </td>
                    <td colspan="3">
                        <input type="text" id="complemento2" name="complemento2" class="text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <label class="label_editar">Bairro: </label>
                    </td>
                    <td colspan="3">
                        <input type="text" id="bairro2" name="bairro2" class="text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <label class="label_editar">Cidade: </label>
                    </td>
                    <td colspan="3">
                        <input type="text" id="cidade2" name="cidade2" class="text-input" data-prompt-position="centerRight" style="width: 200px"/>
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