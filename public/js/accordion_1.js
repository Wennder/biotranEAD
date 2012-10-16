


$(document).ready(function(){
    //On click any <h3> within the container        
    $('.accord_body').live('click', function(e) {
        $(this).next('.accord_content_body').slideToggle('fast');                  
    });                
    $('.accord_leftcolumn').live('click', function(e) {
        $(this).next('.accord_content_leftcolumn').slideToggle('fast');                  
    });                
});

//$(document).on('click', '.accord_body', function(e){
//    if (e.target == this) {
//        $(this).next('.accord_content_body').slideToggle('fast');
//    }
//});

