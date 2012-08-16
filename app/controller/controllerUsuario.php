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

    /*
     * Insere um novo Usuario no BD.
     * Captura os dados do usuario via POST ou através dos paramtros
     *     
     * @param $user: objeto usuario
     * @param $end1: objeto endereco 1 
     * @param $end2: objeto endereco 2 
     * 
     * @return Mensagem de erro caso a insersao via parametros falhe por objetos nulos
     */

    public function novoUsuario(Usuario $user = null, Endereco $end1 = null, Endereco $end2 = null) {
        if (!empty($_POST)) {
            $this->usuario = new Usuario();
            $this->end_comercial = new Endereco();
            $this->end_residencial = new Endereco();  
            foreach ($_POST as $k => $v) {
                if (stristr($k, '_')) {
                    $chave_endereco = explode('_', $k);
                    if ($chave_endereco[1] != 'residencial' && $chave_endereco[1] != 'comercial') {
                        $setAtributo = 'set' . ucfirst($k);
                        if (method_exists($this->usuario, $setAtributo)) {
                            $this->usuario->$setAtributo($v);                            
                        }
                    } else {
                        if ($chave_endereco[0] != 'tel') {
                            $setAtributo = 'set' . ucfirst($chave_endereco[0]);
                            if (method_exists($this->end_comercial, $setAtributo)) {
                                if ($chave_endereco == 'residencial') {
                                    $this->end_residencial->$setAtributo($v);
                                } else {
                                    $this->end_comercial->$setAtributo($v);
                                }                                
                            }
                        } else {
                            $setAtributo = 'set' . ucfirst($k);
                            if (method_exists($this->usuario, $setAtributo)) {
                                $this->usuario->$setAtributo($v);                                
                            }
                        }
                    }
                } else {
                    $setAtributo = 'set' . ucfirst($k);
                    if (method_exists($this->usuario, $setAtributo)) {
                        $this->usuario->$setAtributo($v);                        
                    }
                }
            }            
            $dao = new UsuarioDAO();
            $dao->insert($this->usuario, $this->end_residencial, $this->end_comercial);
        } else {
            if ($user != null && $end1 != null && $end2) {
                $dao->insert($this->usuario, $this->end_residencial, $this->end_comercial);
            } else {
                return 'enderecos ou usuario nao instanciados';
            }
        }
    }

    /*
     * Retorna apenas um usuario de acordo com a condicao da query.
     * Se houver mais de um registro em banco, apenas o primeiro sera retornado
     * 
     * @param $condicao = condicao de busca do tipo String no formato ex.: 'id_usuario=1'
     * 
     * @return Objeto usuario encontrado, ou o primeiro da lista
     */

    public function getUsuario($condicao) {
        $dao = new UsuarioDAO();
        $user = $dao->select($condicao);
        return $user[0];
    }

    /*
     * Retorna uma lista de usuarios de acordo com a condicao da query.
     * condicao de busca do tipo String no formato ex.: 'id_usuario=1'     
     * 
     * @param string $condicao
     * @return array de objetos usuarios encontrado
     */

    public function getListaUsuario($condicao) {
        $dao = new UsuarioDAO();
        $user = $dao->select($condicao);
        return $user;
    }

    /*
     * Retorna uma lista de todos os usuarios
     *      
     * @return array de objetos com todos os usuarios
     */

    public function getAllUsuario() {
        $dao = new UsuarioDAO();
        $user = $dao->select();
        return $user;
    }
    
    public function removerUsuario(Usuario $user){
        
    }

}
?>

