<?php require 'structure/header.php'; ?>
<?php require 'structure/content_up.php'; ?>

<style>
    #lista_fotos_index{
        list-style: none;
    }

    #lista_fotos_index li{
        float:left;
        padding:2px;
        margin:1px;
        padding-bottom: 0px;
        border: 1px solid #B5B8C8;
        opacity: 0.8;
    }

    #lista_fotos_index li:hover{
        opacity: 1;
        cursor: pointer;
    }

    #close_dialog{
        cursor:pointer;
    }

    #dialog{/*posiciona dialog*/
        position:absolute;
        width:100%;
        z-index: 20;
        display:none;
        top:60px;
        left:0;
    }

    #dialog *{
        margin:0;
        padding:0;
    }

    #dialog_body{
        max-width:700px;
        margin: auto;
        z-index: 4;
        position: relative;
        /*   margin-top:10px;*/
        text-align: center;
        box-shadow: 2px 2px 3px #404040;

    }
    #dialog_header{
        overflow: auto;
        padding: 2px 2px;
        /*    padding-left:30px;*/
        /*    border:1px solid #101010;*/
        /*    background: #343d6c;*/
        /*box-shadow: 0px 2px 2px #404040;*/
        background: #fff;
        z-index: 7;
        /*    margin-bottom: 10px;*/
        /*    border-top-left-radius: 10px;*/
        /*    border-top-right-radius: 10px;*/
    }

    #dialog_header h2{
        color: #404040;
    }

    #dialog_header ul{
        list-style: none;
        overflow:auto;

    }

    #dialog_header ul li{
        display: inline;
        float:left;
    }


    #close_dialog{
        position: absolute;
        z-index: 12;
        top:2px;
        right:2px;
        top:-10px;
        right:-10px;
    }


    #detalhe_dialog{
        height:0px;
        /*    border-bottom: 1px solid #d0d0d0;*/
        background-color: rgb(44, 44, 44);
        background-image: -moz-linear-gradient(center top , #121212, #252525);
        background-image: -webkit-gradient(linear, left top, left bottom, from(#121212), to(#252525));
        background-image: -webkit-linear-gradient(top, #121212, #252525);
        background-image: -ms-linear-gradient(top, #121212, #252525);
        background-image: -o-linear-gradient(top, #121212, #252525);
    }

    #dialog_conteudo{
        background: #f8f8f8;
        padding:2px;
        z-index: 5;
        border-top:1px solid #ccc;
        border-bottom: 1px solid #d0d0d0;
    }

    #seta_esquerda, #seta_direita{
        display:none;
        position:absolute;
        width:20px;
        cursor: pointer;
        height:50px;
        font-size:40px;
        font-weight: bolder;
        color:white;
    }

    #seta_esquerda{
        left:0;
    }

    #seta_direita{
        right:2px;
    }



    #dialog_footer{
        background: #fff;
        /*    border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;*/
        border-top:1px solid #fff;
        z-index: 5;
        min-height:10px;
    }

    #detalhe_bottom{
        position: absolute;
        bottom:-50px;
        right:-50px;
        z-index: 2;
    }

    #detalhe_top{
        position:absolute;
        top:-40px;
        left:-60px;
        z-index:2;
    }

    #modal{
        position:absolute;
        left:0;
        top:0;
        height:100%;
        width:100%;
        background: #707070;
        opacity: 0.5;
        z-index: 10;
        display:none;
    }

</style>

<script>
    
    $(document).ready(function(){
        $('#lista_fotos_index img').live('click',function(){
            var conteudo = "<img id='img_dialog' alt='' src='img/fotos/";
            conteudo+=$(this).attr('id');
            conteudo+=".jpg' />";
            var anterior = $(this).attr('anterior');
            var proximo = $(this).attr('proximo');
            //alert($(this).attr('largura'));
            open_janela('biotranEAD',conteudo,$(this).attr('largura'),anterior,proximo);
        });
    });
    function close_janela($id_dialog, $modal){
        $($id_dialog).hide();
        $($id_dialog).remove();
        $($modal).hide();
        $($modal).remove();
    }

    var janela = '<div id="dialog"><div id="nao_sei">'+
        '<div id="dialog_body">'+
        '<div id="dialog_header"> '+
        '<ul>'+
        '<li>'+
        '<h2 id="titulo_dialog" ></h2>'+
        '</li>'+

        '</ul> '+
        '</div>'+
        //        '<img id="link_dialog_left" src="img/link_dialog.png" alt=""/>'+
    //        '<img id="link_dialog_right" src="img/link_dialog.png" alt=""/>'+
    '<img id="close_dialog" src="img/close_dialog_1.png" alt="X" onclick="close_janela('+"'#dialog','#modal'"+');" />'+
        '<div id="detalhe_dialog">'+
        '</div>'+
        '<div id="dialog_conteudo">'+
        '<div id="seta_esquerda"><</div><div id="seta_direita">></div>'+
    
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>';

    var modal = '<div id="modal" >'+

        '</div>';

    function open_janela(titulo, conteudo,width, anterior, proximo){
        $('body').append($(modal));
        $('#modal').show();
        $('body').append($(janela));
        $('#dialog_body').css({'width': width});
        $('#dialog').show();
        $("#titulo_dialog").append(titulo);
        $("#dialog_conteudo").append(conteudo);
        anterior_proximo(anterior,proximo);
    }

    function anterior_proximo(anterior, proximo){
        if(anterior != null){
            //alert($('#seta_esquerda').attr());
            $('#seta_esquerda').css({'display': 'inline'});
        
            $('#seta_esquerda').click( function(){
                var id = '#lista_fotos_index #';
                id += anterior;
                $('#img_dialog').attr('src', 'img/fotos/'+anterior+'.jpg')
               var anterior2 = $(id).attr('anterior');
               var proximo2 = $(id).attr('proximo');
               anterior_proximo(anterior2, proximo2);
               //alert(anterior2);
              //  var proximo = $(this).attr('proximo');
            });
        }else{
            $('#seta_esquerda').css({'display':'none'});
        }
        if(proximo != null){
            $("#seta_direita").css({'display':'inline'})
            $('#seta_direita').click( function(){
                var id = '#lista_fotos_index #';
                id += proximo;
                $('#img_dialog').attr('src', 'img/fotos/'+proximo+'.jpg');
               var proximo2 = $(id).attr('proximo');
               var anterior2 = $(id).attr('anterior');
               anterior_proximo(anterior2, proximo2 );
               //alert(anterior2);
              //  var proximo = $(this).attr('proximo');
            });
        }else{
            $('#seta_direita').css({'display':'none'});
            
        }
    }

</script>

<ul id="lista_fotos_index">
    <?php $controller = new ControllerSistema();
    echo $controller->listaFotos_index(); ?>
</ul>
<?php // require 'structure/content_down.php'; ?>
<?php require 'structure/footer.php'; ?>