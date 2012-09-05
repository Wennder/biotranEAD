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
        require 'structure/leftcolumn_professor.php';
        break;
    case 4:
        require 'structure/leftcolumn_aluno.php';
        break;
}
?>
<?php require 'structure/content.php'; ?>

<div id="profile" class="profile">
    <fieldset style="width: 650px;">
        <legend>Profile</legend>
        <table style="width: 650px;">
            <tr>
                <td style="width: 120px;">
                    <div id="foto_usuario">
                        <img src="img/profile/<?php
                        if (file_exists('img/profile/' . $this->usuario->getId_usuario() . '.jpg')) {
                            echo $this->usuario->getId_usuario() . '.jpg';
                        } else {
                            echo '00.jpg';
                        }
                        ?>" alt="" height="120" width="100" />
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
            <tr><td colspan="2"</td></tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="button" value="Editar" class="button" onclick="$(location).attr('href', 'index.php?c=ead&a=dados_pessoais&id=<?php echo $this->usuario->getId_usuario(); ?>');"/>
                </td>
            </tr>
        </table>
    </fieldset>
    </br></br>
</div>

<?php require 'structure/footer.php'; ?>