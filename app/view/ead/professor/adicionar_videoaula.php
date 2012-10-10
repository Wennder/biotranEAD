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
    <form id="form_cadastrar" class="form_cadastro" method="post" action="ajax/crud_conteudo_modulo.php?acao=inserir_video" enctype="multipart/form-data">
        <fieldset style="width:520px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
            <legend>Dados da video-aula</legend>
            <fieldset style="width:500px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Título da aula</legend>
                <input type="text" id="titulo" name="titulo" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
            </fieldset>
            <fieldset style="width:500px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Video</legend>
                <input type="file" id="video" name="video" style="width:500px;" value="" class="validate[required] text-input" />
                <progress value="0" max="100"></progress><span id="porcentagem">0%</span>
            </fieldset>
            <fieldset style="width:500px; padding:0 5px 5px 5px; margin: 0 2.5px 2.5px 2.5px; ">
                <legend>Descrição</legend>
                <textarea placeholder="Descrição" id="descricao" style="width:500px;" name="descricao" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
            </fieldset>
            <input type="submit" id="btn_add" name="btn_add" value="Adicionar" class="button"/>
        </fieldset>

        <div style="display:none;">
            <input type="text" id="id_modulo" name="id_modulo" value="<?php echo ($this->modulo != null ? $this->modulo->getId_modulo() : '') ?>" class="button"/>
        </div>
    </form>
    </br></br>
</div>
