<!-- Chang URLs to wherever Video.js files will be hosted -->
<!--<script src="js/video.js"></script>-->
<link href="css/video-js.css" rel="stylesheet" type="text/css"> 


<div id="janela_do_video">
    <script>
        _V_.options.flash.swf = "video-js.swf";        
    </script>
    <fieldset class="text-input" style="width:650px;">
        <legend>Vídeo-aula</legend>
        <table style="width: 100%;">
            
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
            <tr  >
                <td style="border-bottom:1px solid rgb(220,220,220);padding-top: 12px" width="90">
                    <b style="font-size: 22px;">- <?php echo $this->video->getTitulo(); ?> </b>
                </td>
            </tr>
            <tr>
                <td>
                    <textarea style="border:0px;padding:0px 10px;color:rgb(120,120,120);font-size:14px;" readonly="true" id="descricao" name="descricao" rows="3" cols="45" class="text-area" maxlength="100"><?php echo $this->video->getDescricao(); ?></textarea>
                </td>
            </tr>                                    
        </table>        
    </fieldset> 
</div>