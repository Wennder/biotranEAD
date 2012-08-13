<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "../app/model/dao/UsuarioDAO.php";
include "../app/model/dao/PapelDAO.php";
/**
 * Description of seguranca
 *
 * @author cead-p057007
 */
class Seguranca {

    private $usuarioDao;
    private $papelDao;
    private $user;

    public function iniciarSessao() {
        session_start();
        $_SESSION["usuarioLogado"] = $this->user;
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
        $this->papelDao = new PapelDAO();        
        $buscaUsuario = $this->usuarioDao->select(null, "login='" . $login."'");        
        //echo $buscaUsuario;die();
        if($buscaUsuario != 'erro'){
            //cria nova instancia de usuario
            $this->user = new Usuario();
            $this->user = $buscaUsuario->fetchObject('Usuario');                        
            //consulta papel do usuario cadastrado
            $id_papel = $this->usuarioDao->select('id_papel', "login='" . $login."'")->fetchColumn();            
            $buscaPapel = $this->papelDao->select(null, "id_papel=" . $id_papel);
            //cria nova instancia de papel do usuario                                    
            //seta papel do usuario em $this->user            
            $this->user->setPapel($buscaPapel->fetchObject('Papel'));                        
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
                $this->iniciarSessao($this->user);
                return 'usuario validado';
            } else {
                return'senha invalida';
            }
        }
        return 'nao cadastrado';
    }
    
    public function tratarExcessoes($excessao){
        if($excessao == 'nao cadastrado'){
            
        }else{
            if($excessao == 'senha invalida'){
                
            }
        }
    }
    
    public function expulsar(){
        unset($_SESSION['usuarioLogado']);
        //envia para página de expulsao
    }       

}

?>
