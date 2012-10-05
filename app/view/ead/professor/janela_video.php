<script src="js/jquery-ui-1.8.24.custom.min.js" type="text/javascript"></script>
<!-- Chang URLs to wherever Video.js files will be hosted -->
<!--<link href="css/video-js.css" rel="stylesheet" type="text/css">
 video.js must be in the <head> for older IEs to work. 
<script src="js/video.js"></script>-->

<script>
    _V_.options.flash.swf = "video-js.swf";
  </script>

<div id="janela_do_video">
    <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="264"
           poster="http://video-js.zencoder.com/oceans-clip.png"
           data-setup="{}">
        <source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4' />
        <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
        <source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />
        <track kind="captions" src="captions.vtt" srclang="en" label="English" />
    </video>  
</div>