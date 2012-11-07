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
    case 3:
        require 'structure/leftcolumn_professor_home.php';
        break;
    case 4:
        require 'structure/leftcolumn_aluno_home.php';
        break;
}
?>
<?php require 'structure/content.php'; ?>
<div id="dialog_profile">
<div id="profile" class="profile" style="margin: 0;">
    <fieldset style="width: 650px; padding-left:  40px;">
        <legend>Profile</legend>
        <table style="width: 650px;">
            <tr>
                <td style="width: 120px;">
                    <div id="foto_usuario">
                        <img src="img/profile/<?php echo $this->usuario->getId_usuario();?>.jpg
                        
                        " alt="" height="120" width="100" />
                    </div>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <label class="label_profile">Nome: </label>
                                <label class="label_profile"><?php echo $this->usuario->getNome_completo();?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_profile">Atuação: </label>
                                <label class="label_profile"><?php echo $this->usuario->getAtuacao();?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_profile">E-mail: </label>
                                <label class="label_profile"><?php echo $this->usuario->getEmail();?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_profile">Sexo: </label>
                                <label class="label_profile"><?php echo $this->usuario->getSexo();?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_profile">Data de Nascimento: </label>
                                <label class="label_profile"><?php echo $this->usuario->getData_nascimento();?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_profile">Cidade: </label>
                                <label class="label_profile">#CIDADE#</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_profile">#PAPEL#</label>
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
                    <label class="label_profile">#DESCRICAO#</label>
                </td>
            </tr>
            <tr><td colspan="2"</td></tr>
            
        </table>
    </fieldset>
    </br></br>
</div>
</div>

<?php require 'structure/footer.php'; ?>