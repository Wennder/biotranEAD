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

<div id="form_cadastro">
    <form id="form_cadastrar" class="form_cadastro" method="post" action="ajax/crud_conteudo_modulo.php?acao=inserir_video" enctype="multipart/form-data">
        <div style="border-bottom:1px solid #eeeeee; width: 620px;">
            <center><label style="font-weight: bold; font-size: 14px;">Módulo <?php echo $this->modulo->getNumero_modulo(); ?> - Adicionar Vídeo-Aula</label></center>
        </div><br>
        <fieldset style="width:700px;">
            <legend>Dados</legend>
            <table style="width: 100%;">
                <tr>
                    <td width="90">
                        <label>Título da Aula:</label>
                    </td>
                    <td>
                        <input type="text" id="titulo" name="titulo" class="text-input" style="width: 300px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Vídeo:</label>
                    </td>
                    <td>
                        <input type="file" id="video" name="video" class="text-input" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <progress value="0" max="100"></progress><span id="porcentagem">0%</span>
                        <label class="error" for="video" generated="true" style="display: none; position: relative;">Os formatos de vídeo aceitos são somente .mp4.</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Descrição:</label>
                    </td>
                    <td>
                        <textarea id="descricao" name="descricao" rows="3" cols="45" class="text-area" maxlength="100"></textarea>
                    </td>
                </tr>
            </table><br>
            <input type="submit" id="btn_add" name="btn_add" value="Adicionar" class="button2"/>
            <div style="display:none;">
                <input type="text" id="id_modulo" name="id_modulo" value="<?php echo ($this->modulo != null ? $this->modulo->getId_modulo() : '') ?>"/>
            </div>
        </fieldset>
    </form>
    </br>
</div>