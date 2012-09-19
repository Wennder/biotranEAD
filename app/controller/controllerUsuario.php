<?php

class controllerUsuario {

    private $usuario;
    private $end;
    private $controller;

    public function validarLogin($login, $id_usuario = -1) {
        $user = $this->getUsuario("login='" . $login . "'");
        if ($user != null) {
            if($id_usuario != -1){            
                $user_id = $this->getUsuario("id_usuario=" . $id_usuario);
                if($user_id->getLogin() == $login){
                    return true;
                }
            }
            return false;
        }else
            return true;
    }

    public function validarCpf($cpf_passaporte, $id_usuario) {
        $user = $this->getUsuario("cpf_passaporte='" . $cpf_passaporte . "'");
        if ($user != null) {
            if($id_usuario != -1){            
                $user_id = $this->getUsuario("id_usuario=" . $id_usuario);
                if($user_id->getCpf_passaporte() == $cpf_passaporte){
                    return true;
                }
            }
            return false;
        }else
            return true;
    }

    /*
     * INICIO: FUNÇÕES DE CRUD
     */



    /*
     * Insere novo usuario a partir de um formulario enviado via POST     
     */

    public function inserirNovoUsuario_post() {
        //setando o objeto usuario e endereco via post
        $this->setUsuario_post();
        //inserindo os objetos         
//        echo $this->usuario->getEmail();die();
        $this->novoUsuario($this->usuario, $this->end);
        //verifico se existe foto para ser inserida
        if (isset($_FILES["foto"])) {
            //captura a id do usuario inserido
            $this->usuario = $this->getUsuario("email='" . $this->usuario->getEmail() . "'");
            //insere foto do usuario
            $this->inserirFotoUsuario($this->usuario->getId_usuario());
        }
    }

    /*
     * Atualiza Usuario a partir de um formulário enviado via POST
     */

    public function atualizarUsuario_post($id_usuario) {
        //se usuario já está cadastrado
        $this->usuario = $this->getUsuario("id_usuario=" . $id_usuario);
        $this->end = $this->getEndereco_usuario($id_usuario);
        //captura as informações de usuario via post!
        $this->setUsuario_post();
        //atualiza usuario
        $this->atualizarUsuario($this->usuario, $this->end);
        //atualiza a foto
        $this->inserirFotoUsuario($this->usuario->getId_usuario());
    }

    /*
     * Atualiza Usuario no banco. Faz acesso ao UsuarioDAO
     */

    public function atualizarUsuario(Usuario $user = null, Endereco $end = null) {
        //atualiza usuario
        if ($user != null) {
            $dao = new UsuarioDAO();
            if ($end != null) {

                $dao->update($user, $end);
            } else {
                $dao->update($user);
            }
        } else {
            return 'ERRO: parametros nullos - funcao novoUsuario - [controllerUsuario]';
        }
    }

    /*
     * Captura um único usuario no banco.
     * @param $condicao - condicao a ser concatenada na query
     * 
     * @return Usuario - se restornar uma lista, apenas o primeiro será retornado;
     */

    public function getUsuario($condicao) {
        $dao = new UsuarioDAO();
        $user = $dao->select($condicao);
        if ($user != null) {
            return $user[0];
        }
        return $user;
    }

    /*
     * Retorna o endereço do usuario de id = id_usuario
     * 
     * @return Endereco - objeto endereco
     */

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

    /*
     * Remove permanentemente um usuario do banco de dados
     * 
     * @return int - valor lógico referente ao sucesso da acao.
     */

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

    public function novoUsuario(Usuario $user = null, Endereco $end = null) {
        if ($user != null && $end != null) {
            $dao = new UsuarioDAO();
            //verifica se realmente já não existe o registro
            //prevenir reenvio de formulário
            if ($dao->select("login='" . $user->getLogin() . "'") == null) {
                $dao->insert($user, $end);
            } else {
                trigger_error("1 Reenvio de formulario, usuario ja cadastrado");
            }
        } else {
            return 'ERRO: funcao novoUsuario - [controllerUsuario]';
        }
    }

