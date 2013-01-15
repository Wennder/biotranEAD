<?php require ROOT_PATH . '/app/view/ead/structure/header.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/leftcolumn_admin.php'; ?>
<?php require ROOT_PATH . '/app/view/ead/structure/content.php'; ?>

<script src="js/crudTabelaCurso.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.js" type="text/javascript"></script>
<script src="js/funcoes_gerenciar_cursos.js" type="text/javascript"></script>
<link href='css/demo_table_jui.css' rel='stylesheet' type="text/css"/>

<div id="div_dialog"></div>

<div id="dialog_form">
    <div id="form_cadastro" style="display: none;">
        <form id="_id_cadastro" class="form_cadastro" method="post" action="index.php?c=ead&a=cadastrar_curso" enctype="multipart/form-data">
            <fieldset style="width: 100%;">
                <legend>Dados do Curso</legend>
                <table>
                    <tr>
                        <td style="width: 150px;">
                            <label class="label_cadastro">*Nome: </label>
                        </td>
                        <td style="width: 600px;">
                            <input type="text" id="_id_nome" name="_id_nome" value="#NOME#" class="text-input" style="width: 440px"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Descrição: </label>
                        </td>
                        <td>
                            <textarea id="_id_descricao" name="_id_descricao" rows="3" cols="50" class="text-area" maxlength="100">#DESCRICAO#</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Tempo de duração (dias): </label>
                        </td>
                        <td>
                            <input type="text" id="_id_tempo" name="_id_tempo" value="#TEMPO#" class="text-input" style="width: 40px" maxlength="3"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Valor: </label>
                        </td>
                        <td>
                            <label class="label_cadastro_legend">R$</label>
                            <input type="text" id="_id_valor" name="_id_valor" value="#VALOR#" class="text-input" style="width: 80px" onkeypress="return apenas_numero(event);" onKeyUp='mascara_moeda(this)'/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Gratuito: </label>
                        </td>
                        <td>
                            <input type="radio" name="gratuito" id="_id_gratuitoSim" value="1">
                            <label class="label_cadastro">Sim </label>
                            <input type="radio" name="gratuito" id="_id_gratuitoNao" value="0" checked>
                            <label class="label_cadastro">Não </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">*Professores do curso: </label>
                        </td>
                        <td>
                            <div class="origem">
                                <select size="5" multiple="multiple" id="_id_origem">   
                                    #OPTIONS_TODOS_PROFESSORES#
                                </select>
                            </div>
                            <div class="botoes">
                                <input type="button" id="_id_add" value="" />
                                <input type="button" id="_id_remover" value="" />
                            </div>
                            <div class="destino">
                                <select id="_id_destino" name="destino[]" multiple="multiple" size="5">                                    
                                    #OPTIONS_PROFESSORES_RESPONSAVEIS#
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Imagem (240x180): </label>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <div id="imagem_curso">
                                            <img id="_id_img_curso" src="img/cursos/#ID_FOTO#.jpg" alt="" height="180" width="240" />
                                        </div>
                                    </td>
                                    <td>
                                        <table style="margin: 112px 0 0 0;">
                                            <tr><td><label class="error" for="imagem" generated="true" style="display: none; position: relative;">Os formatos de imagem aceitos são somente .jpg e .jpeg.</label></td></tr>
                                            <tr><td><input type="file" name="_id_imagem" id="_id_imagem" style="margin: 0 0 0 5px;"/></td></tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="label_cadastro">Assinatura digital (240x180): </label>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <div id="assinatura">
                                            <img id="_id_ass_curso" src="img/cursos/#ID_ASSINATURA#.jpg" alt="" height="180" width="240" />
                                        </div>
                                    </td>
                                    <td>
                                        <table style="margin: 112px 0 0 0;">
                                            <tr><td><label class="error" for="assinatura" generated="true" style="display: none; position: relative;">Os formatos de imagem aceitos são somente .jpg e .jpeg.</label></td></tr>
                                            <tr><td><input type="file" name="_id_assinatura" id="_id_assinatura" style="margin: 0 0 0 5px;"/></td></tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <input type="submit" id="_b_button_cadastrar" name="_b_button_cadastrar" value="Cadastrar" class="button2"/>
            <input type="submit" id="_b_button_atualizar"  name="_b_button_atualizar" value="Atualizar" class="button2" style="display: none;"/>
            <div id="div_hidden" style="display: none;">
                <input type="text" id="_id_id" name="_id_id" value="#ID_CURSO#"/>
            </div>
        </form>
        </br>
    </div>
