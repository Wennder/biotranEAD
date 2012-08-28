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
        session_start();
        $_SESSION['usuarioLogado'] = $this->user;
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
                return 'validado';
            } else {                
                return'invalidado';
            }
        }
        return 'cadastrar';
    }
    
    public function expulsar(){
        unset($_SESSION['usuarioLogado']);
        //envia para página inicial
        header("Location: http://localhost/biotranEAD/public/index.php");
    }
    
    public function isPapel_pagina($pagina) {        
        $dao = new Papel_paginaDAO();
        $idPapel = $_SESSION['usuarioLogado']->getId_papel();           
        return $dao->select($idPapel, $pagina);
    }
    
    public function validarSessao(){
        if(isset($_SESSION['usuarioLogado'])){
            return 1;
        }return 0;
    }
        

}

?>
