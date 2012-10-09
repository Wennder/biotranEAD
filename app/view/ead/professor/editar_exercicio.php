<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<script src="js/accordion_1.js" type="text/javascript"></script>

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
    <form id="form_descritivo_exercicio" class="form_cadastro" method="post" action="ajax/crud_exercicio.php?acao=atualizar_descritivo_exercicio" enctype="multipart/form-data">
        <fieldset style="width: 100%;">            
            <legend>Dados do Exercicio</legend>
            <div id="div_editar_exercicio" align="right">
                <input type="button" name="btn_editar_exercicio" id="btn_editar_exercicio" value="Editar"/>
            </div>
            <table>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Nome do Exercicio: </label>
                    </td>
                    <td style="width: 600px;">
                        <input type="text" readonly="true" id="titulo_exercicio" name="titulo_exercicio" value="<?php echo $this->exercicio->getTitulo(); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Descricao (opcional): </label>
                    </td>
                    <td>
                        <textarea id="descricao_exercicio" readonly="true" style="width:500px;" name="descricao_exercicio" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"><?php echo $this->exercicio->getDescricao(); ?></textarea>
                    </td>
                </tr>
                <div id="div_atualizar_exercicio" style="display:none;" >
                    <input name="btn_atualizar_exercicio" id="btn_atualizar_exercicio" class="button" type="submit" value="Atualizar"/>    
                </div>
                <div id="div_id_exercicio" style="display:none;" >
                    <input name="id_exercicio" id="id_exercicio" type="text" value="<?php echo $this->exercicio->getId_exercicio(); ?>"/>    
                </div>
                <div id="div_id_modulo" style="display:none;" >
                    <input name="id_modulo" id="id_modulo" type="text" value="<?php echo $this->exercicio->getId_modulo(); ?>"/>    
                </div>
            </table>
        </fieldset>
    </form>
    <div class="accordion_body">                
        <div class="accord">
            <h4>
                <a>Adicionar nova pergunta</a>
            </h4>
        </div>
        <div class="accord_content" style="display: none;">
            <form id="form_cadastrar" name="form_cadastrar" method="post" action="ajax/crud_exercicio.php?acao=inserir_pergunta">
                <fieldset style="width:100%;">
                    <legend>Nova Pergunta</legend>
                    <table>
                        <tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">Numeração (ordem): </label>
                            </td>
                            <td style="width: 100px;">
                                <input type="text" id="numeracao" name="numeracao" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 80px"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">Enunciado: </label>
                            </td>
                            <td>
                                <textarea id="enunciado" style="width:500px;" name="enunciado" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset style="width:100%;">
                    <legend>Alternativa 1</legend>
                    <table>
                        <tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">Resposta: </label>
                            </td>
                            <td style="width: 600px;">
                                <input type="text" id="resposta-0" name="resposta-0" value="" class="validate[required] text-input" data-prompt-position="centerRight"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">Justificativa: </label>
                            </td>
                            <td>
                                <textarea id="justificativa-0" name="justificativa-0" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:150px;">
                                <input type="radio" name="correta" value="0" />Alternativa Correta<br />
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset style="width:100%;">
                    <legend>Alternativa 2</legend>
                    <table>
                        <tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">Resposta: </label>
                            </td>
                            <td style="width: 600px;">
                                <input type="text" id="resposta-1" name="resposta-1" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">Justificativa: </label>
                            </td>
                            <td>
                                <textarea id="justificativa-1" style="width:500px;" name="justificativa-1" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:150px;">
                                <input type="radio" name="correta" value="1" />Alternativa Correta<br />
                            </td>
                        </tr>
                    </table>
                </fieldset>

                <fieldset style="width:100%;">
                    <legend>Alternativa 3</legend>
                    <table>
                        <tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">Resposta: </label>
                            </td>
                            <td style="width: 600px;">
                                <input type="text" id="resposta-2" name="resposta-2" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">Justificativa: </label>
                            </td>
                            <td>
                                <textarea id="justificativa-2" style="width:500px;" name="justificativa-2" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:150px;">
                                <input type="radio" name="correta" value="2" />Alternativa Correta<br />
                            </td>
                        </tr>
                    </table>
                </fieldset>

                <fieldset style="width:100%;">
                    <legend>Alternativa 4</legend>
                    <table>
                        <tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">Resposta: </label>
                            </td>
                            <td style="width: 600px;">
                                <input type="text" id="resposta-3" name="resposta-3" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                <label class="label_cadastro">Justificativa: </label>
                            </td>
                            <td>
                                <textarea id="justificativa-3" style="width:500px;" name="justificativa-3" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:150px;">
                                <input class="label_cadastro" type="radio" name="correta" value="3" />Alternativa Correta<br />
                            </td>
                        </tr>
                    </table>
                </fieldset>               
                <div id="div_submit_btn">
                    <input type="submit" id="btn_add_exercicio" class="btn_add_exercicio" name="btn_addbtn_add_exercicio" value="Adicionar" class="button"/>
                </div>
                
                <div id="div_id_exercicio" style="display:none;" >
                    <input name="id_exercicio" id="id_exercicio" type="text" value="<?php echo $this->exercicio->getId_exercicio(); ?>"/>    
                </div>
                <div id="div_id_modulo" style="display:none;" >
                    <input name="id_modulo" id="id_modulo" type="text" value="<?php echo $this->exercicio->getId_modulo(); ?>"/>    
                </div>
            </form>                            
        </div>
    </div>
    </br></br>
</div>

