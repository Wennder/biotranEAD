<!--<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>-->
<!-- Chang URLs to wherever Video.js files will be hosted -->
<link href="css/video-js.css" rel="stylesheet" type="text/css"> 
<!--<script src="js/video.js"></script>-->

<script>
    _V_.options.flash.swf = "video-js.swf";
</script>

<div id="janela_do_video">
    <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264"           
           data-setup="{}">
        <source src="<?php echo ($this->caminho); ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
        <source src="<?php echo ($this->caminho); ?>" type='video/webm; codecs="vp8, vorbis"' />
        <source src="<?php echo ($this->caminho); ?>" type='video/ogg; codecs="theora, vorbis"' />
        Video tag not supported. Download the video <a href="movie.webm">here</a>.
<!--        <track kind="captions" src="captions.vtt" srclang="en" label="English" />-->
    </video>  
</div>
