$(document).ready(function(){
        //On click any <h3> within the container
        $('.accord_body').live('click', function(e) {
            
            
            
            //Close all <div> but the <div> right after the clicked <a>
            //$(e.target).next('div').siblings('div').slideUp('fast');
            //Toggle open/close on the <div> after the <h3>, opening it if not open.
            
            
            $(this).next('.accord_content_body').slideToggle('fast');
          
        });
   });

//$(document).on('click', '.accord_body', function(e){
//    if (e.target == this) {
//        $(this).next('.accord_content_body').slideToggle('fast');
//    }
//});

