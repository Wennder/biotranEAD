var id_exercicio;
var respostas = '';
var id_questoes = '';
var porc_acertos = '';
var aux = '';

$(document).ready(function(){    
    $(".btn_resolver_exe").live('click', function(){                        
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
    
    $("#refazer_exercicio").live('click',function(){
        dialog.dialog('close');
        $('input[name="exercicio_'+id_exercicio+'"]').click();
    });
    
    $("#finalizar_exercicio").live('click',function(){
        dialog.dialog('close'); 
    });
                
    $("#cancelar_exercicio").live('click', function(){                        
        dialog.dialog('close');
    });
                
    $("#corrigir_exercicio").live('click', function(){
        if(verificaExercicios()){
            var r = confirm('Tem certeza?');
            if(r){
                var qnt = $('#total_perguntas').val();
                var i;
                var j; 
                id_exercicio = $('#id_exercicio').val();
                respostas = '';
                id_questoes = '';
                for(i = 0; i < qnt; i++){
                    j = i+1;
                    respostas += $('input[name= "resposta_'+i+'"]:checked').val()+';';
                    id_questoes += $('#id_pergunta_'+i).val()+';';
                }            
                $.ajax({
                    url:'ajax/submeterQuestionario.php?acao=corrigir', 
                    data: {
                        respostas: respostas, 
                        id_exercicio: id_exercicio, 
                        id_perguntas: id_questoes
                    },
                    dataType: 'json',
                    async: false,
                    success:function(j){                
                        if(j != 1){                    
                            dialog.dialog('close');
                            aux = j.lista;
                            dialog = $(j.estatistica).dialog({
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
                        }else{
                            alert('Erro ao corrigir questionário, tente novamente!');
                        }
                    }
                });
            }
        }
        else{
            alert("Há questões não respondidas.");
        }
    });
                
    $("#submeter_exercicio").live('click', function(){
        var r = confirm('Tem certeza? Uma vez submetido não podera mais voltar atrás');
        if(r){
            porc_acertos = $('#porc_acertos').val();                        
            $.getJSON('ajax/submeterQuestionario.php?acao=submeter', {
                respostas: respostas, 
                id_exercicio: id_exercicio, 
                porc_acertos: porc_acertos, 
                id_perguntas: id_questoes
            }, 
            function(j){
                if(j == 1){                    
                    alert('Exercício submetido');
                }else{
                    if(j == 2){
                        alert('Módulo terminado! Próximo módulo liberado');
                    }else{
                        if(j == 3){
                            alert('Curso finalizado!');
                        }
                    }
                }                
                $('input[name="exercicio_'+id_exercicio+'"]').removeAttr('id');
                $('input[name="exercicio_'+id_exercicio+'"]').attr('id',id_exercicio);
                $('input[name="exercicio_'+id_exercicio+'"]').attr('value', 'Ver resultado');
                $('#submeter_exercicio').remove();
                $('#refazer_exercicio').attr('value', 'Finalizar');                
                $('#refazer_exercicio').attr('id', 'finalizar_exercicio');                
                dialog.find('#div_acertos').after($(aux));
            //                dialog.dialog('close');                    
            });                        
        }
    });
    
    $('.btn_exercicio_resolvido').live('click', function(){        
        var btn = $(this);        
        $('#dialog').load('ajax/submeterQuestionario.php?acao=exercicio_resolvido', {
                id_exercicio: btn.attr('id')
                },function(response, status, xhr) {
            if (status == "error") {
                alert('erro');
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
});

function setarQuestao(numQuestao){
    $(".questaoBody_"+numQuestao).css("color", "green");
}

function verificaExercicios(){
    var aux = true;
    $(".radio").each(function(){
        var numQuestao = $(this).attr("id");
        if(!$(".radioQuestao_"+numQuestao).is(":checked")){
            $(".questaoBody_"+numQuestao).css("color", "red");
            aux = false;
        }
    });
    return aux;
}