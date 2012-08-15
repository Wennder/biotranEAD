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
    private $end_residencial;
    private $end_comercial;

    public function novoUsuario(Usuario $user = null) {
        if (!empty($_POST)) {
            $this->usuario = new Usuario();
            $this->end_comercial = new Endereco();
            $this->end_residencial = new Endereco();
            foreach ($_POST as $k => $v) {
                $setAtributo = 'set'.ucfirst($k);
                if(method_exists($this->usuario, $setAtributo)){
                    $this->usuario->$setAtributo($v);                                    
                }else{
                    if(method_exists($this->end_comercial, $method_name)){
                        
                    }
                }
                
            }
            $dao = new UsuarioDAO();
            $dao->insert($user, $end1, $end2);
            
        }else{
            if($user != null){
                
            }
        }
    }

}

?>

