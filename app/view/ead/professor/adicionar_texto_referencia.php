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

<div id="form_cadastro" style="">
    <form id="form_cadastrar" class="form_cadastrar" method="post" action="ajax/crud_conteudo_modulo.php?acao=inserir_texto_referencia" enctype="multipart/form-data">
        <fieldset style="width:420px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
            <legend>Dados do texto de referencia</legend>
            <fieldset style="width:400px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Nome</legend>
                <input type="text" name="nome" id="nome" style="width:400px;" value="" class="text-input"/>
            </fieldset>
            <fieldset style="width:400px; padding:0 5px 5px 5px;">
                <legend>Arquivo</legend>
                <input type="file" name="arquivo" id="arquivo" style="width:400px;" value="" class="text-input"/>
                <progress value="0" max="100"></progress><span id="porcentagem">0%</span>
                <label class="error" for="arquivo" generated="true" style="display: none; position: relative;">O formato de arquivo aceito é somente .pdf.</label>
            </fieldset>
            <input type="submit" id="button_add" name="button_cadastrar" value="Adicionar" class="button2"/>
        </fieldset>
        <div style="display:none;">
            <input type="text" id="id_modulo" name="id_modulo" value="<?php echo ($this->modulo != null ? $this->modulo->getId_modulo() : '') ?>"/>
        </div>
    </form>
    </br></br>
</div>
