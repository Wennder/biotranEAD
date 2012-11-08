<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>    
    
</script>
<div>
    <div style="display:none;">                
        <input type="text" name="id" id="id" value="<?php echo $this->exercicio->getId_exercicio(); ?>"/>            
    </div>
    <div id="form_cadastro" style="">
        <fieldset style="width:640px; padding:0 5px 5px 5px; margin: 0 2.5px; ">            
            <legend>Dados do Exercicio</legend>
            <fieldset style="width:615px; float:left; padding:0 5px 5px 5px; margin: 0 2.5px;">
                <legend>Nome do Exercicio</legend>
                <input type="text" readonly="true" id="titulo_exercicio" name="titulo_exercicio" value="<?php echo $this->exercicio->getTitulo(); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 600px"/>
            </fieldset >
            <fieldset style="width:615px; float:left; padding:0 5px 5px 5px; margin: 0 2.5px;">
                <legend>Descricao (opcional)</legend>
                <textarea id="descricao_exercicio" readonly="true" style="width:600px;" name="descricao_exercicio" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"><?php echo $this->exercicio->getDescricao(); ?></textarea>
            </fieldset>            
            <div id="div_id_exercicio" style="display:none;" >
                <input name="id_exercicio" id="id_exercicio" type="text" value="<?php echo $this->exercicio->getId_exercicio(); ?>"/>    
            </div>
            <div id="div_id_modulo" style="display:none;" >
                <input name="id_modulo" id="id_modulo" type="text" value="<?php echo $this->exercicio->getId_modulo(); ?>"/>
            </div>
        </fieldset>
        <div style="display:none;">                
            <input type="text" name="id_exercicio" id="id_exercicio" value="<?php echo $this->exercicio->getId_exercicio(); ?>"/>            
        </div>
    </div>
    <div style="padding: 2px 30px;" id="lista_perguntas">        
        <?php echo ($this->listaPerguntas); ?>        
    </div>
    <div>
        <input type="button" value="Submeter questionario" id="submeter_questionario"/>
    </div>
    <div>
        <input type="button" value="Cancelar" id="cancelar_questionario"/>
    </div>
</div>