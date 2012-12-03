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


<!--<script src="js/validarCpf_passaporteCadastro.js" type="text/javascript"></script>-->
<script src="js/crudTabelaUsuario.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/messages_pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.js" type="text/javascript"></script>
<script src="js/funcoes_gerenciar_usuarios.js" type="text/javascript"></script>
<script src="js/tb_gerenciar_matricula.js" type="text/javascript"></script>
<link href='css/demo_table_jui.css' rel='stylesheet' type="text/css"/>

<!-- formulario de cadastro do usuario -->
<?php require ROOT_PATH . '/app/view/ead/sistema/administrador/form_cadastro_usuario.php'; ?>

<div>
    <div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
        <center><h3 style="margin: 0;">Gerenciar Usuários</h3></center>
        <div id="index_admin">
            <div id="form_gerenciar">   
                <input type="button" value="" id="btn_add" class="classeBotaoAdicionar" style="margin: 0 0 5px 5px;"/> Adicionar
                <input type="button" value="" id="btn_edit"  class="classeBotaoEditar" style="margin: 0 0 5px 10px;"/> Editar
                <input type="button" value="" id="btn_del" class="classeBotaoExcluir" style="margin: 0 0 5px 10px;"/> Remover
                <input type="button" value="" id="btn_view" class="classeBotaoVisualizar" style="margin: 0 0 5px 10px;"/> Visualizar
                <input type="button" value="" id="btn_ger_matricula" class="classeBotaoVisualizar" style="margin: 0 0 5px 10px;"/> Gerenciar Matrícula
                <br>
                <?php echo $this->tabela; ?>
            </div>
        </div>
    </div>
</div>


<div id="div_hidden" style="display: none;">
    <input type="text" id="i_papel" name="i_papel" value="<?php echo $this->usuario == null ? '' : $this->usuario->getId_papel(); ?>"/>
    <input type="text" id="i_atuacao" name="i_atuacao" value="<?php echo $this->usuario == null ? '' : $this->usuario->getAtuacao(); ?>"/>
    <input type="text" id="i_estado" name="i_estado" value="<?php echo $this->endereco == null ? '' : $this->endereco->getEstado(); ?>"/>    
</div>

<?php require ROOT_PATH . '/app/view/ead/profile_dialog.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
