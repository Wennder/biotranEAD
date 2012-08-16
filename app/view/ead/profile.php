<?php require 'structure/header.php'; ?>
<?php require 'structure/leftcolumn.php'; ?>
<?php require 'structure/content.php'; ?>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>
    //    $(document).ready(function(){
    //        $("#cadastro").validationEngine();
    //        var papel = $("#i_papel");
    //        $("#papel").val(papel.val());
    //        var atuacao = $("#i_atuacao");
    //        $("#atuacao").val(atuacao.val());
    //    });
</script>

<div id="profile" class="profile">
    <fieldset style="width: 650px;">
        <legend>Profile</legend>
        <table>
            <tr>
                <td>
                    <div id="foto_usuario">
                        <img src="img/profile/<?php echo $this->usuario->getId_usuario(); ?>.jpg" alt="" height="120" width="100" />
                    </div>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <label class="label_profile">Nome: </label>
                                <label class="label_profile"><?php echo $this->usuario->getNome_completo(); ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_profile">Atuação: </label>
                                <label class="label_profile"><?php echo $this->usuario->getAtuacao(); ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_profile">E-mail: </label>
                                <label class="label_profile"><?php echo $this->usuario->getEmail(); ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_profile">Sexo: </label>
                                <label class="label_profile"><?php echo $this->usuario->getSexo(); ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_profile">Data de Nascimento: </label>
                                <label class="label_profile"><?php echo $this->usuario->getData_nascimento(); ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_profile">Cidade: </label>
                                <label class="label_profile"><?php echo $this->usuario->getData_nascimento(); ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_profile"><?php echo $this->usuario->getId_papel(); ?></label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="label_cadastro">Descrição Pessoal: </label>
                </td>
                <td>
                    <label class="label_profile"><?php echo $this->usuario->getDescricao_pessoal(); ?></label>
                </td>
            </tr>
        </table>
    </fieldset>
    <input type="button" value="Editar" onclick="$(location).attr('href', 'index.php?c=ead&a=dados_pessoais');"/>
    </br></br>
</div>

<!--<div id="div_hidden" style="display: none;">
    <input type="text" id="i_papel" name="i_papel" value="<?php echo $this->usuario->getId_papel(); ?>"/>
    <input type="text" id="i_atuacao" name="i_atuacao" value="<?php echo $this->usuario->getAtuacao(); ?>"/>
</div>-->

<?php require 'structure/footer.php'; ?>