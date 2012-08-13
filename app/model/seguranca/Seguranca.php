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
        $buscaUsuario = $this->usuarioDao->select(null, "login=" . $login);
        if($buscaUsuario != 'erro'){
            $buscaUsuario->fetch();
            //cria nova instancia de usuario
            $this->user = new Usuario();
            $this->user->setId_usuario($buscaUsuario["id_usuario"]);
            $this->user->setSenha($buscaUsuario["senha"]);
            $this->user->setNome($buscaUsuario["nome"]);
            $this->user->setEmail($buscaUsuario["email"]);
            $this->user->setTel($buscaUsuario["tel"]);
            
            //consulta papel do usuario cadastrado
            $buscaPapel = $this->papelDao->select(null, "id_papel=" . $buscaUsuario["id_papel"])->fetch();
            //cria nova instancia de papel do usuario
            $papel = new Papel();
            $papel->setId_papel($buscaPapel["id_papel"]);
            $papel->setPapel($buscaPapel["papel"]);
            //seta papel do usuario em $this->user
            $this->user->setPapel($papel);
            return true;
        }else{//usuario nao cadastrado no banco de dados
            return false;
        }
    }

    public function validarLogin($login, $senha) {
        //se usuario existe então ele vai ser setado no objeto $this->user;
        if($this->setUsuario($login)){
            //verifica a validade da senha
            if ($this->user->getSenha() == md5($senha)) {
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
