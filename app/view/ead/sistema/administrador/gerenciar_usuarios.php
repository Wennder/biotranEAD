<?php
$editar = "false";
if (isset($this->usuario)) {
    $this->usuario == null ? $editar = "false" : $editar = $this->usuario->getId_usuario();
} else {
    $this->usuario = null;
}
?>

<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php
$papel = $_SESSION["usuarioLogado"]->getId_papel();
switch ($papel) {
    case 1:
        require ROOT_PATH . '/app/view/ead/structure/leftcolumn_admin.php';
        break;
    case 2:
        require ROOT_PATH . '/app/view/ead/structure/leftcolumn_gestor.php';
        break;
}
?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>


<script src="js/validarCpf_passaporteCadastro.js" type="text/javascript"></script>
<script src="js/crudTabelaUsuario.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="js/funcoes_gerenciar_usuarios.js" type="text/javascript"></script>
<script src="js/tb_gerenciar_matricula.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css"/>

<!-- formulario de cadastro do usuario -->
<?php require ROOT_PATH . '/app/view/ead/sistema/administrador/form_cadastro_usuario.php'; ?>


<div id="form_gerenciar" style="">
    <input type="button" value="Adicionar usuario" id="btn_add" class="botao_gerencia_data_table" />
    <input type="button" value="Editar" id="btn_edit"  class="botao_gerencia_data_table"/>
    <input type="button" value="Remover" id="btn_del" class="botao_gerencia_data_table"/>
    <input type="button" value="Ver" id="btn_view" class="botao_gerencia_data_table"/>
    <input type="button" value="Gerenciar Matricula" id="btn_ger_matricula" class="botao_gerencia_data_table"/>
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

<?php require ROOT_PATH . '/app/view/ead/profile_dialog.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
