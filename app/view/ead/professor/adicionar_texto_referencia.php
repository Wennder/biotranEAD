<script src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.form.js"></script>
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
    <form id="form_cadastrar" class="form_cadastrar" method="post" action="ajax/crud_conteudo_modulo.php?acao=inserir_texto_referencia" enctype="multipart/form-data">
        <fieldset style="width:420px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
            <legend>Dados do texto de referencia</legend>
            <fieldset style="width:400px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Nome</legend>
                <input type="text" name="nome" id="nome" style="width:400px;" value="" class="validate[required] text-input" />
            </fieldset>
            <fieldset style="width:400px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Arquivo</legend>
                <input type="file" name="arquivo" id="arquivo" style="width:400px;" value="" class="validate[required] text-input" />
                <progress value="0" max="100"></progress><span id="porcentagem">0%</span>
            </fieldset>
            <input type="submit" id="button_add" name="button_cadastrar" value="Adicionar" class="button"/>
        </fieldset>

        <div style="display:none;">
            <input type="text" id="id_modulo" name="id_modulo" value="<?php echo ($this->modulo != null ? $this->modulo->getId_modulo() : '') ?>" class="button"/>
        </div>
    </form>
    </br></br>
</div>
