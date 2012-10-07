<script src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.form.js"></script>
<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script>
    $(document).ready(function(){                
        $('#btn_editar_exercicio').click(function(){
            if($(this).attr('value') == 'Editar'){
                $('#titulo').removeAttr('readonly');
                $('#descricao').removeAttr('readonly');
                $('#div_atualizar_exercicio').removeAttr('style');
                $(this).attr('value', 'Cancelar');
            }else{
                $('#titulo').attr('readonly', 'true');
                $('#descricao').attr('readonly', 'true');
                $('#div_atualizar_exercicio').attr('style', 'display:none;');
                $(this).attr('value', 'Editar');
            }
        });
    });
</script>
<div id="form_cadastro" style="">
    <form id="form_descritivo" class="form_cadastro" method="post" action="ajax/crud_conteudo_modulo.php?acao=atualizar_exercicio" enctype="multipart/form-data">
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
                        <input type="text" readonly="true" id="titulo" name="titulo" value="<?php echo $this->exercicio->getTitulo(); ?>" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">
                        <label class="label_cadastro">Descricao (opcional): </label>
                    </td>
                    <td>
                        <textarea id="descricao" readonly="true" style="width:500px;" name="descricao" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"><?php echo $this->exercicio->getDescricao(); ?></textarea>
                    </td>
                </tr>
            </table>
            <div id="div_atualizar_exercicio" >
                <input id="div_atualizar_exercicio" type="submit" value="Atualizar"/>    
            </div>
        </fieldset>
    </form>
    <div class="accordion_body">
        <div class='list_index_admin_gray' style='margin-top:0px;'>
            <a><div class='detalhe'></div>
                <img class='seta_formatacao' src='img/seta_gray.png' />Perguntas
            </a>
        </div>
        <div>
            <ul>
                <li>
                    <div class="accordion_body">
                        <h4>
                            <a>Adicionar nova pergunta</a>
                        </h4>
                        <div>
                            <ul>
                                <li>
                                    <form id="form_cadastrar" name="form_cadastrar" method="post" action="ajax/crud_conteudo_modulo.php?acao=inserir_pergunta">
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
                                                        <input type="text" id="resposta_0" name="resposta_0" value="" class="validate[required] text-input" data-prompt-position="centerRight"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Justificativa: </label>
                                                    </td>
                                                    <td>
                                                        <textarea id="justificativa_0" name="justificativa_0" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
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
                                                        <input type="text" id="resposta_1" name="resposta_1" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Justificativa: </label>
                                                    </td>
                                                    <td>
                                                        <textarea id="justificativa_1" style="width:500px;" name="justificativa_1" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
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
                                                        <input type="text" id="resposta_2" name="resposta_2" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Justificativa: </label>
                                                    </td>
                                                    <td>
                                                        <textarea id="justificativa_2" style="width:500px;" name="justificativa_2" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
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
                                                        <input type="text" id="resposta_3" name="resposta_3" value="" class="validate[required] text-input" data-prompt-position="centerRight" style="width: 500px"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="label_cadastro">Justificativa: </label>
                                                    </td>
                                                    <td>
                                                        <textarea id="justificativa_3" style="width:500px;" name="justificativa_3" rows="3" class="validate[required] text-input" data-prompt-position="centerRight" maxlength="100"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:150px;">
                                                        <input class="label_cadastro" type="radio" name="correta" value="3" />Alternativa Correta<br />
                                                    </td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                        <div id="div_inserir_pergunta" style="display: none">
                                            <input id="btn_inserir_pergunta" type="submit" value="Cadastrar"/>    
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <br>
    <input type="submit" id="btn_add" class="btn_add" name="btn_add" value="Adicionar" class="button"/>   
    </br></br>
</div>

