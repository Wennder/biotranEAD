//$(function() {
//    $( ".accordion_body" ).accordion({
//        active: false,
//        //            animated: 'bounceslice',
//                    clearStyle: true,
//        //            fillSpace: true,
//        autoHeight: false,
//        navigation: true,
//        collapsible: true
//       
//    });
//});
//
//$(function() {
//    $( ".accordion_leftcolumn" ).accordion({
//        active: false,
//        autoHeight: false,
//        navigation: true,
//        collapsible: true
//         
//    });
//});

$(document).ready(function(){
        //On click any <h3> within the container
        $('.accordion_leftcolumn').click(function(e) {

            //Close all <div> but the <div> right after the clicked <a>
            //$(e.target).next('div').siblings('div').slideUp('fast');
            
            //Toggle open/close on the <div> after the <h3>, opening it if not open.
            $(e.target).next('.accordion_leftcolumn_content').Open('fast');
            $(e.target).next('img').css("transform","rotate(90 deg)");
        });
         //On click any <h3> within the container
        $('.accordion_body').click(function(e) {

            //Close all <div> but the <div> right after the clicked <a>
            //$(e.target).next('div').siblings('div').slideUp('fast');
            
            //Toggle open/close on the <div> after the <h3>, opening it if not open.
            $(e.target).next('.accordion_body_content').slideToggle('fast');
            $(e.target).next('img').css("transform","rotate(90 deg)");
        });
    });
