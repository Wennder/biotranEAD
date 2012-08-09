<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAOUsuario
 *
 * @author cead-p057007
 */
class UsuarioDAO extends PDOConnectionFactory{
    public $conex = null;
    
    public function UsuarioDAO(){
        $this->conex = $this->getConnection();
    }
    
    public function insert(Usuario $user){
        try{
            $stm = $this->conex->prepare("INSERT INTO usuario ()");
    }catch (PDOException $ex){
        
    }
        
    }
    public function delete();
    public function update();
    public function select();
    
}

?>
