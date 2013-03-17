<script>
    $(document).ready(function(){ 
        $('#form_cadastrar').validate({
            rules:{
                titulo: {
                    required: true
                }
            }
        });
    });
</script>

<div id="form_cadastro">
    <form id="form_cadastrar" class="form_cadastro" method="post" action="ajax/crud_exercicio.php?acao=inserir_exercicio" enctype="multipart/form-data">
        <div style="border-bottom:1px solid #eeeeee; ">
            <center><label style="font-weight: bold; font-size: 14px;">Módulo <?php echo $this->modulo->getNumero_modulo(); ?> - Adicionar Exercício</label></center>
        </div><br>
        <fieldset class="text-input" style="width:inherit">
            <legend>Dados</legend>
            <table style="width: 100%;">
                <tr>
                    <td width="90">
                        <label>Título:</label>
                    </td>
                    <td>
                        <input type="text" id="titulo" name="titulo" class="text-input"style="width: 300px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Descrição:</label>
                    </td>
                    <td>
                        <textarea id="descricao" name="descricao" rows="3" cols="45" class="text-area" maxlength="100"></textarea>
                    </td>
                </tr>
            </table><br>
            <input type="submit" id="button_add_exercicio" name="button_cadastrar" value="Adicionar" class="button2"/>
            <div style="display:none;">
                <input type="text" id="id_modulo" name="id_modulo" value="<?php echo ($this->modulo != null ? $this->modulo->getId_modulo() : '') ?>"/>
            </div>
        </fieldset>
    </form>
    </br>
</div>