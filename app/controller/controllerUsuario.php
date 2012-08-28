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
    private $end;
    private $controller;

    public function validarLoginCadastro($login) {
        $user = $this->getUsuario("login='" . $login . "'");
        if ($user != null) {
            return 0;
        }else
            return 1;
    }
    
    /*    
     * @param $user: objeto usuario
     * @param $end1: objeto endereco
     * 
     * @return Mensagem de erro caso a insersao via parametros falhe por objetos nulos
     */

    public function inserirNovoUsuario_post() {
        //setando o objeto usuario e endereco via post
        $this->setUsuario_post();
        //inserindo os objetos         
//        echo $this->usuario->getEmail();die();
        $this->novoUsuario($this->usuario, $this->end);
        //verifico se existe foto para ser inserida
        if(isset($_FILES["foto"])){
            //captura a id do usuario inserido
            $this->usuario = $this->getUsuario("email='" . $this->usuario->getEmail() . "'");
            $id_usuario = $this->usuario->getId_usuario();
            //insere foto do usuario
            $this->inserirFotoUsuario($id_usuario);            
        }
        
    }

    /*
     * Insere um novo Usuario no BD.
     * Captura os dados do usuario via POST ou através dos paramtros    
     */
    public function setUsuario_post() {
        if (!empty($_POST)) {            
            $this->usuario = new Usuario();
            $this->end = new Endereco();
            foreach ($_POST as $k => $v) {
                $v = utf8_decode($v);
                if (stristr($k, '_')) {
                    $chave_endereco = explode('_', $k);
                    if ($chave_endereco[0] != 'endereco') {
                        $setAtributo = 'set' . ucfirst($k);
                        if (method_exists($this->usuario, $setAtributo)) {
                            $this->usuario->$setAtributo($v);
                        }
                    } else {
                        $setAtributo = 'set' . ucfirst($chave_endereco[1]);
                        if (method_exists($this->end, $setAtributo)) {
                            $this->end->$setAtributo($v);
                        }
                    }
                } else {
                    $setAtributo = 'set' . ucfirst($k);
                    if (method_exists($this->usuario, $setAtributo)) {
                        $this->usuario->$setAtributo($v);
                    }
                }
            }            
            if (!isset($_POST["id_papel"])) {
                $this->usuario->setId_papel(4);
            }
        }
            
    }

    /*
     *  Insere nova foto do usuario de id=$id_usuario
     * 
     * @param $id_usuario
     */
    public function inserirFotoUsuario($id_usuario){
        if (isset($_FILES["foto"])) {
            if ($_FILES["foto"]["name"] != '') {
                $foto = $_FILES["foto"];
                $tipos = array("image/jpg");
                $pasta_dir = "img/profile/";
                if (!in_array($foto['type'], $tipos)) {
                    $foto_nome = $pasta_dir . $id_usuario . ".jpg";
                    move_uploaded_file($foto["tmp_name"], $foto_nome);
                    $foto_arquivo = "img/profile/" . $id_usuario . ".jpg";
                    $foto_arquivo_pic = "img/profile/pic/" . $id_usuario . ".jpg";
                    list($altura, $largura) = getimagesize($foto_arquivo);
                    if ($altura > 120 && $largura > 100) {
                        $img = wiImage::load($foto_arquivo);
                        $img = $img->resize(150, 170, 'outside');
                        $img = $img->crop('50% - 50', '50% - 40', 100, 120);
                        $img->saveToFile($foto_arquivo);
                    }
                    copy($foto_arquivo, $foto_arquivo_pic);
                    $img = wiImage::load($foto_arquivo_pic);
                    $img = $img->resize(35, 42, 'outside');
                    $img->saveToFile($foto_arquivo_pic);
                }
            }
        }
        
    }

    /*
     * @param $user - objeto do tipo Usuario
     * @param $end - objeto do tipo Endereco
     * 
     * @return String - msg de erro
     */
    public function novoUsuario(Usuario $user = null, Endereco $end = null) {
        if ($user != null && $end != null) {
            $dao = new UsuarioDAO();
            $dao->insert($user, $end);
        } else {
            return 'ERRO: funcao novoUsuario - [controllerUsuario]';
        }
    }

    /*
     * Insere novo usuario a partir da página inicial do sistema: index.php     
     */   

    public function atualizarUsuario_admin($id_usuario) {
        if (!empty($_POST)) {
            $this->usuario = $this->getUsuario("id_usuario=" . $id_usuario);
            $this->end = $this->getEndereco_usuario($id_usuario);
            foreach ($_POST as $k => $v) {
                if (stristr($k, '_')) {
                    $chave_endereco = explode('_', $k);
                    if ($chave_endereco[0] != 'endereco') {
                        $setAtributo = 'set' . ucfirst($k);
                        if (method_exists($this->usuario, $setAtributo)) {
                            $this->usuario->$setAtributo($v);
                        }
                    } else {
                        $setAtributo = 'set' . ucfirst($chave_endereco[1]);
                        if (method_exists($this->end, $setAtributo)) {
                            $this->end->$setAtributo($v);
                        }
                    }
                } else {
                    if ($k != 'senha' || ($k == 'senha' && $v != '')) {
                        $setAtributo = 'set' . ucfirst($k);
                        if (method_exists($this->usuario, $setAtributo)) {
                            $this->usuario->$setAtributo($v);
                        }
                    }
                }
            }

            //atualiza usuario
            $this->atualizarUsuario($this->user, $this->end);

            //Inserção da foto
            if (isset($_FILES["foto"])) {
                if ($_FILES["foto"]["name"] != '') {
                    $foto = $_FILES["foto"];
                    $tipos = array("image/jpg");
                    $pasta_dir = "img/profile/";
                    if (!in_array($foto['type'], $tipos)) {
                        $foto_nome = $pasta_dir . $id_usuario . ".jpg";
                        move_uploaded_file($foto["tmp_name"], $foto_nome);
                        $foto_arquivo = "img/profile/" . $id_usuario . ".jpg";
                        $foto_arquivo_pic = "img/profile/pic/" . $id_usuario . ".jpg";
                        list($altura, $largura) = getimagesize($foto_arquivo);
                        if ($altura > 120 && $largura > 100) {
                            $img = wiImage::load($foto_arquivo);
                            $img = $img->resize(150, 170, 'outside');
                            $img = $img->crop('50% - 50', '50% - 40', 100, 120);
                            $img->saveToFile($foto_arquivo);
                        }
                        copy($foto_arquivo, $foto_arquivo_pic);
                        $img = wiImage::load($foto_arquivo_pic);
                        $img = $img->resize(35, 42, 'outside');
                        $img->saveToFile($foto_arquivo_pic);
                    }
                }
            }
        }
    }

    public function atualizarUsuario(Usuario $user = null, Endereco $end = null) {
        //atualiza usuario
        if ($user != null) {
            $dao = new UsuarioDAO();
            if ($end != null) {
                $dao->update($this->usuario, $this->end);
            } else {
                $dao->update($this->usuario);
            }
        } else {
            return 'ERRO: funcao novoUsuario - [controllerUsuario]';
        }
    }

    public function getUsuario($condicao) {
        $dao = new UsuarioDAO();
        $user = $dao->select($condicao);
        return $user[0];
    }

    public function getEndereco_usuario($id_usuario) {
        $this->controller = new controllerEndereco();
        return $this->controller->getEndereco("id_usuario=" . $id_usuario);
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

    public function removerUsuario(Usuario $user) {
        $dao = new EnderecoDAO();
        $affectedrows = $dao->deleteEnderecoUsuario($user->getId_usuario());
        if ($affectedrows > 0) {
            $dao = new UsuarioDAO();
            $affectedrows = $dao->delete($user);
            if ($affectedrows >= 1) {
                return 1;
            }else
                return 0;
        }else {
            return 3;
        }
    }

    /*
     * FIM FUNÇOES CRUD
     * 
     * FUNÇOES DE MANIPULAÇÃO (criação html com objeto usuario)
     * 
     */

    public function tabelaUsuarios() {
        $tabela = "<table id='tabela_usuarios' width='100%' align='center'>
         <thead> 
                <tr> 
                    <th>Nome</th> 
                    <th>Permissão</th> 
                    <th>Atuação</th> 
                    <th></th> 
                    <th></th> 
                    <th></th> 
                </tr> 
            </thead> 
            <tbody>";
        $tabela = $tabela;
        $usuarioDAO = new UsuarioDAO();
        $papelDAO = new PapelDAO();
        $this->usuarios = $usuarioDAO->select(null);
        $quant = count($this->usuarios);
        $i = 0;
        for (; $i < $quant; $i++) {            
            $tabela .= "<tr id=tabela_linha" . $this->usuarios[$i]->getId_usuario() . ">";
            $tabela .= "<td width='55%' id='nome_completo'>" . $this->usuarios[$i]->getNome_completo() . "</td>";
            $papel = $papelDAO->select("id_papel=" . $this->usuarios[$i]->getId_papel());
            $tabela .= "<td width='15%' id='permissao' align='center'>" . $papel[0]->getPapel() . "</td>";
            $tabela .= "<td width='15%' id='atuacao' align='center'>" . $this->usuarios[$i]->getAtuacao() . "</td>";
            $tabela .= "<td width='5%' id='b_visualizar' align='center'>
                <input type='button' title='Visualizar dados do Usuário' id='b_vis-" . $this->usuarios[$i]->getId_usuario() . "' value='' onclick='visualizarUsuario(this.id);' class='botaoVisualizar' /> </td>";
            $tabela .= "<td width='5%' id='b_editar' align='center'>
                <input type='button' title='Editar dados do Usuário' id='b_edt-" . $this->usuarios[$i]->getId_usuario() . "' value='' onclick='editarUsuario(this.id);' class='botaoEditar' /> </td>";
            $tabela .= "<td width='5%' id='b_excluir' align='center'>
                <input type='button' title='Excluir Usuário' id='b_exc-" . $this->usuarios[$i]->getId_usuario() . "' value='' onclick='removerUsuario(this.id);' class='botaoExcluir' /> </td>";
            $tabela .= "</tr>";
        }
        $tabela .= "</tbody></table>";
        return $tabela;
    }

}
?>

