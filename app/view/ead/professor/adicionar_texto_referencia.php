<script>
    $(document).ready(function(){ 
        $('#form_cadastrar').validate({
            rules:{
                nome: {
                    required: true
                },
                arquivo: {
                    required: true
                }
            }
        });
    });
</script>

<div id="form_cadastro">
    <form id="form_cadastrar" class="form_cadastro" method="post" action="ajax/crud_conteudo_modulo.php?acao=inserir_texto_referencia" enctype="multipart/form-data">
        <div style="border-bottom:1px solid #eeeeee; width: 620px;">
            <center><label style="font-weight: bold; font-size: 14px;">Módulo <?php echo $this->modulo->getId_modulo(); ?> - Adicionar Texto de Referência</label></center>
        </div><br>
        <fieldset style="width:600px;">
            <legend>Dados</legend>
            <table style="width: 100%;">
                <tr>
                    <td width="90">
                        <label>Título:</label>
                    </td>
                    <td>
                        <input type="text" id="nome" name="nome" class="text-input" style="width:300px;"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Arquivo:</label>
                    </td>
                    <td>
                        <input type="file" id="arquivo" name="arquivo" class="text-input"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <progress value="0" max="100"></progress><span id="porcentagem">0%</span>
                        <label class="error" for="arquivo" generated="true" style="display: none; position: relative;">O formato de arquivo aceito é somente .pdf.</label>
                    </td>
                </tr>
            </table><br>
            <input type="submit" id="button_add" name="button_cadastrar" value="Adicionar" class="button2"/>
            <div style="display:none;">
                <input type="text" id="id_modulo" name="id_modulo" value="<?php echo ($this->modulo != null ? $this->modulo->getId_modulo() : '') ?>"/>
            </div>
        </fieldset>
    </form>
    </br>
</div>