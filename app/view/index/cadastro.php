<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php'; ?>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>
    $(document).ready(function(){
        $("#cadastro").validationEngine();
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
    
    function mascara_tel(src){
//        var mask = '(##)####-####';
//        var i = src.value.length;
//        var saida = mask.substring(0,0);
//        var texto = mask.substring(i);              
//        if (texto.substring(0,1) != saida)
//        {
//            src.value += texto.substring(0,1);
//        }             
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

<div id="form_cadastro">
    <form id="cadastro" class="form_cadastro" method="post" action="index.php?c=index&a=cadastrar_usuario" enctype="multipart/form-data">
        <fieldset style="width: 100%;">
            <legend>Dados Pessoais</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">*Nome completo: </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="nome_completo" name="nome_completo" class="validate[required, custom[onlyLetterSp]] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Atuação: </label>
                    </td>
                    <td>
                        <select id="atuacao" name="atuacao" class="validate[required]" data-prompt-position="centerRight">
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
                        <input type="radio" name="sexo" id="sexoM" value="Masculino" class="validate[required] radio" data-prompt-position="centerRight">
                        <label class="label_cadastro">Masculino </label>
                        <input type="radio" name="sexo" id="sexoF" value="Feminino" class="validate[required] radio" data-prompt-position="centerRight">
                        <label class="label_cadastro">Feminino </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*CPF/Passaporte: </label>
                    </td>
                    <td>
                        <input type="text" id="cpf_passaporte" name="cpf_passaporte" class="validate[required, custom[onlyNumberSp]] text-input" data-prompt-position="centerRight" onkeypress="return apenas_numero(event);" style="width: 115px" maxlength="14"/>
                        <label class="label_cadastro_legend">Somente números </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">RG: </label>
                    </td>
                    <td>
                        <input type="text" id="rg" name="rg" class="text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="15"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Data de nascimento: </label>
                    </td>
                    <td>
                        <input type="text" id="data_nascimento" name="data_nascimento" class="text-input" data-prompt-position="centerRight" onKeyUp='mascara_data(this)' onkeypress="return apenas_numero(event);" style="width: 115px" maxlength="10"/>
                        <label class="label_cadastro_legend">DD/MM/AAAA </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Telefone: </label>
                    </td>
                    <td>
                        <input type="text" id="tel_principal" name="tel_principal" class="text-input" data-prompt-position="centerRight" onKeyUp='mascara_tel(this)' onkeypress="return apenas_numero(event);" style="width: 115px" maxlength="13"/>
                        <label class="label_cadastro_legend">(XX)XXXX-XXXX </label>
                    </td>
                </tr>
                <tr>                    
                    <td>
                        <label class="label_cadastro">Identidade Profissional: </label>
                    </td>
                    <td>
                        <input type="text" id="id_profissional" name="id_profissional" class="text-input" data-prompt-position="centerRight" style="width: 150px" maxlength="15"/>
                        <label class="label_cadastro_legend"> </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Descrição Pessoal: </label>
                    </td>
                    <td>
                        <textarea id="descricao_pessoal" name="descricao_pessoal" rows="3" class="text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
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
                                        <img src="img/profile/00.jpg" alt="" height="120" width="100" />
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
                        <input type="text" id="endereco_rua" name="endereco_rua" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 390px"/>
                    </td>
                    <td style="width: 50px;">
                        <label class="label_cadastro">*Número: </label>
                    </td>
                    <td style="width: 60px;">
                        <input type="text" id="endereco_numero" name="endereco_numero" class="validate[required] text-input" data-prompt-position="centerRight" onkeypress="return apenas_numero(event);" style="width: 60px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">*Complemento: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="endereco_complemento" name="endereco_complemento" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">*Bairro: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="endereco_bairro" name="endereco_bairro" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">*Cidade: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="endereco_cidade" name="endereco_cidade" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
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
                        <input type="text" id="email" name="email"  class="validate[required, custom[email]] text-input" data-prompt-position="centerRight"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Senha: </label>
                    </td>
                    <td>
                        <input type="password" id="senha" name="senha" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 150px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Confirmar Senha: </label>
                    </td>
                    <td>
                        <input type="password" id="senha2" name="senha2" class="validate[required, equals[senha]] text-input" data-prompt-position="centerRight" style="width: 150px"/>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        <input type="submit" id="button_cadastrar" name="button_cadastrar" value="Cadastrar" class="button"/>
    </form>
    </br></br>
</div>

<?php // require 'structure/content_down.php'; ?>
<?php require 'structure/footer.php'; ?>