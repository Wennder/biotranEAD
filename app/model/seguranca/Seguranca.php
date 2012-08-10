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
            //cria nova instancia de usuario
            $this->user = new Usuario();
            $this->user->setId_usuario($buscaUsuario["id_usuario"]);
            $this->user->setSenha($buscaUsuario["senha"]);
            $this->user->setNome($buscaUsuario["nome"]);
            $this->user->setEmail($buscaUsuario["email"]);
            $this->user->setTel($buscaUsuario["tel"]);
            
            //consulta papel do usuario cadastrado
            $buscaPapel = $this->papelDao->select(null, "id_papel=" . $buscaUsuario["id_papel"]);
            //cria nova instancia de papel do usuario
            $papel = new Papel();
            $papel->setId_papel($buscaPapel["id_papel"]);
            $papel->setPapel($buscaPapel["papel"]);
            //seta papel do usuario em $this->user
            $this->user->setPapel($papel);            
        }else{//usuario nao cadastrado no banco de dados
            $this->tratarExcessoes('nao cadastrado');
        }
    }

    public function validarLogin($login, $senha) {
        $this->setUsuario($login);
        //verifica a validade da senha
        if ($this->user->getSenha() == md5($senha)) {
            $this->iniciarSessao($this->user);
        }else{
            $this->tratarExcessoes('senha invalida');
        }
    }
    
    public function tratarExcessoes($excessao){
        if($excessao == 'nao cadastrado'){
            
        }else{
            if($excessao == 'senha invalida'){
                
            }
        }
    }

    function protegePaginaLogado() {
        global $_SG;
        if (!isset($_SESSION['idUsuario'])) {
            expulsaVisitante();
        }
    }

    function get_idusuario() {
        return $_SESSION['idUsuario'];
    }

    function getUsuario($login) {
        $conn = new ConnectionDB();
        $sql = "SELECT * FROM usuario WHERE login='" . $login . "'";
        //capturando usuario no banco:
        $busca = mysql_fetch_array($conn->sql_query($sql));
        $usuario = new Usuario($busca["idusuario"], $busca["login"], $busca["senha"], $busca["nome"]);
        //----
        //capturando as permissoes do usuario e armazenando na sessao:
        $_SESSION['permissao'] = Array();
        $sql = "SELECT * FROM usuario_permissao_ferramenta NATURAL JOIN usuario WHERE usuario.idusuario = '" . $usuario->id . "' ORDER BY idferramenta";
        $busca = $conn->sql_query($sql);
        $num_linhas = mysql_num_rows($busca);
        //captura as permissões por ferramenta.
        for ($i = 0; $i < $num_linhas; $i++) {
            $aux[$i] = mysql_fetch_array($busca);
            $_SESSION['permissao'][$i] = $aux[$i]["idpermissao"];
        }
        return $usuario;
    }

    function expulsaVisitante() {
        unset($_SESSION['idUsuario'], $_SESSION['loginUsuario'], $_SESSION['senhaUsuario']);
        header("Location: http://cead.unifal-mg.edu.br/controleCEAD/index.php");
    }

}

?>
