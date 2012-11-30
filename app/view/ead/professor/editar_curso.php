<?php
if (isset($_GET['id'])) {
    $id_curso = $_GET['id'];
}
$caminho = file_exists("img/cursos/" . $this->curso->getId_curso() . ".jpg") ? "img/cursos/" . $this->curso->getId_curso() . ".jpg" : "img/cursos/00.jpg";
?>

<style>
    .lista_modulos{
        border-bottom:1px solid #eeeeee;
        border-top:1px solid #fefefe;
        background-color: #fafafa;
        padding: 5px;
        cursor: pointer;
    }
</style>

<script>
    $('#btn_editar').click(function(){
        if($(this).attr('value') == 'Editar'){
            $('#descricao').removeAttr('readonly');
            $('#justificativa').removeAttr('readonly');
            $('#objetivo').removeAttr('readonly');
            $('#obs').removeAttr('readonly');
            $('#div_atualizar').css('display', 'inline');
            $(this).attr('value', 'Cancelar');            
        }else{
            $('#descricao').attr('readonly', 'true');
            $('#justificativa').attr('readonly', 'true');
            $('#objetivo').attr('readonly', 'true');
            $('#obs').attr('readonly', 'true');
            $('#div_atualizar').css('display','none');
            $('#btn_editar').attr('value', 'Editar');
        }
    });
    
    $('#btn_atualizar').click(function(){
        $.post('ajax/crud_curso.php?acao=atualizarDescritivo', $('#form_editar_curso').serialize(), function(json) {
            // handle response
            if(json != false){
                $('#descricao').attr('readonly', 'true');
                $('#justificativa').attr('readonly', 'true');
                $('#objetivo').attr('readonly', 'true');
                $('#obs').attr('readonly', 'true');
                $('#div_atualizar').css('display','none');
                $('#btn_editar').attr('value', 'Editar');
                alert('Dados atualizados.');
            }
        }, "json");
    });
    
    $('#btn_env_analise').live('click', function(){
        var id_curso = $('#id').val();
        $.getJSON('ajax/avaliar_curso.php', {id_curso: id_curso, acao:'submeter_analise'}, function(j){
            if(j == 1){
                alert('Enviado com sucesso.');
                $('#div_env_analise').remove();
            }else{
                alert('Erro ao enviar, tente novamente.');
            }
        }); 
    });
</script>


<div style="border-bottom:1px solid #f0f0f0; margin-left:20px">
    <form id="form_editar_curso">
        <div style="border-bottom:1px solid #eeeeee;">
            <center><label><b>Informações do curso</b></label></center>
        </div>
        <div style="float: right; margin: 15px 30px 0 0;">
            <input id="btn_editar" type="button" class="button2" value="Editar"/>
        </div>
        <div id="div_atualizar" style="display: none; float: right; margin: 15px 10px 0 0;">
            <input id="btn_atualizar" type="button" class="button2" value="Atualizar"/>    
        </div>
        <div>
            <table style="width: 100%;">
                <tr>
                    <td rowspan="7" style="width: 262px;">
                        <div id="imagem_curso" style="margin: 15px 15px 15px 5px; width: 240px; height: 180px;">
                            <img id="img_curso" src="<?php echo $caminho ?>" alt="Imagem do Curso" height="180" width="240" />
                        </div> 
                    </td>
                    <td style="height: 15px;"></td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <b>Nome: </b><?php echo $this->curso->getNome(); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <b>Duração: </b><?php echo $this->curso->getTempo(); ?> dias
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <b>Status: </b><?php echo $this->curso->getStatus(0); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <b>Gratuito: </b><?php echo $this->curso->getGratuito(); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>
                            <b>Valor: </b>R$<?php echo $this->curso->getValor(); ?>
                        </label>
                    </td>
                </tr>
                <tr><td style="height: 15px;"></td></tr>
            </table>
            <?php
                if ($this->curso->getStatus() == 0 || $this->curso->getStatus() == 2) {
                    echo('<div id="div_env_analise" style="position: absolute; margin: -120px 0 0 415px;"><input type="button" id="btn_env_analise" class="button1" value="Enviar para análise"/></div>');
                }
                ?>
        </div>
        <div>
            <table>
                <tr>
                    <td>
                        <div style="padding:5px;">
                            <div>
                                <label><b>Descrição:</b></label>
                            </div>
                            <textarea id="descricao" name="descricao" rows="3" cols="40" type="text" readonly="readonly" class="text-area"><?php echo $this->curso->getDescricao() ?></textarea>
                        </div>
                    </td>
                    <td>
                        <div style="padding:5px;">
                            <div>
                                <label><b>Objetivo:</b></label>
                            </div>
                            <textarea id="objetivo" name="objetivo" rows="3" cols="40" type="text" readonly="readonly" class="text-area"><?php echo $this->curso->getObjetivo() ?> </textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="padding:5px;">
                            <div>
                                <label><b>Justificativa:</b></label>
                            </div>
                            <textarea id="justificativa" name="justificativa" rows="3" cols="40" type="text" readonly="readonly" class="text-area"><?php echo $this->curso->getJustificativa() ?></textarea>
                        </div>
                    </td>
                    <td>
                        <div style="padding:5px;">
                            <div>
                                <label><b>Observações:</b></label>
                            </div>
                            <textarea id="obs" name="obs" rows="3" cols="40" type="text" readonly="readonly" class="text-area"><?php echo $this->curso->getObs() ?></textarea>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id="div_atualizar" align="right" style="display: none; ">
            <input id="id" name="id" type="text" value="<?php echo $this->curso->getId_curso() ?>"/>    
        </div>
        <div id="lista_modulos">
            <label style="margin: 5px 0 0 9px; position: absolute;"><b>Módulos:</b></label><br>
            <ul style="list-style-type:none; width: 725px; padding: 10px 0 0 10px; margin-bottom: 20px;">
                <?php
                $controllerModulo = new controllerModulo();
                echo $controllerModulo->listaModulos($id_curso);
                ?>
            </ul>
        </div>
    </form>