</div>

<div id="dialog_avaliarCurso">
    <form id="form_avaliarCurso" style="display:none;">
        <div style="border-bottom:1px solid #eeeeee;">
            <center><label><b>Informações do curso</b></label></center>
        </div>
        <div>
            <table>
                <tr>
                    <td>
                        <div id="imagem_curso" style="margin: 15px 15px 15px 5px; width: 240px; height: 180px;">
                            <img id="_id_img_curso" src="img/cursos/#ID_FOTO#.jpg" alt="Imagem do Curso" height="180" width="240" />
                        </div> 
                    </td>
                    <td>
                        <label>#NOME#</label>
                    </td>
                </tr>
            </table>
        </div>
        <div style="padding:5px;">
            <div>
                <label><b>Módulos:</b></label>
            </div>
            <div class="classeBotaoVisualizar">
                <a target="_blank" id="visualizar_modulos" href="index.php?a=visualizar_modulo&c=ead&id=#IDCURSO#" style="margin: 0 0 0 25px;">Visualizar</a>
            </div>
        </div>
        <div style="padding:5px;">
            <div>
                <label><b>Descrição:</b></label>
            </div>
            <textarea id="descricao" name="descricao" rows="3" cols="89" type="text" readonly="readonly" class="text-area">#DESCRICAO#</textarea>
        </div>
        <div style="padding:5px;">
            <div>
                <label><b>Objetivo:</b></label>
            </div>
            <textarea id="objetivo" name="objetivo" rows="3" cols="89" type="text" readonly="readonly" class="text-area">#OBJETIVO#</textarea>
        </div>
        <div style="padding:5px;">
            <div>
                <label><b>Justificativa:</b></label>
            </div>
            <textarea id="justificativa" name="justificativa" rows="3" cols="89" type="text" readonly="readonly" class="text-area">#JUSTIFICATIVA#</textarea>
        </div>
        <div style="padding:5px;">
            <div>
                <label><b>Observações:</b></label>
            </div>
            <textarea id="obs" name="obs" rows="3" cols="89" type="text" readonly="readonly" class="text-area">#OBSERVACOES#</textarea>
        </div>
        <div style="float:left;overflow:auto;">
            <div style="padding:5px;">
                <input id="id_aprovar_curso" type="button" value="Aprovar Curso" class="button2"/>
            </div>
        </div>
        <div style="float:left;overflow:auto;">                        
            <div style="padding:5px;">
                <input id="id_reprovar_curso" type="button" value="Reprovar Curso" class="button2"/>
            </div>
        </div>
    </form>
</div>

<div>
    <div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
        <center><h3 style="margin: 0;">Gerenciar Cursos</h3></center>
        <div id="index_admin">
            <div id="form_gerenciar">    
                <input type="button" value="" id="btn_add" class="classeBotaoAdicionar" style="margin: 0 0 5px 5px;"/> Adicionar
                <input type="button" value="" id="btn_edit"  class="classeBotaoEditar" style="margin: 0 0 5px 10px;"/> Editar
                <input type="button" value="" id="btn_del" class="classeBotaoExcluir" style="margin: 0 0 5px 10px;"/> Remover
                <input type="button" value="" id="btn_analisar" class="classeBotaoVisualizar" style="margin: 0 0 5px 10px;"/> Analisar
                <br>
                <?php echo $this->tabela; ?>
            </div>
        </div>
    </div>
</div>

<?php require ROOT_PATH . '/app/view/ead/structure/footer.php'; ?>
