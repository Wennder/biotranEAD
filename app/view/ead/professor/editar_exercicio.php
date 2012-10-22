<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
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
    });        
</script>
<div>
    <div style="display:none;">                
        <input type="text" name="id" id="id" value="<?php echo $this->exercicio->getId_exercicio(); ?>"/>            
    </div>
    <div id="form_cadastro" style="">
        <form id="form_descritivo_exercicio" name="form_descritivo" class="form_submit form_cadastro" method="post" action="ajax/crud_exercicio.php?acao=atualizar_descritivo" enctype="multipart/form-data">
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
                    <input name="form_descritivo_exercicio" id="btn_atualizar_exercicio" class="btn_submit" type="submit" value="Atualizar"/>    
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
            <div style="display:none;">                
                <input type="text" name="id_exercicio" id="id_exercicio" value="<?php echo $this->exercicio->getId_exercicio(); ?>"/>            
            </div>
        </form>        
    </div>
    <div style="padding: 2px 30px;" id="lista_perguntas">
        <div id="div_cadastrar_pergunta" class="accord_body list_conteudo">
            <h4 id="a_cadastrar_pergunta">Cadastrar nova pergunta</h4>
        </div>
        <div id="div_cadastrar_pergunta_body" class="accord_content_body" style="display:none;">
            <form class="form_submit" id="form_cadastrar_pergunta" name="form_cadastrar_pergunta" method="post" action="ajax/crud_exercicio.php?acao=inserir_pergunta">
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
                                <input type="radio" name="eh_correta" value="0" style="border:0"/> Alternativa 1
                            </div>
                            <div style="font-size:12px; border: 0">
                                <input type="radio" name="eh_correta" value="1"/> Alternativa 2
                            </div>
                            <div style="font-size:12px; border: 0">
                                <input type="radio" name="eh_correta" value="2"/> Alternativa 3
                            </div>
                            <div style="font-size:12px; border: 0">
                                <input type="radio" name="eh_correta" value="3"/> Alternativa 4
                            </div>
                        </fieldset>
                        <fieldset style="width:300px; float:left; padding:0 5px 5px 5px; margin:0 2.5px; clear:left;">
                            <legend>Respostas</legend>
                            <div style="padding:0; margin:0">
                                <textarea placeholder="Alternativa 1" id="resposta-0" name="resposta-0" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px"></textarea>
                            </div>
                            <div>
                                <textarea placeholder="Alternativa 2" id="resposta-1" name="resposta-1" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px"></textarea>
                            </div>
                            <div>
                                <textarea placeholder="Alternativa 3" id="resposta-2" name="resposta-2" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px"></textarea>
                            </div>
                            <div>
                                <textarea placeholder="Alternativa 4" id="resposta-3" name="resposta-3" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 300px"></textarea>
                            </div>
                        </fieldset >  
                        <fieldset style="width:300px; float: left; padding:0 5px 5px 5px; margin:0 2.5px">
                            <legend>Justificativas</legend>
                            <div>
                                <textarea placeholder="Justificativa" id="justificativa-0" name="justificativa-0" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width: 300px; "></textarea>
                            </div>
                            <div>
                                <textarea placeholder="Justificativa" id="justificativa-1" name="justificativa-1" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width: 300px"></textarea>
                            </div>
                            <div>
                                <textarea placeholder="Justificativa" id="justificativa-2" name="justificativa-2" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width: 300px"></textarea>
                            </div>
                            <div>
                                <textarea placeholder="Justificativa"id="justificativa-3" name="justificativa-3" rows="2" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100" style="width: 300px"></textarea>
                            </div>
                        </fieldset>
                        <input type="submit" id="btn_add_pergunta" class="btn_submit" name="form_cadastrar" value="Adicionar" class="button"/>

                    </div>
                </fieldset>
                <div style="display:none;">                
                    <input type="text" name="id_exercicio" id="id_exercicio" value="<?php echo $this->exercicio->getId_exercicio(); ?>"/>                
                </div>
            </form>
        </div>

        <?php echo ($this->listaPerguntas); ?>
    </div>
</div>