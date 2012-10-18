<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>    
    $(document).ready(function(){                
        $('#form_cadastrar').validationEngine();                
    });    
</script>

<div id="form_cadastro" style="">
    <form id="form_cadastrar" class="form_cadastro" method="post" action="ajax/crud_exercicio.php?acao=inserir_exercicio" enctype="multipart/form-data">
        <fieldset style="width:520px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
            <legend>Dados do Exercicio</legend>
            <fieldset style="width:500px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Titulo do Exercicio</legend>
                <input type="text" id="titulo" name="titulo" value="" class="validate[required] text-input" data-prompt-position="topLeft" style="width: 500px"/>
            </fieldset>
            <fieldset style="width:500px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Descricao (opcional)</legend>
                <textarea placeholder="Descrição" id="descricao" style="width:500px;" name="descricao" rows="3" class="validate[required] text-input" data-prompt-position="topLeft" maxlength="100"></textarea>
            </fieldset>
            <input type="submit" id="button_add_exercicio" name="button_cadastrar" value="Adicionar" class="button"/>
            <div style="display:none;">
                <input type="text" id="id_modulo" name="id_modulo" value="<?php echo ($this->modulo != null ? $this->modulo->getId_modulo() : '') ?>" class="button"/>
            </div>
        </fieldset>

    </form>
</div>
