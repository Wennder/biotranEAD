<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php'; ?>
<script src="js/validarCpf_passaporteCadastro.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>
    $(document).ready(function(){
        //Habilita a validação automática no formulário de cadastro
        $("#cadastro").validationEngine();
    });
    
    function validaLogin_ajax(){        
        $.getJSON('ajax/validarLoginCadastro.php?search=',{
            login: $('#email').val(),                         
            ajax: 'true'
        }, function(j){
            //usuario validado         
            if(j == 0){
                alert('Esse login não pode ser utilizado');                                
                $('#email').val('');
            }
        });                    
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
    
    //Faz o input aceitar apenas números
    function apenas_numero(e){
        var tecla=(window.event)?event.keyCode:e.which;   
        if((tecla>47 && tecla<58)) return true;
        else{
            if (tecla==8 || tecla==0) return true;
            else  return false;
        }
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
                        <input type="text" id="nome_completo" name="nome_completo" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
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
                        <input type="text" id="cpf_passaporte" name="cpf_passaporte" onblur="validaCpf_passaporte_ajax(null);" class="validate[required, custom[onlyNumberSp]] text-input" data-prompt-position="centerRight" onkeypress="return apenas_numero(event);" style="width: 115px" maxlength="14"/>
                        <label class="label_cadastro_legend">Somente números </label>
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
                        <label class="label_cadastro">Complemento: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="endereco_complemento" name="endereco_complemento" class="text-input" data-prompt-position="centerRight" style="width: 200px"/>
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
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">*País: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="endereco_pais" name="endereco_pais" value="Brasil" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px" onkeyup="paisBrasil()"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label id="label_estado" class="label_cadastro">*Estado: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <select id="endereco_estado" name="endereco_estado" class="validate[required]" data-prompt-position="centerRight">
                            <option></option >
                            <option  value="Acre">Acre</option >
                            <option  value="Alagoas">Alagoas</option >
                            <option  value="Amapá">Amapá</option >
                            <option  value="Amazonas">Amazonas</option >
                            <option  value="Bahia">Bahia</option >
                            <option  value="Ceará">Ceará</option >
                            <option  value="Distrito Federal">Distrito Federal</option >
                            <option  value="Espirito Santo">Espirito Santo</option >
                            <option  value="Goiás">Goiás</option >
                            <option  value="Maranhão">Maranhão</option >
                            <option  value="Mato Grosso">Mato Grosso</option >
                            <option  value="Mato Grosso do Sul">Mato Grosso do Sul</option >
                            <option  value="Minas Gerais">Minas Gerais</option >
                            <option  value="Pará">Pará</option >
                            <option  value="Paraiba">Paraiba</option >
                            <option  value="Paraná">Paraná</option >
                            <option  value="Pernambuco">Pernambuco</option >
                            <option  value="Piauí">Piauí</option >
                            <option  value="Rio de Janeiro">Rio de Janeiro</option >
                            <option  value="Rio Grande do Norte">Rio Grande do Norte</option >
                            <option  value="Rio Grande do Sul">Rio Grande do Sul</option >
                            <option  value="Rondônia">Rondônia</option >
                            <option  value="Roraima">Roraima</option >
                            <option  value="Santa Catarina">Santa Catarina</option >
                            <option  value="São Paulo">São Paulo</option >
                            <option  value="Sergipe">Sergipe</option >
                            <option  value="Tocantis">Tocantis</option >
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
                        <input type="text" id="email" name="email"  class="validate[required, custom[email]] text-input" onblur="validaLogin_ajax()" data-prompt-position="centerRight"/>
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
                        <input type="password" id="senha2" name="senha2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 150px"/>
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
