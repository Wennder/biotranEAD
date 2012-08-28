function editarUsuario(id){
    id = id.substr(6,6);
    $(location).attr('href', 'index.php?c=ead&a=gerenciar_usuarios&id='+id+'');
}
    
function visualizarUsuario(id){
    id = id.substr(6,6);
    $(location).attr('href', 'index.php?c=ead&a=profile&id='+id+'');
}
    
function removerUsuario(id){
    id = id.substr(6,6);
    $.getJSON('ajax/removerUsuario.php?search=',{
        id_usuario: id,       
        ajax: 'true'
    }, function(j){
        //usuario excluido         
        if(j == 1){
            alert('Usuário excluído com sucesso');            
            $('#tabela_linha'+id).detach();
        }else{
            //usuario nao pode ser excluido devido à restrições de chave estrangeira
            if(j == 3){
                alert('Endereço não excluído!');                
            }else{
                alert('Usuário não pode ser excluído!');                                
            }
        }
    });            
    
}

