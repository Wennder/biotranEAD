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
    var r = confirm('Deseja realmente deletar esse curso?');
    if(r==true){
        $.getJSON('ajax/removerCurso.php?search=',{
            id_curso: id,
            ajax: 'true'
        }, function(j){
            //usuario excluido
            if(j == 1){
                alert('Curso excluído com sucesso.');
                $('#tabela_linha'+id).detach();
            }else{
                //curso nao pode ser excluido devido à restrições de chave estrangeira            
                alert('Curso não pode ser excluído!');                                      
            }
        });            
    }
}
