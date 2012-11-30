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

<div id="form_cadastro" style="">
    <form id="form_cadastrar" class="form_cadastro" method="post" action="ajax/crud_exercicio.php?acao=inserir_exercicio" enctype="multipart/form-data">
        <fieldset style="width:520px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
            <legend>Dados do Exercicio</legend>
            <fieldset style="width:500px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Titulo do Exercicio</legend>
                <input type="text" id="titulo" name="titulo" value="" class="text-input"style="width: 500px"/>
            </fieldset>
            <fieldset style="width:500px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Descricao (opcional)</legend>
                <textarea placeholder="Descrição" id="descricao" style="width:500px;" name="descricao" rows="3" class="text-area" maxlength="100"></textarea>
            </fieldset>
            <input type="submit" id="button_add_exercicio" name="button_cadastrar" value="Adicionar" class="button2"/>
            <div style="display:none;">
                <input type="text" id="id_modulo" name="id_modulo" value="<?php echo ($this->modulo != null ? $this->modulo->getId_modulo() : '') ?>" class="button"/>
            </div>
        </fieldset>

    </form>
</div>
