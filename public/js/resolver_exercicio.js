var id_exercicio;
var respostas = '';
var id_questoes = '';
var porc_acertos = '';

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
                    width:800, 
                    height:600,
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
                
    $("#cancelar_exercicio").live('click', function(){                        
        dialog.dialog('close');
    });
                
    $("#corrigir_exercicio").live('click', function(){
        var r = confirm('Tem certeza?');
        if(r){
            var qnt = $('#total_perguntas').val();
            var i;
            var j;                                                
            id_exercicio = $('#id_exercicio').val();
            for(i = 0; i < qnt; i++){
                j = i+1;
                respostas += $('input[name= "resposta_'+i+'"]:checked').val()+';';
                id_questoes += $('#id_pergunta_'+i).val()+';';
            }
            $.getJSON('ajax/submeterQuestionario.php?acao=corrigir', {
                respostas: respostas, 
                id_exercicio: id_exercicio, 
                id_perguntas: id_questoes
            }, 
            function(j){
                if(j != 1){                    
                    dialog.dialog('close');
                    dialog = $(j).dialog({
                        width:800, 
                        height:600,
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
            });                        
        }
    });
                
    $("#submeter_exercicio").live('click', function(){
        var r = confirm('Tem certeza? Uma vez submetido não podera mais voltar atrás');
        if(r){
            porc_acertos = $('#porc_acertos').val();
//            var j;
//            var i;
//            var qnt = $('#total_perguntas').val();
//            for(i = 0; i < qnt; i++){
//                j = i+1;
//                respostas += $('input[name= "resposta_'+i+'"]:checked').val()+';';
//                id_questoes += $('#id_pergunta_'+i).val()+';';
//            } 
            alert(id_exercicio);
            $.getJSON('ajax/submeterQuestionario.php?acao=submeter', {
                respostas: respostas, 
                id_exercicio: id_exercicio, 
                porc_acertos: porc_acertos, 
                id_perguntas: id_questoes
            }, 
            function(j){
                if(j == 1){                    
                    $('input[name="exercicio_'+id_exercicio+'"]').attr('disabled', 'true');
                    $('input[name="exercicio_'+id_exercicio+'"]').removeAttr('id');
                    $('input[name="exercicio_'+id_exercicio+'"]').attr('value', 'Exercicio já submetido');
                    dialog.dialog('close');
                }else{
                    if(j == 2){
                        alert('Módulo terminado! Próximo módulo liberado');
                    }else{
                        if(j == 3){
                            alert('Curso finalizado!');
                        }
                    }
                    alert('Erro ao submeter questionário, tente novamente!');
                }
            });                        
        }
    });
});
