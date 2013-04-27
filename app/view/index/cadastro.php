<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php'; ?>

<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/messages_pt_BR.js" type="text/javascript"></script>

<script>
    //alteracao
    var cpf = "<input type=\"text\" id=\"cpf_passaporte\" tipo=\"cpf\" name=\"cpf_passaporte\" onkeypress=\"return apenas_numero(event);\" class=\"text-input\" style=\"width: 115px\" maxlength=\"14\"/>";
    var passaporte = "<input type=\"text\" id=\"cpf_passaporte\" tipo=\"passaporte\" name=\"cpf_passaporte\" class=\"text-input\" style=\"width: 115px\" maxlength=\"14\"/>";
    //-----
    
    $(document).ready(function(){ 
        //alteracao
        $("#radio_cpf").click(function(){
            $("#radio_cpf").attr("checked", true);
         
            if($("#campo_cpf_passaporte input").attr("tipo") != "cpf"){
                
                $("#cpf_passaporte").rules("remove");
                $("#cpf_passaporte").remove();
                $("#campo_cpf_passaporte label").remove();
                $("#campo_cpf_passaporte").append(cpf);
                $("#cpf_passaporte").rules("add", {required: true,
                    number: true,
                    minlength:11,
                    maxlength:11,
                    remote: 'ajax/validarCamposUnicos.php?acao=cpf_passaporte&controller=usuario&id=-1',
                    message:{minlength: "Coloque todos os 11 numeros do cpf",
                        remote: "Este CPF já está sendo utilizado"}
                });
            }
           
            $("#radio_passaporte").removeAttr("checked");
           
            
        });
        $("#radio_passaporte").click(function(){
            $("#radio_passaporte").attr("checked",true);
           
            $("#radio_cpf").removeAttr("checked" );
            if($("#campo_cpf_passaporte input").attr("tipo") != "passaporte"){
                $("#cpf_passaporte").rules("remove");
                $("#cpf_passaporte").remove();
                $("#campo_cpf_passaporte label").remove();
                $("#campo_cpf_passaporte").append(passaporte);
                $("#cpf_passaporte").rules("add",{
                required:true,
                remote: 'ajax/validarCamposUnicos.php?acao=cpf_passaporte&controller=usuario&id=-1',
                message: {
                    remote: "Este passaporte já está sendo utilizado"
                }});
                
            }
        });
        //------
        
        
        $("#cadastro").validate({
            rules:{
                nome_completo: {
                    required: true
                },
                atuacao: {
                    required: true
                },
                sexo: {
                    required: true
                },
//                cpf_passaporte: {
//                    required: true,
//                    number: true,
//                    remote: 'ajax/validarCamposUnicos.php?acao=cpf_passaporte&controller=usuario&id=-1'
//                },
                endereco_rua: {
                    required: true
                },
                endereco_numero: {
                    required: true,
                    number: true
                },
                endereco_bairro: {
                    required: true
                },
                endereco_cidade: {
                    required: true
                },
                endereco_pais: {
                    required: true
                },
                email: {
                    required: true,
                    email: true,
                    remote: "ajax/validarCamposUnicos.php?acao=email&controller=usuario&id=-1"
                },
                senha: {
                    equalTo: "#senha2"
                }
            },
            messages:{
//                cpf_passaporte: {
//                    remote: "Este CPF/Passaporte já está sendo utilizado"
//                },
                email: {
                    remote: "Este login já está sendo utilizado."
                }
            }
        });
        
        $("#cpf_passaporte").rules("add", {required: true,
            number: true,
            minlength:11,
            maxlength:11,
            remote: 'ajax/validarCamposUnicos.php?acao=cpf_passaporte&controller=usuario&id=-1',
            message:{minlength: "Coloque todos os 11 numeros do cpf",
                remote: "Este CPF já está sendo utilizado"}
        });
        
    });
    
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
        <fieldset >
            <legend>Dados Pessoais</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">*Nome completo: </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="nome_completo" name="nome_completo" class="text-input" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Atuação: </label>
                    </td>
                    <td>
                        <select id="atuacao" name="atuacao" class="text-input" style="width: auto;">
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
                        <input type="radio" name="sexo" id="sexoM" value="Masculino" checked>
                        <label class="label_cadastro">Masculino </label>
                        <input type="radio" name="sexo" id="sexoF" value="Feminino">
                        <label class="label_cadastro">Feminino </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*CPF/Passaporte: </label>
                    </td>
                    <td id="campo_cpf_passaporte">
                        <input type="text" id="cpf_passaporte" tipo="cpf" name="cpf_passaporte" onkeypress="return apenas_numero(event);" class="text-input" style="width: 115px" maxlength="14"/>

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="radio" id="radio_cpf" name="cpf_ou_passaporte" value="cpf" title="cpf" checked="checked"/><label>CPF</label>
                        <input type="radio" id="radio_passaporte" name="cpf_ou_passaporte" value="passaporte" /><label>Passaporte</label></td>
                </tr>
            </table>
        </fieldset>
        <br>
        <fieldset >
            <table id="endereço">
                <legend>Endereço</legend>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">*Rua: </label>
                    </td>
                    <td style="width: 390px;">
                        <input type="text" id="endereco_rua" name="endereco_rua" class="text-input" style="width: 390px"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50px;">
                        <label class="label_cadastro">*Número: </label>
                    </td>
                    <td style="width: 60px;">
                        <input type="text" id="endereco_numero" name="endereco_numero" class="text-input" onkeypress="return apenas_numero(event);" style="width: 60px"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Complemento: </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="endereco_complemento" name="endereco_complemento" class="text-input" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">*Bairro: </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="endereco_bairro" name="endereco_bairro" class="text-input" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">*Cidade: </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="endereco_cidade" name="endereco_cidade" class="text-input" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">*País: </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="endereco_pais" name="endereco_pais" value="Brasil" class="text-input" style="width: 200px" onkeyup="paisBrasil()"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">
                        <label id="label_estado" class="label_cadastro">*Estado: </label>
                    </td>
                    <td style="width: 500px;">
                        <select id="endereco_estado" name="endereco_estado" class="text-input" style="width: auto;">
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
        <fieldset >
            <legend>Acesso</legend>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">*E-mail (login): </label>
                    </td>
                    <td style="width: 500px;">
                        <input type="text" id="email" name="email"  class="text-input"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Senha: </label>
                    </td>
                    <td>
                        <input type="password" id="senha" name="senha" class="text-input" style="width: 150px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Confirmar Senha: </label>
                    </td>
                    <td>
                        <input type="password" id="senha2" name="senha2" class="text-input" style="width: 150px"/>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        <input type="submit" id="button_cadastrar" name="button_cadastrar" value="Cadastrar" class="button2"/>
        <div id="div_hidden" style="display: none;">
            <input type="text" id="id" name="id" value=""/>
        </div>
    </form>
    </br></br>
</div>

<?php require 'structure/footer.php'; ?>
