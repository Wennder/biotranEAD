<style>
    #div_conteudo_professor_editar_curso{
        position: relative;

        padding-top:0px;
    }

    #div_editar{
        float:right;
        position: relative;
        z-index: 20;
    }

    #div_atualizar{
        float:right;
        clear:right;
        position:relative;
        z-index: 20;
    }

    #div_conteudo_professor_editar_curso h4{
        margin:0;
        font-size: 10px;
        padding:0;
    }

    #disposicao_conteudo_professor_editar_curso{
        background: #ffffff;
        /*       
            background: -webkit-gradient(linear, left top, left bottom, from(#fafafa), to(#f0f0f0));
            background: -webkit-linear-gradient(top, #fafafa, #f0f0f0);
            background: -moz-linear-gradient(top, #fafafa, #f0f0f0);
            background: -ms-linear-gradient(top, #fafafa, #f0f0f0);
            background: -o-linear-gradient(top, #fafafa, #f0f0f0);
            background: linear-gradient(top, #fafafa, #f0f0f0);*/
        border: 1px solid #e7e7e7;
        border-top:1px solid #f6f6f6;
        padding: 5px 12px;
        box-shadow: 0px 3px 3px #eeeeee ;
        -moz-box-shadow: 0px 3px 3px #eeeeee ;
        -webkit-box-shadow: 0px 3px 3px #eeeeee ;

    }


    .quadro_de_conteudo_especifico{
        margin:0px;
        margin-bottom:20px;

        padding: 10px;
        color: #888888;
        overflow: auto;

    }

    .quadro_de_conteudo_especifico ul{
        margin:0;
        padding: 0;
    }
    .quadro_de_conteudo_especifico h4{
        margin:0;
        font-size:14px;
        padding: 0;
    }

    .quadro_de_conteudo_especifico ul li{
        list-style: none;
        color: #888888;


        padding:4px;
    }

    .quadro_de_conteudo_especifico ul li:hover{
        border:1px solid black;

    }
    .quadro_de_conteudo_especifico ul li h4{
        float:left; margin-right: 3px;

    }

    .quadro_de_conteudo_especifico ul a:hover,a:active,a:visited{
        text-decoration: none;
        outline: none;

    }

    hr{
        border: 0; 
        height: 0; 
        border-top: 1px solid rgba(0, 0, 0, 0.1); 
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        margin-bottom: 10px;
    }

    #professor_adicionar_modulo{
        padding: 7px 7px;
        color: #888888;
        background-color: #eeeeee;
        border:1px solid #CCCCCC;
    }

    #professor_adicionar_modulo:hover{
        border-color: black;
        text-decoration: none;
    }



    #image_holder{
        padding:3px;
        border:2px solid #7294e0;
        float:left;
        margin-right: 10px;
        background-color: white;
        min-height:180px;
        min-width: 240px;
    }



    #titulo_holder{
        position: relative;
        z-index: 2; 

    }
    #div_conteudo_professor_editar_curso *{
        position:relative;
    }


    #descricao{
        position: relative;

    }

    #nao_editavel{
        overflow:auto;
    }

    #nao_editavel *{

    }


    #form_editaveis_holder{
        margin-right: 20px;
        overflow: auto;
        box-shadow: 3px 0px 2px #eeeeee ;
        -moz-box-shadow: 3px 0px 2px #eeeeee  ;
        -webkit-box-shadow: 3px 0px 2px #eeeeee  ;
    }

    .lista_modulos{
        border-bottom:1px solid #eeeeee;
        border-top:1px solid #fefefe;
        background-color: #fafafa;
        padding: 2px 7px;
        cursor: pointer;
    }

    #img_titulo_descricao{
        overflow: auto;
        border-bottom: 1px solid #EEE;
        padding: 0px 0px 10px 0px;
        margin-right: 15px;
    }

</style>

