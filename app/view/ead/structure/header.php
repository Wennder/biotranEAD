<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
    <head>        
        <meta http-equiv="Content-Type" content="NO-CACHE; text/html; charset=utf8" />
        <title>EAD Biotran</title>
        <link href="css/video-js.css" rel="stylesheet" type="text/css"/>        
        <script src="js/video.js"></script>                
        <link href="css/jquery-ui-1.8.24.custom.css" rel="stylesheet" type="text/css"/>   
        <script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <script src="js/jquery.js"></script> 
        <script type="text/javascript" src="js/jquery.form.js"></script>
        <script src="js/accordion_1.js" type="text/javascript"></script>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/menuDropDown.js" type="text/javascript"></script>                        
        <script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>
        <script src="js/jquery.validationEngine-pt_BR.js" type="text/javascript"></script>
        <script src="js/jquery.validationEngine.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
        <!--        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> -->
        <style>
            @import "http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css";
        </style>
        <script type="text/javascript">
            //            _V_.options.flash.swf = "video-js.swf";
            var centro = 1;
            var dialog;
            var id_exercicio;
            
            $('#editar_dados_pessoais').live('submit', function(e){
                e.preventDefault();
                $(this).ajaxSubmit({
                    dataType: 'json',
                    success: function(data){
                        if(data == 1){
                            alert('Atualizado com sucesso');
                        }else{
                            alert('Erro ao atualizar');
                        }
                    }
                });
                return false;
            });
            
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
                        var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><h3 class="item_conteudo titulo_video" name="'+tipo+'" id="index.php?c=ead&a=janela_video&id='+data[0]+'">'+data[1] + '</h3>' + excluir + editar + '</li>';
                    }else{            
                        if(tipo == 'exercicio'){
                            var editar = '<input name="'+tipo+'" type="button" id="index.php?c=ead&a=editar_exercicio&id='+data[0]+'" class="btn_edt" value="Editar"/>';
                            var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><h3 class="item_conteudo titulo_exercicio" name="'+tipo+'" id="">'+data[1] + '</h3>' + excluir + editar + '</li>';                            
                        }else{                            
                            var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><h3><a target="_blank" name="'+tipo+'" href="cursos/'+id_curso+'/modulos/'+id_modulo+'/'+tipo+'/'+data[0]+'.pdf">'+data[1].toString() + '</a></h3>' + excluir + '</li>';                            
                        }
                    }
                    tipo = '#lista_'+tipo;   
                    $(tipo.toString()).append($(_HTML));                                
                }
            }              
            function optionsFormCadastrarPergunta(){                
                var options = {
                    dataType: 'json',
                    clearForm:true,
                    data: {id_exercicio: $('#id').val()},
                    success: function(data){
                        if(data != 0 && data != false){                    
                            alert('Inserido com sucesso!');
                            var ant = (data.numeracao - 1); 
                            if(document.getElementById('div_pergunta_'+ant)){                                
                                $('#div_pergunta_body_'+ant.toString()).after($(data.form));                                
                            }else{
                                var controle = 1;
                                var posicao = 0;
                                while(controle < data.numeracao){
                                    if(document.getElementById('div_pergunta_'+controle)){
                                        posicao = controle;
                                    }
                                    controle++;
                                }
                                if(posicao == 0){                                    
                                    $('#div_cadastrar_pergunta_body').after($(data.form));
                                }else{                                                              
                                    $('#div_pergunta_body_'+posicao).after($(data.form));
                                }
                            }                        
                            $('#id_exercicio').val($('#id').val());                            
                            $('#a_cadastrar_pergunta').click();                    
                        }
                    }
                }
                return options;
            }
            function optionsFormAtualizarDescritivo(){
                var options = {            
                    success: function(data){
                        if(data == 1){                    
                            alert('Atualizado com sucesso!');
                            $('#titulo_exercicio').attr('readonly', 'true');
                            $('#descricao_exercicio').attr('readonly', 'true');
                            $('#div_atualizar_exercicio').attr('style', 'display:none;');
                            $('#btn_editar_exercicio').attr('value', 'Editar');
                        }
                    }
                }
                return options;
            }
            function optionsFormAtualizarPergunta(){
                var options = {            
                    success: function(data){
                        if(data == 1){                    
                            alert('Operacao realizada com sucesso!');
                        }
                    }
                }
                return options;
            }
        
            $(document).ready(function(){                
                document.onClick = comprimir();
                $('.btn_del_pergunta').live('click', function(e){
                    var r = confirm('Tem certeza de que deseja excluir este registro?');
                    if(r == true){
                        var id = $(this).attr('id');
                        $.getJSON('ajax/crud_exercicio.php?acao=deletar_pergunta',{
                            id: id,
                            ajax: 'true'
                        }, function(j){
                            //j = numeracao
                            //usuario excluido                      
                            if(j != 0){
                                alert('Removido com sucesso!');
                                $('#div_pergunta_'+j).remove();
                                $('#div_pergunta_body_'+j).remove();
                            }
                        }); 
                    }
                });
                
                $('#dialog form').live('submit',function(e){                 
                    console.log($(this).parent());
                    var name = $(this).attr('id');
                    switch(name){
                        case 'form_descritivo_exercicio':
                            $(this).ajaxSubmit(optionsFormAtualizarDescritivo());break;
                        case 'form_cadastrar_pergunta':
                            $(this).ajaxSubmit(optionsFormCadastrarPergunta());break;
                        case 'deletar':
                            $(this).ajaxSubmit(optionsFormAtualizarPergunta()); break;
                        case 'form_cadastrar': break;
                        default://atualizar pergunta
                            $(this).ajaxSubmit(optionsFormAtualizarPergunta()); break;
                    }                
                    return false;
                });
                
                $(".btn_edt").live('click', function(){                        
                    var btn = $(this);
                    $('#dialog').load(btn.attr('id'), function(response, status, xhr) {
                        if (status == "error") {
                            alert('erro');
                            var msg = "Sorry but there was an error: ";
                            $("#error").html(msg + xhr.status + " " + xhr.statusText);
                        }else{                                                                                    
                            dialog = $('#dialog').dialog({width:800, height:600,dialogClass:'dialogstyle', modal:true,                        
                                close: function(event,ui){                     
                                    $(dialog).dialog('destroy');
                                    $(dialog).find('div').remove();
                                }                                        
                            });
                        }
                    });
                });        
                
                $(".btn_edt").live('click', function(){                        
                    var btn = $(this);
                    $('#dialog').load(btn.attr('id'), function(response, status, xhr) {
                        if (status == "error") {
                            alert('erro');
                            var msg = "Sorry but there was an error: ";
                            $("#error").html(msg + xhr.status + " " + xhr.statusText);
                        }else{                                                                                    
                            dialog = $('#dialog').dialog({width:800, height:600,dialogClass:'dialogstyle', modal:true,                        
                                close: function(event,ui){                     
                                    $(dialog).dialog('destroy');
                                    $(dialog).find('div').remove();
                                }                                        
                            });
                        }
                    });
                });        
                
                $(".btn_resolver_exe").live('click', function(){                        
                    var btn = $(this);
                    $('#dialog').load(btn.attr('id'), function(response, status, xhr) {
                        if (status == "error") {
                            alert('erro');
                            var msg = "Sorry but there was an error: ";
                            $("#error").html(msg + xhr.status + " " + xhr.statusText);
                        }else{                                                                                    
                            dialog = $('#dialog').dialog({width:800, height:600,dialogClass:'dialogstyle', modal:true,                        
                                close: function(event,ui){                     
                                    $(dialog).dialog('destroy');
                                    $(dialog).find('div').remove();
                                }                                        
                            });
                        }
                    });
                });
                
                $("#cancelar_questionario").live('click', function(){                        
                    dialog.dialog('close');
                });
                
                $("#submeter_questionario").live('click', function(){
                    var r = confirm('Tem certeza? Uma vez submetido não podera mais voltar atrás');
                    if(r){
                        var qnt = $('#total_perguntas').val();
                        var i;
                        var respostas = '';
                        var id_questoes = '';
                        var j;
                        var id_exercicio = $('#id_exercicio').val();
                        for(i = 0; i < qnt; i++){
                            j = i+1;
                            respostas += $('input[name= "resposta_'+i+'"]:checked').val()+';';
                            id_questoes += $('#id_pergunta_'+i).val()+';';
                        }
                        $.getJSON('ajax/submeterQuestionario.php', {respostas: respostas, id_perguntas:id_questoes}, 
                        function(j){
                            if(j == 1){
                                alert('Questionário submetido com sucesso!');
                                $('input[name="exercicio_'+id_exercicio+'"]').attr('disabled', 'true');
                                $('input[name="exercicio_'+id_exercicio+'"]').removeAttr('id');
                                $('input[name="exercicio_'+id_exercicio+'"]').attr('value', 'Exercicio já submetido');
                                dialog.dialog('close');
                            }else{
                                alert('Erro ao submeter questionário, tente novamente!');
                            }
                        });                        
                    }
                });
                
                $(".btn_add").live('click', function(){        
                    var btn = $(this);
                    var tipo = btn.attr('name').split('-');
                    if(tipo[0] != 'h3'){
                        var div = '#div_conteudo_'+btn.attr('name');
                        var gif = '<img id="ajax_loader" src="img/gif/ajax-loader.gif" />';
                        $(div.toString()).append($(gif));
                        tipo = tipo[0];                        
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
                                width = 650; height = 450; title = 'Adicionar Video Aula';
                            }else{
                                if(tipo == 'texto_referencia'){
                                    width = 550; height = 340; title = 'Adicionar Texto de Referencia';
                                }else{
                                    if(tipo == 'material_complementar'){
                                        width = 550; height = 340; title = 'Adicionar Material Complementar';
                                    }else{//novo exercício
                                        width = 700; height = 300; title = 'Adicionar Exercicio';
                                    }
                                }
                            }                                            
                            dialog = $('#dialog').dialog({width: width, height: height,dialogClass:'dialogstyle',modal: true,
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
                
                $(".item_conteudo").live('click',function() {
                    var tag = $(this);
                    if(tag.attr('name') == 'video'){                                                    
                        $('#dialog_video').load(tag.attr('id'), function (){
                            alert('passou');
                            var options = {width:700, height:400,dialogClass:'dialogstyle',
                                open: function(event,ui){                                                                                
                                },
                                close: function(event,ui){                     
                                    dialog_video.dialog('destroy');
                                    dialog_video.find('div').remove();
                                }                                     
                            }
                            var dialog_video = $('#dialog_video').dialog(options);
                        }); 
                    }
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

    </head>
    <body>
        <div id="dialog" style="display:none">
        </div>
        <div id="dialog_video" style="display:none">
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
                        <li style="margin-top: 10px;">
                            <h3>
                                <?php echo $_SESSION["usuarioLogado"]->getNome_completo(); ?>
                            </h3>
                            <h3 style="font-size: 13px;">
                                <?php
                                $papel = $_SESSION["usuarioLogado"]->getId_papel();
                                if ($papel == 1) {
                                    echo 'Administrador';
                                } else if ($papel == 2) {
                                    echo 'Gestor';
                                } else if ($papel == 3) {
                                    if ($_SESSION["usuarioLogado"]->getSexo() == 'Masculino') {
                                        echo 'Professor';
                                    } else {
                                        echo 'Professora';
                                    }
                                } else if ($papel == 4) {
                                    echo 'Estudante';
                                }
                                ?>
                            </h3>
                        </li>
                        <li style="float:right;clear:right; margin:15px 15px;">
                            <img src="img/settings.png" id="settings" onclick="expandir('#menuDrop')" />
                        </li>
                        <li style="float:right; margin-top: 20px;">
                            <a href="index.php" style="text-decoration: none;"><h3>EAD Biotran</h3></a>
                        </li>
                        <div id="menuDrop"
                             onmouseover="zerarCronometro()" 
                             onmouseout="iniciarCronometro()">
                            <ul >
                                <li>
                                    <a  href="index.php?c=ead&a=dados_pessoais&id=<?php echo $_SESSION["usuarioLogado"]->getId_usuario(); ?>">Perfil</a>

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