</div>













<!--<div id="disposicao_conteudo_professor_editar_curso">
    <form id="form_editar_curso">
        <div class="quadro_de_conteudo_especifico" style="border-bottom:1px solid #eeeeee;">
            <div id="nao_editavel" style="float:right; clear:right; margin-top:10px;margin-left:5px;">
                <div id="div_editar" align="right">
                    <input type="button" id="btn_editar" value="Editar"/>
                </div>
                <div id="div_atualizar" style="display: none;">
                    <input id="btn_atualizar" type="button"  value="Atualizar"/>    
                </div>
                <h4 style="border-left:3px solid #7fd08b; line-height: 14px; clear:right;">Tempo: </h4>
                <h5><?php // echo $this->curso->getTempo()          ?> <h5/>

                    <h4 style="border-left:3px solid #7f98d0; line-height: 14px;">Status: </h4>
                    <h5><?php // echo $this->curso->getStatus(0)          ?><h5/>

                        <h4 style="border-left:3px solid #d07f7f; line-height: 14px;">Gratuito: </h4>
                        <h5><?php // echo $this->curso->getGratuito()          ?></h5>

                        <h4 style="border-left:3px solid #cdd07f; line-height: 14px;margin-right:3px;">Valor: </h4>
                        <h5><?php // echo $this->curso->getValor()          ?></h5>
                        </div>
<?php
//                        if ($this->curso->getStatus() == 0 || $this->curso->getStatus() == 2) {
//                            echo('<div id="div_env_analise"><input type="button" id="btn_env_analise" value="Enviar para análise"/></div>');
//                        }
?>            
                        <div id="form_editaveis_holder">
                            <div id="img_titulo_descricao">
                                <div id="image_holder">
                                    <img src="<?php // echo $caminho          ?>" alt="Imagem do Curso" />    </div>
                                <div id="titulo_holder" style="">
                                    <h1 style=""><?php // echo $this->curso->getNome();          ?></h1>
                                </div>
                                <div style=" overflow:auto; ">
                                    <h4 style="border-left:3px solid #7f98d0; line-height: 14px;">Descricao: </h4>
                                    <div style="padding:5px;">
                                        <textarea id="descricao" name="descricao" rows="5" type="text" readonly="readonly"><?php // echo $this->curso->getDescricao()          ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div style="padding:10px;float:left;  ">
                                <div style="clear:left; position:relative; margin-left: 20px;">
                                    <div style="float:left; overflow:auto; clear: left; margin-right:10px;">
                                        <h4 style="border-left:3px solid #7fd08b; line-height: 14px;" >Objetivo: </h4>
                                        <div style="padding:5px;">
                                            <textarea id="objetivo" name="objetivo" rows="5" type="text" readonly="readonly"> <?php // echo $this->curso->getObjetivo()          ?> </textarea>
                                        </div>
                                    </div>

                                    <div style="float:left; overflow:auto; margin-right:10px;"> 
                                        <h4 style="border-left:3px solid #cdd07f; line-height: 14px;">Justificativa: </h4>
                                        <div style="padding:5px;">
                                            <textarea id="justificativa" rows="5" name="justificativa" type="text" readonly="readonly"> <?php // echo $this->curso->getJustificativa()          ?> </textarea>
                                        </div>
                                    </div>
                                    <div style="float:left;overflow:auto;">
                                        <h4 style="border-left:3px solid #d07f7f; line-height: 14px; ">Observacoes: </h4>
                                        <div style="padding:5px;">
                                            <textarea id="obs" rows="5" name="obs" type="text" readonly="readonly"> <?php // echo $this->curso->getObs()          ?> </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                        </div>                      
                        <div id="div_atualizar" align="right" style="display: none; ">
                            <input id="id" name="id" type="text" value="<?php // echo $this->curso->getId_curso()          ?>"/>    
                        </div>
                        </div>
                        </form>
                        <div name="editar_curso" id="lista_de_modulos">
                                <ul style="list-style-type:none;">
<?php
//        $controllerModulo = new controllerModulo();
//        echo $controllerModulo->listaModulos($id_curso);
?>
                                    </ul>
                            </div>
                            </div>-->