    public function getListaUsuarioProfessor() {
        $dao = new UsuarioDAO();
        return $dao->select("id_papel = 3 ORDER BY nome_completo");
    }

    /*
     * FIM: FUNÇOES DE CRUD
     * -------
     * INICIO: FUNÇÕES AUXILIARES, DE CONTROLE E CRIAÇÃO DE DOCUMENTAÇÃO HTML    
     */

    /*
     * seta as variaveis locais $this->usuario e $this->end
     * atraves de dados enviados via POST
     * os dados sao carregados e acessados de forma genérica
     */

    public function setUsuario_post() {
        if (!empty($_POST)) {
            if ($this->usuario == null) {
                $this->usuario = new Usuario();
            }
            if ($this->end == null) {
                $this->end = new Endereco();
            }
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
                            if ($k == 'senha') {
                                $this->usuario->$setAtributo(md5($v));
                            } else {
                                $this->usuario->$setAtributo($v);
                            }
                        }
                    } else {
                        if ($k == 'senha') {
                            return "Erro: Senha inválida - setUsuario_post [controllerUsuario]";
                        }
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

    public function inserirFotoUsuario($id_usuario) {
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
     * cria uma datatable em html com os dados do usuario para serem visualizados pelo usuário
     */

    public function tabelaUsuarios() {
        $tabela = "<table id='tabela_usuarios' width='100%' align='center'>
         <thead> 
                <tr> 
                    <th>Nome</th> 
                    <th>Permissão</th> 
                    <th>Atuação</th>            
                    <th>login</th> 
                    <th>data_nascimento</th> 
                    <th>cpf_passaporte</th> 
                    <th>rg</th> 
                    <th>id_profissional</th> 
                    <th>atuacao</th> 
                    <th>descricao_pessoal</th> 
                    <th>sexo</th> 
                    <th>tel_principal</th> 
                    <th>tel_secundario</th> 
                    <th>email</th> 
                </tr> 
            </thead> 
            <tbody>";
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
            
            $tabela .= "<td width='55%' id='login'>" . $this->usuarios[$i]->getLogin() . "</td>";
            $tabela .= "<td width='55%' id='data_nascimento'>" . $this->usuarios[$i]->getData_nascimento() . "</td>";
            $tabela .= "<td width='55%' id='cpf_passaporte'>" . $this->usuarios[$i]->getCpf_passaporte() . "</td>";
            $tabela .= "<td width='55%' id='rg'>" . $this->usuarios[$i]->getRg() . "</td>";
            $tabela .= "<td width='55%' id='id_profissional'>" . $this->usuarios[$i]->getId_profissional() . "</td>";
            $tabela .= "<td width='55%' id='atuacao'>" . $this->usuarios[$i]->getAtuacao() . "</td>";
            $tabela .= "<td width='55%' id='descricao_pessoal'>" . $this->usuarios[$i]->getDescricao_pessoal() . "</td>";
            $tabela .= "<td width='55%' id='sexo'>" . $this->usuarios[$i]->getSexo() . "</td>";
            $tabela .= "<td width='55%' id='tel_principal'>" . $this->usuarios[$i]->getTel_principal() . "</td>";
            $tabela .= "<td width='55%' id='tel_secundario'>" . $this->usuarios[$i]->getTel_secundario() . "</td>";
            $tabela .= "<td width='55%' id='email'>" . $this->usuarios[$i]->getEmail() . "</td>";
            $tabela .= "</tr>";
        }
        $tabela .= "</tbody></table>";
        return $tabela;
    }

    /*
     * ---     
     * FIM FUNÇOES DE MANIPULAÇÃO (criação html com objeto usuario)
     * ---
     */
}
?>

