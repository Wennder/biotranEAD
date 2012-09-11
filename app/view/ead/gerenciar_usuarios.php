<?php
$editar = "false";
if (isset($this->usuario)) {
    $this->usuario == null ? $editar = "false" : $editar = $this->usuario->getId_usuario();
} else {
    $this->usuario = null;
}
?>

<?php require 'structure/header.php'; ?>
<?php
$papel = $_SESSION["usuarioLogado"]->getId_papel();
switch ($papel) {
    case 1:
        require 'structure/leftcolumn_admin.php';
        break;
    case 2:
        require 'structure/leftcolumn_gestor.php';
        break;
}
?>
<?php require 'structure/content.php'; ?>
<script src="js/validarCpf_passaporteCadastro.js" type="text/javascript"></script>
<script src="js/crudTabelaUsuario.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css"/>

<script>
    $(document).ready(function(){
        //Habilita a validação automática no formulário de cadastro
        $("#cadastro").validationEngine();
        //Verifica se é o modo de edição
        if($("#i_editar").val() != "false"){
            $("#form_cadastro").show();
            $("#opcoes_cadastro").hide();
            $("#button_cadastrar").hide();
            $("#button_atualizar").show();
        }
        else{
            $("#id").val(-1);
            $("#form_cadastro").hide();
        }
        //Habilita a validação automática no formulário de edição
        $("#editar").validationEngine();
        //Captura o papel do usuário a ser editado e seta o combobox
        var papel = $("#i_papel");
        $("#id_papel").val(papel.val());
        //Captura a atuação do usuário a ser editado e seta o combobox
        var atuacao = $("#i_atuacao");
        $("#atuacao").val(atuacao.val());
        //Verifica se o país é Brasil, captura o estado do usuário a ser editado e seta o combobox
        var estado = $("#i_estado");
        if(paisBrasil()){
            $("#endereco_estado").val(estado.val());
        }
        else{
            $("#endereco_estado").hide();
        }
        //Instanciação e configuração da tabela
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
   
    //Alterna entre a exibição do formulario de cadastro e a tabela de consulta
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
    
    //Verifica se o e-mail informado pelo usuário já é cadastrado ou não
    function validaLogin_ajax(login_antigo){
        if($('#email').val() != login_antigo){
            $.getJSON('ajax/validarLoginCadastro.php?search=',{
                login: $('#email').val(),                         
                ajax: 'true'
            }, function(j){
                //usuario validado         
                if(j == 0){
                    alert('Este e-mail já está cadastrado.');                                
                    $('#email').val('');
                }
            });            
        }
    }
    
    //Altera a action do form e submete para atualização dos dados do usuário
    function atualizarCadastro(idusuario){
        $('#cadastro').attr({action: 'index.php?c=ead&a=atualizar_cadastro_admin&id='+idusuario});
        $('#cadastro').submit();
    }
    
    //Máscara de data
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
    
    function getId_usuario(){
        return $("#id_usuario").val();
    }
    
    //Se gestor estiver logado, seta o combo papel como estudante
    function setarCombo(){
        $("#id_papel").val(4);
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

<div id="opcoes_cadastro">
    <input type="button" value="Cadastro" class="button" onclick="mostrar('cadastro');"/>
    <input type="button" value="Gerência" class="button" onclick="mostrar('gerenciar');" style="margin-left: 10px;"/>
</div>

<div id="form_cadastro" style="display: none;">
    <form id="cadastro" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_usuario" enctype="multipart/form-data">
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
                <?php
                if ($_SESSION["usuarioLogado"]->getId_papel() == '1') {
                    echo ('<tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">*Permissão: </label>
                            </td>
                            <td style="width: 500px;">
                                <select id="id_papel" name="id_papel" class="validate[required]" data-prompt-position="centerRight">
                                    <option></option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Gestor</option>
                                    <option value="3">Professor</option>
                                    <option value="4">Estudante</option>
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
                        <input type="text" id="cpf_passaporte" name="cpf_passaporte" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getCpf_passaporte()); ?>" class="validate[required, custom[onlyNumberSp], ajax[validarCpf_cadastro_ajax]] text-input" data-prompt-position="centerRight" style="width: 115px" maxlength="14"/>
                        <label class="label_cadastro_legend">XXX.XXX.XXX-XX </label>
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
                        <label class="label_cadastro_legend">DD/MM/AAAA </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">Telefone Principal: </label>
                    </td>
                    <td>
                        <input type="text" id="tel_principal" name="tel_principal" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getTel_principal()); ?>" class="text-input" data-prompt-position="centerRight" onkeypress="return apenas_numero(event);" style="width: 115px" maxlength="13"/>
                        <label class="label_cadastro_legend">(XX)XXXX-XXXX </label>
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
                        <label class="label_cadastro">*Rua: </label>
                    </td>
                    <td style="width: 390px;">
                        <input type="text" id="endereco_rua" name="endereco_rua" value="<?php echo ($this->endereco == null ? '' : $this->endereco->getRua()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 390px"/>
                    </td>
                    <td style="width: 50px;">
                        <label class="label_cadastro">*Número: </label>
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
                        <input type="text" id="endereco_complemento" name="endereco_complemento" value="<?php echo ($this->endereco == null ? '' : $this->endereco->getComplemento()); ?>" class="text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">*Bairro: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="endereco_bairro" name="endereco_bairro" value="<?php echo ($this->endereco == null ? '' : $this->endereco->getBairro()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">*Cidade: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="endereco_cidade" name="endereco_cidade" value="<?php echo ($this->endereco == null ? '' : $this->endereco->getCidade()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" style="width: 150px;">
                        <label class="label_cadastro">*País: </label>
                    </td>
                    <td colspan="3" style="width: 500px;">
                        <input type="text" id="endereco_pais" name="endereco_pais" value="<?php echo ($this->endereco == null ? 'Brasil' : $this->endereco->getPais()); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 200px" onkeyup="paisBrasil()"/>
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
                        <input type="text" id="email" name="email" value="<?php echo ($this->usuario == null ? '' : $this->usuario->getEmail()); ?>" class="validate[required, custom[email], ajax[validarLogin_ajax]] text-input" data-prompt-position="centerRight"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Senha: </label>
                    </td>
                    <td>
                        <input type="password" id="senha" name="senha" class="<?php echo ($editar == "true" ? "" : "validate[required] "); ?>text-input" data-prompt-position="centerRight" style="width: 150px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label_cadastro">*Confirmar Senha: </label>
                    </td>
                    <td>
                        <input type="password" id="senha2" name="senha2" class="<?php echo ($editar == "true" ? "" : "validate[required] "); ?>validate[equals[senha]] text-input" data-prompt-position="centerRight" style="width: 150px"/>
                    </td>
                </tr>
            </table>
        </fieldset>
        <br>
        <input type="submit" id="button_cadastrar" name="button_cadastrar" value="Cadastrar" class="button"/>
        <input type="button" id="button_atualizar" onclick="atualizarCadastro(<?php echo ($this->usuario == null ? '' : $this->usuario->getId_usuario()); ?>)" name="button_atualizar" value="Atualizar" class="button" style="display: none;"/>
        <div id="div_hidden" style="display: none;">
            <input type="text" id="id" name="id" value="<?php echo $editar; ?>"/>
        </div>
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
    <input type="text" id="i_estado" name="i_estado" value="<?php echo $this->endereco == null ? '' : $this->endereco->getEstado(); ?>"/>    
</div>

<?php require 'structure/footer.php'; ?>
