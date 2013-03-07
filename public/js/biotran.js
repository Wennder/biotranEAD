var centro = 1;
var dialog;

// Funções e variáveis Menu DropDown TopMenu -------------------
var item = 0;
var cronometro = 0;
var tempo = 500;

function expandir(id){	
    zerarCronometro();
    if(item) {
        $(item).slideUp();
        item=0;
    }
    else{
        item = $(id);
        $(item).slideDown();
    }
}

function comprimir(){
    if(item){
        $(item).slideUp();
        item=0;
    } 
}

function iniciarCronometro(){
    cronometro = window.setTimeout(comprimir, tempo);
}

function zerarCronometro(){
    if(cronometro){
        window.clearTimeout(cronometro);
        cronometro = null;
    }
}
//---------------------------------------------------

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
                    $('#div_pergunta_'+j).remove();
                    $('#div_pergunta_body_'+j).remove();
                }else{
                    alert('Operação não realizada, tente novamente mais tarde!');
                }
            }); 
        }
    });
                
    $('#dialog form').live('submit',function(e){        
        console.log($(this).parent());
        var name = $(this).attr('id');
        switch(name){
            case 'form_descritivo_exercicio':
                $(this).ajaxSubmit(optionsFormAtualizarDescritivo());
                break;
            case 'form_cadastrar_pergunta':
                $('#btn_add_pergunta').attr('disabled', 'true');
                $(this).ajaxSubmit(optionsFormCadastrarPergunta($(this)));
                break;
            case 'deletar':
                $(this).ajaxSubmit(optionsFormAtualizarPergunta());
                break;
            case 'form_cadastrar':
                break;
            default://atualizar pergunta
                $(this).ajaxSubmit(optionsFormAtualizarPergunta($(this)));
                break;
        }                
        return false;
    });
                
    $(".btn_edt").live('click', function(){
        var btn = $(this);
        $('#dialog').load(btn.attr('id'), function(response, status, xhr) {
            if (status == "error") {
                alert('Em construção');
                var msg = "Sorry but there was an error: ";
                $("#error").html(msg + xhr.status + " " + xhr.statusText);
            }else{                                                                                    
                dialog = $('#dialog').dialog({
                    draggable: false,
                    resizable: false,
                    show: {
                        effect: 'drop', 
                        direction: "up"
                    },
                    width:970, 
                    height:($(window).height() - 40),
                    position: [(($(window).width()-970)/2), 15],
                    dialogClass:'dialogstyle', 
                    modal:true,                        
                    close: function(event,ui){                     
                        $(dialog).dialog('destroy');
                        $(dialog).find('div').remove();
                    }                                        
                });
            }
        });
    });
                
    $(".btn_add").live('click', function(){
        var aux;
        var btn = $(this);
        var tipo = btn.attr('name').split('-');
        var exercicio = btn.attr('name');
        if(tipo[0] != 'h3'){
            var div = '#div_conteudo_'+btn.attr('name');
            var gif = '<img id="ajax_loader" src="img/gif/ajax-loader2.gif" />';
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
                var width = 0;
                var height = 0;
                if(tipo == 'video'){
                    width = 650;
                    height = 360;
                }else{
                    if(tipo == 'texto_referencia'){
                        width = 650;
                        height = 280;
                    }else{
                        if(tipo == 'material_complementar'){
                            width = 650;
                            height = 280;
                        }else{//novo exercício
                            width = 650;
                            height = 290;
                        }
                    }
                }                                            
                dialog = $('#dialog').dialog({
                    draggable: false,
                    resizable: false,
                    position: [(($(window).width()-width)/2), 15],
                    show: {
                        effect: 'drop', 
                        direction: "up"
                    },
                    width: width, 
                    height: height,
                    dialogClass:'dialogstyle',
                    modal: true,
                    focus: function(event,ui){                                                
                        $('#form_cadastrar').ajaxForm({
                            dataType:"json",
                            uploadProgress: function(event, position, total, percentComplete) {
                                $('progress').attr('value',percentComplete);
                                $('#porcentagem').html(percentComplete+'%');
                            },                            
                            success: function(data) {
                                aux = data;
                                $('progress').attr('value','100');
                                $('#porcentagem').html('100%');
                                $('pre').html(data);
                                if(data != 0){
                                    if(exercicio == 'exercicio'){
                                        alert('Exercício inserido!');
                                    }else{
                                        alert('Arquivo inserido!');
                                    }
                                    insereLinha(data, tipo);
                                    $(dialog).dialog('close');
                                }else{
                                    if(exercicio != 'exercicio'){                                        
                                        alert('Atenção! O Formato do arquivo é inválido. Documento de texto apenas em .pdf e vídeo em .mp4.')    
                                    }                                    
                                    
                                }
                            }
                        });
                    },
                    close: function(event,ui){                     
                        $(dialog).dialog('destroy');
                        $(dialog).find('div').remove();                        
                        if(aux != 0){
                            aux = aux.split('-');                            
                            $(".edt"+aux[0]+"").click();
                        }
                    }                                        
                });
            }
        });        
    });      
                
    $(".link_video").live('click',function() {
        var tag = $(this);
        if(tag.attr('name') == 'video'){                                                    
            $('#dialog_video').load(tag.attr('id'), function (){
                var options = {
                    width:700, 
                    height:600,
                    dialogClass:'dialogstyle',
                    focus: function(event, ui){
                        $('#form_cadastrar').ajaxForm({
                            dataType:"json",
                            uploadProgress: function(event, position, total, percentComplete) {
                                $('progress').attr('value',percentComplete);
                                $('#porcentagem').html(percentComplete+'%');
                            },                            
                            success: function(data) {                                
                                $('progress').attr('value','100');
                                $('#porcentagem').html('100%');
                                $('pre').html(data);
                                if(data != 0){
                                    alert('Atualizado com sucesso!');
                                    atualizaLinha(data, 'video');
                                    $(dialog_video).dialog('close');
                                }else{
                                    alert("Atenção, o formato do arquivo de video não é válido. Certifique-se de que a extensão do arquivo é .mp4.")
                                }
                            }
                        });                        
                    },
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
});

function atualizaLinha(data, tipo){
    if($('#center_content').find('div').attr('id') == 'div_conteudo_professor_editar_modulo'){                                        
        var id_modulo = $('#id_modulo').val();
        var id_curso = $('#id_curso').val();        
        data = data.split('-');
        var excluir = '<input id="'+data[0]+'" name="'+tipo+'" type="button" class="btn_del" value="Excluir" style="float: right;"/>';
        if(tipo == 'video'){
            var editar = '<input id="'+data[0]+'" name="'+tipo+'" type="button" class="btn_edt" value="Editar" style="float: right;"/>';
            var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><label class="link_video" name="'+tipo+'" id="index.php?c=ead&a=janela_video&id='+data[0]+'">'+data[1].toString()+'</label>' + excluir + editar + '</li>';
        }else{            
            if(tipo == 'exercicio'){
                var editar = '<input id="index.php?c=ead&a=editar_exercicio&id='+data[0]+'" name="'+tipo+'" type="button" class="btn_edt edt'+data[0]+'" value="Editar" style="float: right;">';
                var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><label name="'+tipo+'" id="'+data[1]+'">'+data[1].toString()+'</label>' + excluir + editar + '</li>';
            }else{
                var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><label><a target="_blank" name="'+tipo+'" href="cursos/'+id_curso+'/modulos/'+id_modulo+'/'+tipo+'/'+data[0]+'.pdf">'+data[1].toString() + '</a></label>' + excluir + '</li>';
            }
        }
        tipo = '#lista_'+tipo;
        $(tipo.toString()).find('#li_video_'+data[0]).remove();
        $(tipo.toString()).append($(_HTML));        
    }
}

function insereLinha(data, tipo){ 
    if($('#center_content').find('div').attr('id') == 'div_conteudo_professor_editar_modulo'){                                        
        var id_modulo = $('#id_modulo').val();
        var id_curso = $('#id_curso').val();        
        data = data.split('-');
        var excluir = '<input id="'+data[0]+'" name="'+tipo+'" type="button" class="btn_del" value="Excluir" style="float: right;"/>';
        if(tipo == 'video'){
            var editar = '<input id="'+data[0]+'" name="'+tipo+'" type="button" class="btn_edt" value="Editar" style="float: right;"/>';
            var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><label class="link_video" name="'+tipo+'" id="index.php?c=ead&a=janela_video&id='+data[0]+'">'+data[1].toString()+'</label>' + excluir + editar + '</li>';
        }else{            
            if(tipo == 'exercicio'){
                var editar = '<input id="index.php?c=ead&a=editar_exercicio&id='+data[0]+'" name="'+tipo+'" type="button" class="btn_edt edt'+data[0]+'" value="Editar" style="float: right;">';
                var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><label name="'+tipo+'" id="'+data[1]+'">'+data[1].toString()+'</label>' + excluir + editar + '</li>';
            }else{
                if(data[2] == '.mp4'){
                    var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><label><a name="'+tipo+'" href="cursos/'+id_curso+'/modulos/'+id_modulo+'/'+tipo+'/'+data[0]+data[2]+'">'+data[1].toString() + '</a></label>' + excluir + '</li>';                    
                }else{
                    var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><label><a target="_blank" name="'+tipo+'" href="cursos/'+id_curso+'/modulos/'+id_modulo+'/'+tipo+'/'+data[0]+data[2]+'">'+data[1].toString() + '</a></label>' + excluir + '</li>';                    
                }
            }
        }
        tipo = '#lista_'+tipo;
        $(tipo.toString()).append($(_HTML));        
    }
}              
function optionsFormCadastrarPergunta(form){                
    var options = {
        dataType: 'json',
        clearForm:true,
        data: {
            id_exercicio: $('#id').val()
        },
        uploadProgress: function(event, position, total, percentComplete) {
            form.find('#progress').attr('value',percentComplete);
            form.find('#porcentagem').html(percentComplete+'%');
        },
        success: function(data){
            if(data != 0 && data != false){                    
                alert('Inserido com sucesso!');
                form.find('#progress').attr('value',0);
                form.find('#porcentagem').html(0+'%');
                $('#btn_add_pergunta').removeAttr('disabled');
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
                $('#form_cadastrar_pergunta #imagem').attr('value', '');
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
function optionsFormAtualizarPergunta(form){
    var options = {
        uploadProgress: function(event, position, total, percentComplete) {
            form.find('#progress').attr('value',percentComplete);
            form.find('#porcentagem').html(percentComplete+'%');
        },
        success: function(data){
            if(data > 0){
                if(data == 2){
                    form.find('#div_imagem img').remove();
                    var id = form.find('#id_pergunta').val();
                    var tag = '<img src="img/perguntas/'+id+'.jpg" />';
                    form.find('#div_imagem').append(tag);
                    form.find('#progress').attr('value',0);
                    form.find('#porcentagem').html(0+'%');
                }
                alert('Atualizado com sucesso!');
            }
        }
    }
    return options;
}
        
