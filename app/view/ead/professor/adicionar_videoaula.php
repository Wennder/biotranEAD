<script>
    $(document).ready(function(){ 
        $('#form_cadastrar').validate({
            rules:{
                titulo: {
                    required: true
                },
                video: {
                    required: true
                },
                descricao: {
                    required: true
                }
            }
        });
    });
</script>

<div id="form_cadastro" style="">
    <form id="form_cadastrar" class="form_cadastro" method="post" action="ajax/crud_conteudo_modulo.php?acao=inserir_video" enctype="multipart/form-data">
        <fieldset style="width:520px; padding:0 1px 1px 1px; margin: 0 0.5px; ">
            <legend>Dados da video-aula</legend>
            <fieldset style="width:500px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Título da aula</legend>
                <input type="text" id="titulo" name="titulo" value="" class="text-input" style="width: 500px"/>
            </fieldset>
            <fieldset style="width:500px; padding:0 5px 5px 5px; margin: 0 2.5px; ">
                <legend>Video</legend>
                <input type="file" id="video" name="video" style="width:500px;" value="" class="text-input" />
                <progress value="0" max="100"></progress><span id="porcentagem">0%</span>
                <label class="error" for="video" generated="true" style="display: none; position: relative;">Os formatos de vídeo aceitos são somente .mp4.</label>
            </fieldset>
            <fieldset style="width:500px; padding:0 5px 5px 5px; margin: 0 2.5px 2.5px 2.5px; ">
                <legend>Descrição</legend>
                <textarea placeholder="Descrição" id="descricao" style="width:500px;" name="descricao" rows="3" class="text-area"maxlength="100"></textarea>
            </fieldset>
            <input type="submit" id="btn_add" name="btn_add" value="Adicionar" class="button2"/>
        </fieldset>

        <div style="display:none;">
            <input type="text" id="id_modulo" name="id_modulo" value="<?php echo ($this->modulo != null ? $this->modulo->getId_modulo() : '') ?>"/>
        </div>
    </form>
    </br></br>
</div>
