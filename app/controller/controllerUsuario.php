<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerUsuario
 *
 * @author cead-p057007
 */
class controllerUsuario {
    
    private $usuario;

    public function novoUsuario(Usuario $user = null) {
        if (!empty($_POST)) {
            $this->usuario = new Usuario();
            foreach ($_POST as $k => $v) {
                $setAtributo = 'set'.ucfirst($k);
                if(method_exists($this->usuario, $setAtributo)){
                    $this->usuario->$setAtributo($v);                                    
                }
            }
            
        }else{
            if($user != null){
                
            }
        }
    }

}

?>

