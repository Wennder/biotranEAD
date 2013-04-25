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
                    <?php
                    if ($_SESSION["usuarioLogado"]->getId_papel() == '1') {
                        echo ('<tr id="_id_tr_id_papel">
                            <td style="width: 150px;">
                                <label class="label_cadastro">*Permissão: </label>
                            </td>
                            <td style="width: 500px;">
                                <select id="_id_id_papel" name="_id_id_papel" class="text-input" style="width: auto;">
                                    <option></option>                                    
                                    <option id="perm_Gestor" value="1">Administrador</option>
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