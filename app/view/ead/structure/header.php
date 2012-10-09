<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <title>EAD Biotran</title>
        <link href="css/jquery-ui-1.8.24.custom.css" rel="stylesheet" type="text/css"/>   
        <script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <link href="css/jquery.dialog.css" rel="stylesheet" type="text/css"/>        
        <script src="js/jquery.js"></script> 
        <script type="text/javascript" src="js/jquery.form.js"></script>
        <!--        <script src="js/accordion.js" type="text/javascript"></script>-->
        <link href="css/video-js.css" rel="stylesheet" type="text/css"/>        
        <script src="js/video.js"></script>                
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/menuDropDown.js" type="text/javascript"></script>                        
        <script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>
<!--        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> -->
        <style>
            @import "http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css";
        </style>
        <script type="text/javascript">
            //            _V_.options.flash.swf = "video-js.swf";
            var centro = 1;
            var dialog;
            
            function resize_content_fluid(){
                var height = $('.content').height();
              
                if(height < $(window).height()){
                    height+=75;
                    height +='px';
                    $(".content_fluid").css('height',height);
                }              
            }
            
            function insereLinha(data, tipo){                                  
                if($('#center_content').find('div').attr('id') == 'div_conteudo_professor_editar_modulo'){                                        
                    var id_modulo = $('#id_modulo').val();
                    var id_curso = $('#id_curso').val();        
                    data = data.split('-');
                    data[0] = data[0].replace('"', '');
                    data[1] = data[1].replace('"', '');        
                    var excluir = '<input id="'+data[0]+'" name="'+tipo+'" type="button" class="btn_del" value="Excluir"/>';
                    if(tipo == 'video'){
                        var editar = '<input id="'+data[0]+'" name="'+tipo+'" type="button" class="btn_edt" value="Editar"/>';
                        var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><h3 class="item_conteudo titulo_video" name="'+tipo+'" id="index.php?c=ead&a=janela_video&id='+data[0]+'">'+data[1] + '</h3>' + editar + excluir + '</li>';
                    }else{            
                        if(tipo == 'exercicio'){
                            var editar = '<input name="'+tipo+'" type="button" id="index.php?c=ead&a=editar_exercicio&id='+data[0]+'" class="btn_edt" value="Editar"/>';
                            var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><h3 class="item_conteudo titulo_exercicio" name="'+tipo+'" id="">'+data[1] + '</h3>' + editar + excluir + '</li>';                            
                        }else{                            
                            var _HTML = '<li id=li_'+tipo+'_'+data[0]+'><a name="'+tipo+'" href="cursos/'+id_curso+'/modulos/'+id_modulo+'/'+tipo+'/'+data[0]+'.pdf">'+data[1].toString() + '</a>' + excluir + '</li>';                            
                        }
                    }
                    tipo = '#lista_'+tipo;   
                    $(tipo.toString()).append($(_HTML));                                
                }
            }                        
            $(document).ready(function(){                
                document.onClick = comprimir();                 
                $(".btn_add").live('click', function(){        
                    var btn = $(this);
                    var tipo = btn.attr('name').split('-');
                    if(tipo[0] != 'h3'){
                        var div = '#div_conteudo_'+btn.attr('name');
                        var gif = '<img id="ajax_loader" src="img/gif/ajax-loader.gif" />';
                        $(div.toString()).append($(gif));
                        tipo = tipo[0];
                        alert(tipo);
                    }else{
                        tipo = tipo[1];                        
                    }                    
                    $('#dialog').load(btn.attr('id'), function(response, status, xhr) {
                        if (status == "error") {
                            alert('erro');
                            var msg = "Sorry but there was an error: ";
                            $("#error").html(msg + xhr.status + " " + xhr.statusText);
                        }else{
                            $('#ajax_loader').remove();
                            var width = 0;var height = 0; var title;
                            if(tipo == 'video'){
                                width = 800; height = 350; title = 'Adicionar Video Aula';
                            }else{
                                if(tipo == 'texto_referencia'){
                                    width = 500; height = 250; title = 'Adicionar Texto de Referencia';
                                }else{
                                    if(tipo == 'material_complementar'){
                                        width = 500; height = 200; title = 'Adicionar Material Complementar';
                                    }else{//novo exercício
                                        width = 700; height = 300; title = 'Adicionar Exercicio';
                                    }
                                }
                            }                                            
                            dialog = $('#dialog').dialog({width:width, height:height,dialogClass:'dialogstyle',modal: true,
                                focus: function(event,ui){                                                
                                    $('#form_cadastrar').ajaxForm({                                                    
                                        uploadProgress: function(event, position, total, percentComplete) {
                                            $('progress').attr('value',percentComplete);
                                            $('#porcentagem').html(percentComplete+'%');
                                        },                            
                                        success: function(data) {                             
                                            $('progress').attr('value','100');
                                            $('#porcentagem').html('100%');
                                            $('pre').html(data);
                                            if(data != 0){                                                                                                                    
                                                insereLinha(data, tipo);
                                                alert('Arquivo inserido!');
                                                $(dialog).dialog('close');
                                            }                       
                                        }                    
                                    });                    
                                },
                                close: function(event,ui){                     
                                    $(dialog).dialog('destroy');
                                    $(dialog).find('div').remove();
                                }                                        
                            });
                        }
                    });           
                });
                
                $(".btn_del").live('click', function(){            
                    var btn = $(this);
                    var r = confirm('Tem certeza de que deseja excluir este registro?');                    
                    if(r == true){                  
                        var id = btn.attr('id');                
                        $.getJSON('ajax/crud_conteudo_modulo.php?acao=remover_'+btn.attr('name'),{
                            id: id,
                            ajax: 'true'
                        }, function(j){
                            //usuario excluido  
                            if(j > 0){
                                id = '#li_'+btn.attr('name')+'_'+id;                        
                                $(id.toString()).remove();
                            }
                        }); 
                    }
                });
            });
        </script>

        <link rel='stylesheet' href='css/estilos.css' />

        <style>
            #page-content{
                padding:20px;
            }
        </style>
    </head>
    <body>
        <div id="dialog" style="display:none">
        </div>
        <div id="main">
            <div class="eadbiotran_topbar">
                <div class="eadbiotran_navbar_container">
                    <ul>
                        <li>
                            <div id="pic_holder">
                                <img src="img/profile/pic/<?php