<script>
    $('#btn_editar').click(function(){
        if($(this).attr('value') == 'Editar'){
            $('#descricao').removeAttr('readonly');
            $('#justificativa').removeAttr('readonly');
            $('#objetivo').removeAttr('readonly');
            $('#obs').removeAttr('readonly');
            $('#div_atualizar').removeAttr('style');
            $(this).attr('value', 'Cancelar');            
        }else{
            $('#descricao').attr('readonly', 'true');
            $('#justificativa').attr('readonly', 'true');
            $('#objetivo').attr('readonly', 'true');
            $('#obs').attr('readonly', 'true');
            $('#div_atualizar').attr('style', 'display:none;');
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
                $('#div_atualizar').attr('style', 'display:none;');
                $('#btn_editar').attr('value', 'Editar');
                alert('Dados atualizados');
            }                                                                
        }, "json");                
    });
    
    $('#btn_env_analise').live('click', function(){
        var id_curso = $('#id').val();
        $.getJSON('ajax/avaliar_curso.php', {id_curso: id_curso, acao:'submeter_analise'}, function(j){
            if(j == 1){
                alert('enviado com sucesso');
                $('#div_env_analise').remove();
            }else{
                alert('erro ao enviar, tente novamente');
            }
        }); 
    });
</script>
<?php
if (isset($_GET['id'])) {
    $id_curso = $_GET['id'];
}
$controller = new controllerCurso();
$this->cursos = $controller->getCurso("id_curso=" . $id_curso);
?>
<div id="disposicao_conteudo_professor_editar_curso">
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
                <h5><?php echo $this->curso->getTempo() ?> <h5/>

                    <h4 style="border-left:3px solid #7f98d0; line-height: 14px;">Status: </h4>
                    <h5><?php echo $this->curso->getStatus(0) ?><h5/>

                        <h4 style="border-left:3px solid #d07f7f; line-height: 14px;">Gratuito: </h4>
                        <h5><?php echo $this->curso->getGratuito() ?></h5>

                        <h4 style="border-left:3px solid #cdd07f; line-height: 14px;margin-right:3px;">Valor: </h4>
                        <h5><?php echo $this->curso->getValor() ?></h5>
                        </div>
                        <?php                        
                        if ($this->curso->getStatus() == 0 || $this->curso->getStatus() == 2) {
                            echo('<div id="div_env_analise"><input type="button" id="btn_env_analise" value="Enviar para análise"/></div>');
                        }
                        ?>            
                        <div id="form_editaveis_holder">
                            <div id="img_titulo_descricao">
                                <div id="image_holder">
                                    <img src="<?php echo "img/cursos/" . $id_curso . ".jpg" ?>" alt="Imagem do Curso" />    </div>
                                <div id="titulo_holder" style="">
                                    <h1 style=""><?php echo $this->curso->getNome(); ?></h1>
                                </div>
                                <div style=" overflow:auto; ">
                                    <h4 style="border-left:3px solid #7f98d0; line-height: 14px;">Descricao: </h4>
                                    <div style="padding:5px;">
                                        <textarea id="descricao" name="descricao" rows="5" type="text" readonly="readonly"><?php echo $this->curso->getDescricao() ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div style="padding:10px;float:left;  ">
                                <div style="clear:left; position:relative; margin-left: 20px;">
                                    <div style="float:left; overflow:auto; clear: left; margin-right:10px;">
                                        <h4 style="border-left:3px solid #7fd08b; line-height: 14px;" >Objetivo: </h4>
                                        <div style="padding:5px;">
                                            <textarea id="objetivo" name="objetivo" rows="5" type="text" readonly="readonly"> <?php echo $this->curso->getObjetivo() ?> </textarea>
                                        </div>
                                    </div>

                                    <div style="float:left; overflow:auto; margin-right:10px;"> 
                                        <h4 style="border-left:3px solid #cdd07f; line-height: 14px;">Justificativa: </h4>
                                        <div style="padding:5px;">
                                            <textarea id="justificativa" rows="5" name="justificativa" type="text" readonly="readonly"> <?php echo $this->curso->getJustificativa() ?> </textarea>
                                        </div>
                                    </div>
                                    <div style="float:left;overflow:auto;">
                                        <h4 style="border-left:3px solid #d07f7f; line-height: 14px; ">Observacoes: </h4>
                                        <div style="padding:5px;">
                                            <textarea id="obs" rows="5" name="obs" type="text" readonly="readonly"> <?php echo $this->curso->getObs() ?> </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                        </div>                      
                        <div id="div_atualizar" align="right" style="display: none; ">
                            <input id="id" name="id" type="text" value="<?php echo $this->curso->getId_curso() ?>"/>    
                        </div>
                        </div>
                        </form>
                        <div name="editar_curso" id="lista_de_modulos">
                            <ul style="list-style-type:none;">
                                <?php
                                $controllerModulo = new controllerModulo();
                                echo $controllerModulo->listaModulos($id_curso);
                                ?>
                            </ul>
                        </div>
                        </div>
