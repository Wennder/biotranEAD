<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<!-- Chang URLs to wherever Video.js files will be hosted -->
<link href="css/video-js.css" rel="stylesheet" type="text/css"> 
<!--<script src="js/video.js"></script>-->

<script>
    _V_.options.flash.swf = "video-js.swf";        
</script>

<div id="janela_do_video">
    <div style="border-bottom:1px solid #eeeeee; width: 620px;">
        <center><label style="font-weight: bold; font-size: 14px;">Módulo <?php echo $this->modulo->getNumero_modulo(); ?> - Editar Vídeo-Aula</label></center>
    </div><br>
    <form id="form_cadastrar" class="form_cadastro" method="post" action="ajax/crud_conteudo_modulo.php?acao=atualizar_video" enctype="multipart/form-data">
        <fieldset class="text-input" style="width:650px;">
            <legend>Dados</legend>
            <table style="width: 100%;">
                <tr>
                    <td width="90">
                        <label>Título da Aula:</label>
                    </td>
                    <td>
                        <input value="<?php echo $this->video->getTitulo(); ?>" type="text" id="titulo" name="titulo" class="text-input" style="width: 300px"/>
                        
                        <input type="submit" id="btn_edt_video" name="btn_edt_video" value="Atualizar" class="button2"/>
                        <input type="button" id="btn_cancel_edt_video" name="btn_cancel_edt_video" value="Fechar" class="button2 fechar_dialog"/>
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
                        <textarea id="descricao" name="descricao" rows="3" cols="45" class="text-area" maxlength="100"><?php echo $this->video->getDescricao(); ?></textarea>
                    </td>
                </tr>            
                <tr>
                    <td colspan="2">
               <label>--- Vídeo atual</label>
                </td>
                </tr>
                <tr>
                    <td colspan="2">                    
                        <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264"           
                               data-setup="{}">
                            <source src="<?php echo ($this->caminho); ?>" type='video/mp4' />
                            <source src="<?php echo ($this->caminho); ?>" type='video/webm' />
                            <source src="<?php echo ($this->caminho); ?>" type='video/ogg' />
                            <track kind="captions" src="captions.vtt" srclang="en" label="English" />
                        </video>  
                    </td>
                </tr>
            </table>        
        </fieldset> 
        <div style="display:none;">
            <input type="text" id="id_video" name="id_video" value="<?php echo ($this->video != null ? $this->video->getId_video() : '') ?>"/>
        </div>
    </form>
</div>