$this->usuario = $_SESSION['usuarioLogado'];
if ($this->usuario == null) {
    echo '00.jpg';
} else if (file_exists('img/profile/' . $this->usuario->getId_usuario() . '.jpg')) {
    echo $this->usuario->getId_usuario() . '.jpg';
} else {
    echo '00.jpg';
}
?>"  />
                            </div>
                        </li>
                        <li style="margin-top:15px;">
                            <h2 >
                                <?php echo $_SESSION["usuarioLogado"]->getNome_completo(); ?>
                            </h2>
                        </li>
                        <li style="margin: 0px 7px; margin-top:15px;">
                            -
                        </li>
                        <li style="margin-top:15px;">
                            <h3>
                                <?php
                                $papel = $_SESSION["usuarioLogado"]->getId_papel();
                                if ($papel == 1) {
                                    echo 'administrador';
                                } else if ($papel == 2) {
                                    echo 'gestor';
                                } else if ($papel == 3) {
                                    if ($_SESSION["usuarioLogado"]->getSexo() == 'Masculino') {
                                        echo 'professor';
                                    } else {
                                        echo 'professora';
                                    }
                                } else if ($papel == 4) {
                                    echo 'aluno';
                                }
                                ?>
                            </h3>
                        </li>
                        <li style="float:right;clear:right; margin:0px 15px; margin-top:15px;">
                            <img src="img/settings.png" id="settings" onclick="expandir('#menuDrop')" />

                        </li>
                        <li style="float:right; margin-top:15px;">
                            <h2>EAD Biotran</h2>
                        </li>
                        <div id="menuDrop"
                             onmouseover="zerarCronometro()" 
                             onmouseout="iniciarCronometro()">
                            <ul >
                                <li>
                                    <a  href="index.php?c=ead&a=profile&id=<?php echo $_SESSION["usuarioLogado"]->getId_usuario(); ?>">Perfil</a>

                                </li>
                                <li>

                                    <a href="index.php?c=seguranca&a=logout">Logout</a>
                                </li>

                            </ul>
                        </div>
                    </ul>              
                </div>
            </div> 
            <div class="content_fluid">
