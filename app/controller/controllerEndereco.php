<?php

class controllerEndereco {
    
    /*
     * Retorna apenas um endereco de acordo com a condicao da query.
     * Se houver mais de um registro em banco, apenas o primeiro sera retornado
     * 
     * @param $condicao = condicao de busca do tipo String no formato ex.: 'id_endereco_usuario=1'
     * 
     * @return Objeto endereco encontrado, ou o primeiro da lista
     */

    public function getEndereco($condicao) {
        $dao = new EnderecoDAO();
        $end = $dao->select($condicao);
        if($end != null){
            return $end[0];            
        }
        return $end; // null
    }

    /*
     * Retorna uma lista de enderecos de acordo com a condicao da query.
     * condicao de busca do tipo String no formato ex.: 'id_endereco_usuario=1'     
     * 
     * @param string $condicao
     * @return array de objetos endereco_usuario encontrado
     */

    public function getListaEndereco($condicao) {
        $dao = new EnderecoDAO();
        $end = $dao->select($condicao);
        return $end;
    }

    /*
     * Retorna uma lista de todos os usuarios
     *      
     * @return array de objetos com todos os usuarios
     */

    public function getAllEndereco() {
        $dao = new EnderecoDAO();
        $end = $dao->select();
        return $end;
    }
}

?>
