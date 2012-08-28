function editarCurso(id){
    id = id.substr(6,6);
    $(location).attr('href', 'index.php?c=ead&a=gerenciar_cursos&id='+id+'');
}
    
function visualizarCurso(id){
    id = id.substr(6,6);
    $(location).attr('href', 'index.php?c=index&a=exibir_curso&id='+id+'');
}
    
function removerCurso(id){
    id = id.substr(6,6);
    $.getJSON('ajax/removerCurso.php?search=',{
        id_curso: id,       
        ajax: 'true'
    }, function(j){
        //usuario excluido         
        if(j == 1){
            alert('Curso excluído com sucesso.');            
            $('#tabela_linha'+id).detach();
        }else{
            //usuario nao pode ser excluido devido à restrições de chave estrangeira
            if(j == 3){
                alert('Endereço não exlcuido!');    // <-- ?          
            }else{
                alert('Curso não pode ser excluído!');                                
            }
        }
    });            
    
}
