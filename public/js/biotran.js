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
                $(this).ajaxSubmit(optionsFormAtualizarDescritivo());
                break;
            case 'form_cadastrar_pergunta':
                $(this).ajaxSubmit(optionsFormCadastrarPergunta());
                break;
            case 'deletar':
                $(this).ajaxSubmit(optionsFormAtualizarPergunta());
                break;
            case 'form_cadastrar':
                break;
            default://atualizar pergunta
                $(this).ajaxSubmit(optionsFormAtualizarPergunta());
                break;
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
                dialog = $('#dialog').dialog({
                    draggable: false,
                    resizable: false,
                    show: { effect: 'drop', direction: "up"},
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
                
//    $(".btn_resolver_exe").live('click', function(){                        
//        var btn = $(this);
//        $('#dialog').load(btn.attr('id'), function(response, status, xhr) {
//            if (status == "error") {
//                alert('erro');
//                var msg = "Sorry but there was an error: ";
//                $("#error").html(msg + xhr.status + " " + xhr.statusText);
//            }else{                                                                                    
//                dialog = $('#dialog').dialog({
//                    width:800, 
//                    height:600,
//                    dialogClass:'dialogstyle', 
//                    modal:true,                        
//                    close: function(event,ui){                     
//                        $(dialog).dialog('destroy');
//                        $(dialog).find('div').remove();
//                    }                                        
//                });
//            }
//        });
//    });
                
//    $("#cancelar_questionario").live('click', function(){                        
//        dialog.dialog('close');
//    });
//                
//    $("#submeter_questionario").live('click', function(){
//        var r = confirm('Tem certeza? Uma vez submetido não podera mais voltar atrás');
//        if(r){
//            var qnt = $('#total_perguntas').val();
//            var i;
//            var respostas = '';
//            var id_questoes = '';
//            var j;
//            var id_exercicio = $('#id_exercicio').val();
//            for(i = 0; i < qnt; i++){
//                j = i+1;
//                respostas += $('input[name= "resposta_'+i+'"]:checked').val()+';';
//                id_questoes += $('#id_pergunta_'+i).val()+';';
//            }
//            $.getJSON('ajax/submeterQuestionario.php', {
//                respostas: respostas, 
//                id_perguntas:id_questoes
//            }, 
//            function(j){
//                if(j == 1){
//                    alert('Questionário submetido com sucesso!');
//                    $('input[name="exercicio_'+id_exercicio+'"]').attr('disabled', 'true');
//                    $('input[name="exercicio_'+id_exercicio+'"]').removeAttr('id');
//                    $('input[name="exercicio_'+id_exercicio+'"]').attr('value', 'Exercicio já submetido');
//                    dialog.dialog('close');
//                }else{
//                    alert('Erro ao submeter questionário, tente novamente!');
//                }
//            });                        
//        }
//    });
                
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
                    show: { effect: 'drop', direction: "up"},
                    width: width, 
                    height: height,
                    dialogClass:'dialogstyle',
                    modal: true,
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
                
    $(".link_video").live('click',function() {
        var tag = $(this);
        if(tag.attr('name') == 'video'){                                                    
            $('#dialog_video').load(tag.attr('id'), function (){
                console.log(this);
                var options = {
                    width:700, 
                    height:400,
                    dialogClass:'dialogstyle',
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
         
    //Se clicar no link, redireciona
    //    $(".accord h3").click(function() {
    //        location = ($(this).attr('id'));
    //    });
});

            
//function resize_content_fluid(){
//    var height = $('.content').height();
//              
//    if(height < $(window).height()){
//        height+=75;
//        height +='px';
//        $(".content_fluid").css('height',height);
//    }              
//}

function insereLinha(data, tipo){ 
    if($('#center_content').find('div').attr('id') == 'div_conteudo_professor_editar_modulo'){                                        
        var id_modulo = $('#id_modulo').val();
        var id_curso = $('#id_curso').val();        
        data = data.split('-');
        data[0] = data[0].replace('"', '');
        data[1] = data[1].replace('"', '');        
        var excluir = '<input id="'+data[0]+'" name="'+tipo+'" type="button" class="btn_del" value="Excluir" style="float: right;"/>';
        if(tipo == 'video'){
            var editar = '<input id="'+data[0]+'" name="'+tipo+'" type="button" class="btn_edt" value="Editar" style="float: right;"/>';
            var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><label name="'+tipo+'" id="index.php?c=ead&a=janela_video&id='+data[0]+'">'+data[1]+'</label>' + excluir + editar + '</li>';
        }else{            
            if(tipo == 'exercicio'){
                var editar = '<input id="index.php?c=ead&a=editar_exercicio&id='+data[0]+'" name="'+tipo+'" type="button" class="btn_edt" value="Editar" style="float: right;">';
                var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><label name="'+tipo+'" id="'+data[1]+'">'+data[1]+'</label>' + excluir + editar + '</li>';
            }else{
                var _HTML = '<li class="conteudo_row" id=li_'+tipo+'_'+data[0]+'><label><a target="_blank" name="'+tipo+'" href="cursos/'+id_curso+'/modulos/'+id_modulo+'/'+tipo+'/'+data[0]+'.pdf">'+data[1].toString() + '</a></label>' + excluir + '</li>';
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
        data: {
            id_exercicio: $('#id').val()
        },
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
        
