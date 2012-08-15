<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of seguranca
 *
 * @author cead-p057007
 */
class Seguranca {

    private $usuarioDao;
    private $user;

    public function iniciarSessao() {
//        session_cache_limiter('private');
//        session_cache_expire(30); 
        session_start();
        $_SESSION["usuarioLogado"] = $this->user;
    }
    
    public function getUsuario(){
        return $this->user;       
    }

    /*
     * busca usuario no banco
     * 
     * @param string login do usuario
     * @return seta user se exister no banco ou notifica se usuario não existir
     */
    public function setUsuario($login) {
        //busca usuario no banco pelo login 
        $this->usuarioDao = new UsuarioDAO();
        $this->user = new Usuario();
        $this->user = $this->usuarioDao->select("login='" . $login."'");  
        if($this->user != null){                        
            $this->user = $this->user[0];
            return true;
        }else{//usuario nao cadastrado no banco de dados
            return false;
        }
    }

    public function validarLogin($login, $senha) {
        //se usuario existe então ele vai ser setado no objeto $this->user;
        if($this->setUsuario($login)){
            //verifica a validade da senha            
            if ($this->user->getSenha() == $senha) {
                $this->iniciarSessao();                
                return 'usuario validado';
            } else {
                return'senha invalida';
            }
        }
        return 'nao cadastrado';
    }        
    
    public function expulsar(){
        unset($_SESSION['usuarioLogado']);
        //envia para página de expulsao
    }

}

?>
