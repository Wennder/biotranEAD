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
    }

    #div_conteudo_professor_editar_curso h4{
        margin:0;
        font-size: 10px;
        padding:0;
    }

    #disposicao_conteudo_professor_editar_curso{
        position: relative;
        padding-right: 20px;

    }


    .quadro_de_conteudo_especifico{
        margin:0px;
        margin-bottom:20px;
        border:1px solid #eeeeee;
        padding: 10px;
        color: #888888;
        overflow: auto;
        width: 100%;
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
        background-color: #eeeeee;
        border:1px solid #CCCCCC;
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

    [readonly = readonly] {
        border:0px;
        border:1px none;
        background-color: #fafafa;
    }

    #image_holder{
        padding:3px;
        border:1px solid #eeeeee;
        float:left;
        margin-right: 10px;
        background-color: white;
        min-height:180px;
        min-width: 240px;
    }



    #titulo_holder{
        position: relative;
        z-index: 2; 
        float:left;
    }
    #div_conteudo_professor_editar_curso *{
        position:relative;
    }

    [type = button]{
        padding: 7px 7px;
        color: #444444;
        background-color: #eeeeee;
        border:1px solid #999999;
        font-weight: 600;
        border-radius: 5px;
    }

    #descricao{
        position: relative;
       width:300px;
    }
</style>

<script>
    $('#btn_editar').click(function(){
        alert($('#id').val());
        $('#descricao').removeAttr('readonly');
        $('#justificativa').removeAttr('readonly');
        $('#objetivo').removeAttr('readonly');
        $('#obs').removeAttr('readonly');
        $('#div_atualizar').removeAttr('style');
    });
    
    $('#btn_atualizar').click(function(){
        $.post('ajax/crud_curso.php?acao=atualizar', $('#form_editar_curso').serialize(), function(json) {
            // handle response
            if(json != false){
                $('#descricao').attr('readonly', 'true');
                $('#justificativa').attr('readonly', 'true');
                $('#objetivo').attr('readonly', 'true');
                $('#obs').attr('readonly', 'true');
                $('#div_atualizar').attr('style', 'display:none;');        
                alert('Dados atualizados');
            }                                                                
        }, "json");                
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
        <div class="quadro_de_conteudo_especifico" style="background-color:#fafafa;">

            <div id="div_editar" align="right">
                <input type="button" id="btn_editar" value="Editar"/>
            </div>

            <div id="image_holder">
                <img src="<?php echo "img/cursos/" . $id_curso . ".jpg" ?>" alt="Imagem do Curso" />    </div>
            <div id="titulo_holder" style="">
                <h1 style=""><?php echo $this->curso->getNome(); ?></h1>
            </div>
            <div style="padding:10px;float:left; clear:right; ">
            <h4>Descricao: </h4>
            <div style="padding:5px;">
                <textarea id="descricao" name="descricao" rows="5" type="text-field" readonly="readonly"><?php echo $this->curso->getDescricao() ?></textarea>
            </div>
            </div>
        </div><div class="quadro_de_conteudo_especifico">
            <h4>Tempo: </h4>
            <input id="input1" type="text" readonly="readonly" value="<?php echo $this->curso->getTempo() ?> Dias"/>

            <h4>Status: </h4>
            <input id="input2" type="text"  readonly="readonly" value="<?php echo $this->curso->getStatus(0) ?>"/>

            <h4>Gratuito: </h4>
            <input id="input3" type="text" readonly="readonly" value="<?php echo $this->curso->getGratuito() ?>"/>

            <h4>Valor: </h4>
            <input id="input4" type="text" readonly="readonly" value="<?php echo $this->curso->getValor() ?>"/>

            <h4>Objetivo: </h4>
            <textarea id="objetivo" name="objetivo" type="text" readonly="readonly"> <?php echo $this->curso->getObjetivo() ?> </textarea>

            <h4>Justificativa: </h4>
            <textarea id="justificativa" name="justificativa" type="text" readonly="readonly"> <?php echo $this->curso->getJustificativa() ?> </textarea>

            <h4>Observacoes: </h4>
            <textarea id="obs" name="obs" type="text" readonly="readonly"> <?php echo $this->curso->getObs() ?> </textarea>

            <div id="div_atualizar" style="display: none">
                <input id="btn_atualizar" type="button" value="Atualizar"/>    
            </div>

            <div id="div_atualizar" align="right" style="display: none; ">
                <input id="id" name="id" type="text" value="<?php echo $this->curso->getId_curso() ?>"/>    
            </div>

        </div>
    </form>
    <div id="lista_de_modulos">
        <ul style="list-style-type:none;">
            <?php
            $controllerModulo = new ControllerModulo();
            echo $controllerModulo->listaModulos($id_curso);
            ?>
        </ul>
    </div>
</div>
