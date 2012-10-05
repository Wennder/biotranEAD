$(document).ready(function(){
        //On click any <h3> within the container
        $('.accord_body').click(function(e) {

            //Close all <div> but the <div> right after the clicked <a>
            //$(e.target).next('div').siblings('div').slideUp('fast');
            //Toggle open/close on the <div> after the <h3>, opening it if not open.
            $(e.target).next('.accord_content_body').slideToggle('fast');
          
        });
   });


