<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn.php'; ?>
<?php require 'structure/content.php'; ?>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>
$(document).ready(function(){
    $("#cadastro").validationEngine();
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
    <form id="cadastro" class="form_cadastro" method="post">
        <table>
            <tr>
                <td>
                    <label class="label_cadastro">Nome completo: </label>
                </td>
                <td>
                    <input type="text" id="nome" name="nome" class="validate[required, custom[onlyLetterSp]] text-input" data-prompt-position="centerRight"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label_cadastro">Data de nascimento: </label>
                </td>
                <td>
                    <input type="text" id="dataNascimento" name="dataNascimento" class="validate[required, custom[date]] text-input" data-prompt-position="centerRight"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label_cadastro">CPF: </label>
                </td>
                <td>
                    <input type="text" id="cpf" name="cpf" class="validate[required] text-input" data-prompt-position="centerRight"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label_cadastro">RG: </label>
                </td>
                <td>
                    <input type="text" id="rg" name="rg" class="validate[required] text-input" data-prompt-position="centerRight"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label_cadastro">Atuação: </label>
                </td>
                <td>
                    <input type="atuacao" id="nome" name="atuacao" class="validate[required] text-input" data-prompt-position="centerRight"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label_cadastro">Sexo: </label>
                </td>
                <td>
                    <input type="text" id="sexo" name="sexo" class="validate[required] text-input" data-prompt-position="centerRight"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label_cadastro">Telefone Residencial: </label>
                </td>
                <td>
                    <input type="text" id="telResidencial" name="telResidencial" class="validate[required] text-input" data-prompt-position="centerRight"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label_cadastro">Telefone Comercial: </label>
                </td>
                <td>
                    <input type="text" id="telComercial" name="telComercial" class="validate[required] text-input" data-prompt-position="centerRight"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label_cadastro">Descrição Pessoal: </label>
                </td>
                <td>
                    <input type="text" id="descricaoPessoal" name="descricaoPessoal" class="validate[required] text-input" data-prompt-position="centerRight"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label_cadastro">E-mail (login): </label>
                </td>
                <td>
                    <input type="text" id="email" name="email" class="validate[required, custom[email]] text-input" data-prompt-position="centerRight"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label_cadastro">Senha: </label>
                </td>
                <td>
                    <input type="password" id="senha" name="senha" class="validate[required] text-input" data-prompt-position="centerRight"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label_cadastro">Confirmar Senha: </label>
                </td>
                <td>
                    <input type="password" id="senha2" name="senha2" class="validate[required, equals[senha]] text-input" data-prompt-position="centerRight"/>
                </td>
            </tr>
            <tr style="height: 20px;"><td></td></tr>
            <tr>
                <td>
                    <input type="submit" id="button_cadastrar" name="button_cadastrar" value="Cadastrar"/>
                </td>
            </tr>
            <tr><td></td></tr>
        </table>
    </form>
</div>


<div id="form_editar" style="display: none;">
    <form id="editar" class="form_editar" method="post">
        <table>
            <tr>
                <td>
                    
                </td>
            </tr>
        </table>
    </form>
</div>

<?php require 'structure/footer.php'; ?>