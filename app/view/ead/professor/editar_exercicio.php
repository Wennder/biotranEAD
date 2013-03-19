<script src="js/jquery.boxvalidate.js" type="text/javascript"></script>

<script>    
    $(document).ready(function(){                  
//        $('#form_cadastrar_pergunta').validate({
//            rules:{
//                numeracao: {
//                    required: true,
//                    number: true
//                },
//                enunciado: {
//                    required: true
//                },
//                eh_correta: {
//                    required: true
//                },                
//                resposta_0: {
//                    required: true
//                },
//                justificativa_0: {
//                    required: true
//                },                
//                resposta_1: {
//                    required: true
//                },
//                justificativa_1: {
//                    required: true
//                },                
//                resposta_2: {
//                    required: true
//                },
//                justificativa_2: {
//                    required: true
//                },                
//                resposta_3: {
//                    required: true
//                },
//                justificativa_3: {
//                    required: true
//                }
//            }
//        });
        
        $('#btn_editar_exercicio').click(function(){
            if($(this).attr('value') == 'Editar'){
                $('#titulo_exercicio').removeAttr('readonly');
                $('#descricao_exercicio').removeAttr('readonly');
                $('#div_atualizar_exercicio').attr('style', 'display:inline;');
                $(this).attr('value', 'Cancelar');
            }else{
                $('#titulo_exercicio').attr('readonly', 'true');
                $('#descricao_exercicio').attr('readonly', 'true');
                $('#div_atualizar_exercicio').attr('style', 'display:none;');
                $(this).attr('value', 'Editar');
            }
            
        });
        
        $("#btn_finalizar").click(function(){
            $(dialog).dialog('destroy');
            $(dialog).find('div').remove();
        });
    });
    
    function apenas_numero(e){
        var tecla=(window.event)?event.keyCode:e.which;   
        if((tecla>47 && tecla<58)) return true;
        else{
            if (tecla==8 || tecla==0) return true;
            else  return false;
        }
    }
    
