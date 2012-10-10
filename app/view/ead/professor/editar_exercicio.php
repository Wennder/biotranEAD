<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<script src="js/accordion_1.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>
    $(document).ready(function(){                
        $('#btn_editar_exercicio').click(function(){
            if($(this).attr('value') == 'Editar'){
                $('#titulo_exercicio').removeAttr('readonly');
                $('#descricao_exercicio').removeAttr('readonly');
                $('#div_atualizar_exercicio').removeAttr('style');
                $(this).attr('value', 'Cancelar');
            }else{
                $('#titulo_exercicio').attr('readonly', 'true');
                $('#descricao_exercicio').attr('readonly', 'true');
                $('#div_atualizar_exercicio').attr('style', 'display:none;');
                $(this).attr('value', 'Editar');
            }
        });
        
        //        $('#btn_atualizar_exercicio').live('click', function(){
        //           $.post('ajax/crud_exercicio.php?acao=atualizar_descritivo', $('#form_descritivo').serialize(), function(json) {
        //            // handle response
        //            if(json != false){
        //                $('#titulo_modulo').attr('readonly', 'true');
        //                $('#descricao').attr('readonly', 'true');
        //                $('#div_atualizar_modulo').attr('style', 'display:none;');
        //                $('#btn_editar_modulo').attr('value', 'Editar');
        //                alert('Dados atualizados');
        //            }                                                                
        //        }, "json"); 
        //        });
    });
</script>
<div id="form_cadastro" style="">
    <form id="form_descritivo_exercicio" class="form_cadastro" method="post" action="ajax/crud_exercicio.php?acao=atualizar_descritivo" enctype="multipart/form-data">
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
            <div id="div_atualizar_exercicio" style="display:none;" >
                <input name="btn_atualizar_exercicio" id="btn_atualizar_exercicio" class="button" type="submit" value="Atualizar"/>    
            </div>
            <div id="div_id_exercicio" style="display:none;" >
                <input name="id_exercicio" id="id_exercicio" type="text" value="<?php echo $this->exercicio->getId_exercicio(); ?>"/>    
            </div>
            <div id="div_id_modulo" style="display:none;" >
                <input name="id_modulo" id="id_modulo" type="text" value="<?php echo $this->exercicio->getId_modulo(); ?>"/>    
            </div>
            <div id="div_editar_exercicio">
                <input type="button" name="btn_editar_exercicio" id="btn_editar_exercicio" value="Editar"/>
            </div>
        </fieldset>
    </form>

    <div class="accord_body">
        <h4>
            <a>Adicionar nova pergunta</a>
        </h4>
    </div>
    <div class="accord_content_body" style="display: none">

        <form id="form_cadastrar" name="form_cadastrar" method="post" action="ajax/crud_conteudo_modulo.php?acao=inserir_pergunta">
            <fieldset style="width:640px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Nova Pergunta</legend>
                <div>

                    <fieldset style="width:30px; float:left; padding:0 5px 5px 5px; margin: 0 2.5px">
                        <legend>Nº:</legend>
                        <input type="text" id="numeracao" name="numeracao" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 30px"/>
                    </fieldset>
                    <fieldset style="width:410px; float:left; padding:0 5px 5px 5px; margin: 0 2.5px;">
                        <legend>Enunciado:</legend>
                        <textarea placeholder="Enunciado da Pergunta" id="enunciado" name="enunciado" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width:410px;"></textarea>
                    </fieldset>
                </div>
                <div>
                    <fieldset style="width:145px; float: left; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                        <legend>Opção Correta</legend>
                        <div style="font-size:12px; border: 0">
                            <input type="radio" name="correta" value="0" style="border:0"/> Alternativa 1
                        </div>
                        <div style="font-size:12px; border: 0">
                            <input type="radio" name="correta" value="1"/> Alternativa 2
                        </div>
                        <div style="font-size:12px; border: 0">
                            <input type="radio" name="correta" value="2"/> Alternativa 3
                        </div>
                        <div style="font-size:12px; border: 0">
                            <input type="radio" name="correta" value="3"/> Alternativa 4
                        </div>
                    </fieldset>
                    <fieldset style="width:300px; float:left; padding:0 5px 5px 5px; margin:0 2.5px; clear:left;">
                        <legend>Respostas</legend>
                        <div style="padding:0; margin:0">
                            <textarea placeholder="Resposta 1" id="resposta_0" name="resposta_0" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px"></textarea>
                        </div>
                        <div>
                            <textarea placeholder="Resposta 2" id="resposta_1" name="resposta_1" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px"></textarea>
                        </div>
                        <div>
                            <textarea placeholder="Resposta 3" id="resposta_2" name="resposta_2" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px"></textarea>
                        </div>
                        <div>
                            <textarea placeholder="Resposta 4" id="resposta_3" name="resposta_3" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px"></textarea>
                        </div>
                    </fieldset >  
                    <fieldset style="width:300px; float: left; padding:0 5px 5px 5px; margin:0 2.5px">
                        <legend>Justificativas</legend>
                        <div>
                            <textarea placeholder="Justificativa 1" id="justificativa_0" name="justificativa_0" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width: 300px; "></textarea>
                        </div>
                        <div>
                            <textarea placeholder="Justificativa 2" id="justificativa_1" name="justificativa_1" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width: 300px"></textarea>
                        </div>
                        <div>
                            <textarea placeholder="Justificativa 3" id="justificativa_2" name="justificativa_2" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width: 300px"></textarea>
                        </div>
                        <div>
                            <textarea placeholder="Justificativa 4"id="justificativa_3" name="justificativa_3" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width: 300px"></textarea>
                        </div>
                    </fieldset>
                    <input type="submit" id="btn_add" class="btn_add" name="btn_add" value="Adicionar" class="button"/>
                </div>
            </fieldset>

        </form>
    </div>
</div>