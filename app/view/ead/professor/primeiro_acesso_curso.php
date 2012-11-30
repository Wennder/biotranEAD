<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn.php' ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/messages_pt_BR.js" type="text/javascript"></script>

<script>
    $(document).ready(function(){
        $('#cadastro').validate({
            rules:{
                objetivo: {
                    required: true
                },
                justificativa: {
                    required: true
                },
                obs: {
                    required: true
                },
                objetivo: {
                    required: true
                },
                numero_modulos: {
                    required: true,
                    number: true
                }
            }
        });
    });
</script>

<div>
    <div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
        <div id="form_cadastro">
            <label style="font-size: 18px;"><b><?php echo $this->curso->getNome(); ?></b></label><br><br>
            <label>Por favor, preencha o formulário para continuar.</label><br><br>
            <form id="cadastro" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_primeiro_acesso_curso&id=<?php echo $_GET['id'] ?>" enctype="multipart/form-data">
                <fieldset style="width: 100%;">
                    <legend>Definições do Curso</legend>
                    <table>
                        <tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">Objetivo: </label>
                            </td>
                            <td style="width: 500px;">
                                <textarea id="objetivo" name="objetivo" rows="4" class="text-input" maxlength="500"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:150px;">
                                <label class="label_cadastro">Justificativa: </label>
                            </td>
                            <td>
                                <textarea id="justificativa" name="justificativa" rows="4" class="text-input" maxlength="500"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_cadastro">Número de Módulos: </label>
                            </td>
                            <td>
                                <input type="text" style="width:50px;" name="numero_modulos" class="text-input" id="numero_modulos"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="label_cadastro">Observação: </label>
                            </td>
                            <td>
                                <textarea id="obs" name="obs" rows="4" class="text-input" maxlength="500"></textarea>
                            </td>
                        </tr>

                    </table>
                </fieldset>             
                <br>
                <input type="submit" id="button_ok" action="" name="button_ok" value="Continuar" class="button2"/>
            </form>
        </div>
    </div>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