</script>
<div>
    <div style="display:none;">                
        <input type="text" name="id" id="id" value="<?php echo $this->exercicio->getId_exercicio(); ?>"/>            
    </div>
    <div id="form_cadastro">
        <form id="form_descritivo_exercicio" name="form_descritivo" class="form_cadastro" method="post" action="ajax/crud_exercicio.php?acao=atualizar_descritivo" enctype="multipart/form-data">
            <div style="border-bottom:1px solid #eeeeee; width: 923px;">
                <center><label style="font-weight: bold; font-size: 14px;">Editar Exercício</label></center>
            </div><br>
            <fieldset style="width:905px;">
                <legend>Dados</legend>
                <table style="width: 100%;">
                    <tr>
                        <td width="90">
                            <label>Título:</label>
                        </td>
                        <td>
                            <input type="text" readonly="true" id="titulo_exercicio" name="titulo_exercicio" value="<?php echo $this->exercicio->getTitulo(); ?>" class="text-input" style="width: 410px"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Descrição:</label>
                        </td>
                        <td>
                            <textarea id="descricao_exercicio" readonly="true" name="descricao_exercicio" rows="3" cols="54" class="text-area" maxlength="100"><?php echo $this->exercicio->getDescricao(); ?></textarea>
                        </td>
                    </tr>
                </table><br>
                <input type="button" name="btn_editar_exercicio" id="btn_editar_exercicio" value="Editar" class="button2"/>
                <div id="div_atualizar_exercicio" style="display:none;" >
                    <input name="form_descritivo_exercicio" id="btn_atualizar_exercicio" class="button2" type="submit" value="Atualizar"/>    
                </div>
                <div style="display:none;">
                    <input name="id_exercicio" id="id_exercicio" type="text" value="<?php echo $this->exercicio->getId_exercicio(); ?>"/>    
                    <input name="id_modulo" id="id_modulo" type="text" value="<?php echo $this->exercicio->getId_modulo(); ?>"/>
                </div>
            </fieldset>
        </form>        
    </div><br>
    <div id="lista_perguntas" style="width: 925px;">
        <div id="menu_accordion">
            <div id="div_cadastrar_pergunta" class="accord_body">
                <div class='accord_list'>
                    <label id="a_cadastrar_pergunta" class="accord_label">Cadastrar nova questão</label>
                </div>
            </div>
            <div id="div_cadastrar_pergunta_body" class="accord_content_body" style="display:none;">
                <div style="margin: 0 0 0 5px;">
                    <form id="form_cadastrar_pergunta" name="form_cadastrar_pergunta" class="validate formulario" method="post" action="ajax/crud_exercicio.php?acao=inserir_pergunta" enctype="multipart/form-data"><br>
                        <fieldset style="width:893px;">
                            <legend>Nova Questão</legend>
                            <table>
                                <tr>
                                    <td>
                                        <label>Nº </label><input type="text" id="numeracao" name="numeracao" class="required text-input" onkeypress='return apenas_numero(event);' style="width: 30px;"/>
                                    </td>
                                    <td>
                                        <textarea placeholder="Enunciado da Questão" id="enunciado" name="enunciado" class="required text-area" style="height: 34px; width: 650px;"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Imagem: </label>
                                    </td>
                                    <td>
                                        <input type="file" id="imagem" name="imagem" class="text-input"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <progress id="progress" value="0" max="100"></progress><span id="porcentagem">0%</span>                        
                                    </td>
                                </tr>  
                                <tr>
                                    <td colspan="2">
                                        <div style="margin-top: 30px;">
                                            <label>Respostas:</label>
                                            <table style="width: 100%;">
                                                                                            Alternativa 1 
                                                <tr>
                                                    <td>
                                                        <input class="required" type="radio" id="radio_correta" name="eh_correta" value="0" style="margin: 5px 0 0 15px;"/>
                                                    </td>
                                                    <td>
                                                        <textarea placeholder="Alternativa 1" id="resposta_0" name="resposta_0" class="required text-area" style="height: 34px; width: 650px; margin: 5px 0 0 26px;"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <textarea placeholder="Justificativa da alternativa 1" id="justificativa_0" name="justificativa_0" class="required text-area" style="height: 34px; width: 650px; margin: 5px 0 0 26px;"></textarea>
                                                    </td>
                                                </tr>
                                                                                            Alternativa 2 
                                                <tr>
                                                    <td>
                                                        <input type="radio" name="eh_correta" id="radio_correta" value="1" style="margin: 5px 0 0 15px;"/>
                                                    </td>
                                                    <td>
                                                        <textarea placeholder="Alternativa 2" id="resposta_1" name="resposta_1" class="required text-area" style="height: 34px; width: 650px; margin: 5px 0 0 26px;"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <textarea placeholder="Justificativa da alternativa 2" id="justificativa_1" name="justificativa_1" class="required text-area" style="height: 34px; width: 650px; margin: 5px 0 0 26px;"></textarea>
                                                    </td>
                                                </tr>
                                                                                            Alternativa 3 
                                                <tr>
                                                    <td>
                                                        <input type="radio" name="eh_correta" value="2" id="radio_correta" style="margin: 5px 0 0 15px;"/>
                                                    </td>
                                                    <td>
                                                        <textarea placeholder="Alternativa 3" id="resposta_2" name="resposta_2" class="required text-area" style="height: 34px; width: 650px; margin: 5px 0 0 26px;"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <textarea placeholder="Justificativa da alternativa 3" id="justificativa_2" name="justificativa_2" class="required text-area" style="height: 34px; width: 650px; margin: 5px 0 0 26px;"></textarea>
                                                    </td>
                                                </tr>
                                                                                            Alternativa 4 
                                                <tr>
                                                    <td>
                                                        <input type="radio" name="eh_correta" value="3" id="radio_correta" style="margin: 5px 0 0 15px;"/>
                                                    </td>
                                                    <td>
                                                        <textarea placeholder="Alternativa 4" id="resposta_3" name="resposta_3" class="required text-area" style="height: 34px; width: 650px; margin: 5px 0 0 26px;"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <textarea placeholder="Justificativa da alternativa 4" id="justificativa_3" name="justificativa_3" class="required text-area" style="height: 34px; width: 650px; margin: 5px 0 0 26px;"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div> 
                                    </td>
                                </tr>
                            </table><br>
                            <input type="submit" id="btn_add_pergunta" name="form_cadastrar" value="Adicionar Questão" class="button2"/><br>
                        </fieldset>
                        <div style="display:none;">                
                            <input type="text" name="id_exercicio" id="id_exercicio" value="<?php echo $this->exercicio->getId_exercicio(); ?>"/>                
                        </div>
                    </form>
                </div>
            </div>
            <?php echo ($this->listaPerguntas); ?>
        </div>
    </div><br><br>
    <input type="button" id="btn_finalizar" name="btn_finalizar" value="Finalizar" class="button2"/><br>
</div>