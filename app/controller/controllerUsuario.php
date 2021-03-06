<?php

class controllerUsuario {

    private $usuario;
    private $end;
    private $controller;

    public function validarEmail($login, $id_usuario = -1) {
        $user = $this->getUsuario("login='" . $login . "'");        
        if ($user != null) {            
            if ($id_usuario != -1) {
                $user_id = $this->getUsuario("id_usuario=" . $id_usuario);
                if ($user_id->getLogin() == $login) {
                    return true;
                }
            }
            return 0;
        }else
            return true;
    }

    public function validarCpf_passaporte($cpf_passaporte, $id_usuario) {
        $user = $this->getUsuario("cpf_passaporte='" . $cpf_passaporte . "'");
        if ($user != null) {
            if ($id_usuario != -1) {
                $user_id = $this->getUsuario("id_usuario=" . $id_usuario);
                if ($user_id->getCpf_passaporte() == $cpf_passaporte) {
                    return true;
                }
            }
            return 0;
        }else
            return true;
    }

    /*
     * INICIO: FUNÇÕES DE CRUD
     */



    /*
     * Insere novo usuario a partir de um formulario enviado via POST     
     */

    public function inserirUsuario() {
        //setando o objeto usuario e endereco via post
        $this->setUsuario_post();
        //inserindo os objetos         
        //echo $this->usuario->getEmail();die();        
        $this->usuario->setId_usuario($this->novoUsuario($this->usuario, $this->end));        
        //verifico se existe foto para ser inserida
        if (isset($_FILES["foto"])) {
            //insere foto do usuario
            $this->inserirFotoUsuario($this->usuario->getId_usuario());
        }
        return $this->usuario->getId_usuario();
    }

    /*
     * Atualiza Usuario a partir de um formulário enviado via POST
     */

    public function atualizarUsuario($id_usuario) {
        //se usuario já está cadastrado
        $this->usuario = $this->getUsuario("id_usuario=" . $id_usuario);
        $this->end = $this->getEndereco_usuario($id_usuario);
        //captura as informações de usuario via post!
        $this->setUsuario_post();
        //atualiza usuario
        $this->updateUsuario($this->usuario, $this->end);
        if($this->usuario->getId_usuario() == $_SESSION['usuarioLogado']->getId_usuario()){
            $_SESSION['usuarioLogado'] = $this->usuario;
        }
        //atualiza a foto
        $this->inserirFotoUsuario($this->usuario->getId_usuario());
        return 1;
    }

    public function atualizarSenhaUsuario(Usuario $user) {
        //atualiza usuario
        $this->updateUsuario($user);
        return true;
    }

    /*
     * Atualiza Usuario no banco. Faz acesso ao UsuarioDAO
     */

    public function updateUsuario(Usuario $user = null, Endereco $end = null) {
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

    public function listaAlunos($id_curso) {
        $usuarioDAO = new UsuarioDAO();
        $usuarios = $usuarioDAO->selectAlunosCurso($id_curso);
        $quant = count($usuarios);
        $i = 0;
        $id_foto = "00";
        $listaUsuarios = "";
        for (; $i < $quant; $i++) {
            if (file_exists(ROOT_PATH . '/public/img/profile/pic/' . $usuarios[$i]->getId_usuario() . '.jpg')) {
                $id_foto = $usuarios[$i]->getId_usuario();
            }
            $listaUsuarios .= '<div class="estudante">
                    <a class="profile_aluno" id="' . $usuarios[$i]->getId_usuario() . '" href="#">
                        <table>
                            <tr>
                                <td>
                                    <div style="height: 42px; width: 35px; padding: 4px; background-color: #eee;"><img src="img/profile/pic/' . $id_foto . '.jpg "></div>
                                </td>
                                <td>
                                    <label>' . $usuarios[$i]->getNome_completo() . '</label>
                                </td>
                            </tr>
                        </table>
                    </a>
                </div>';
        }
        return $listaUsuarios;
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

    public function removerUsuario($id_usuario) {
        $user = $this->getUsuario("id_usuario=" . $id_usuario);
        $dao = new EnderecoDAO();
        $affectedrows = $dao->deleteEnderecoUsuario($user->getId_usuario());
        if ($affectedrows > 0) {
            $dao = new UsuarioDAO();
            $affectedrows = $dao->delete($user);
            if ($affectedrows >= 1) {
                $caminho = ROOT_PATH . '/public/img/profile/' . $id_usuario . '.jpg';
                $caminho1 = ROOT_PATH . '/public/img/profile/pic/' . $id_usuario . '.jpg';
                if (is_file($caminho)) {
                    unlink($caminho);
                }
                if (is_file($caminho1)) {
                    unlink($caminho1);
                }
                return 1;
            }else
                return 0;
        }else {
            return 3;
        }
    }

    public function bloquearUsuario($id_usuario) {
        $user = $this->getUsuario("id_usuario=" . $id_usuario);        
        if ($user != null) {
            if ($user->getStatus_acesso()) {
                $user->setStatus_acesso(0);
            } else {
                $user->setStatus_acesso(1);
            }
            $dao = new UsuarioDAO();
            if ($dao->update($user)) {                
                return $user->getStatus_acesso();
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }

    public function novoUsuario(Usuario $user = null, Endereco $end = null) {
        if ($user != null && $end != null) {
            $dao = new UsuarioDAO();
            //echo $user->getCpf_passaporte();
           
            //verifica se realmente já não existe o registro
            //prevenir reenvio de formulário
            if ($dao->select("login='" . $user->getLogin() . "'") == null) {
                return $dao->insert($user, $end);
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
            //echo $k; echo $v;
                
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
        
       // die();
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
                $tipos = array("image/jpg", "image/jpeg");
                $pasta_dir = "../img/profile/";
                if (in_array($foto['type'], $tipos)) {
                    $foto_nome = $pasta_dir . $id_usuario . ".jpg";
                    move_uploaded_file($foto["tmp_name"], $foto_nome);
                    $foto_arquivo = "../img/profile/" . $id_usuario . ".jpg";
                    $foto_arquivo_pic = "../img/profile/pic/" . $id_usuario . ".jpg";
                    list($altura, $largura) = getimagesize($foto_arquivo);
                    if ($altura > 120 && $largura > 100) {
                        if (file_exists($foto_arquivo)) {
                            $img = wiImage::load($foto_arquivo);
                            $img = $img->resize(150, 170, 'outside');
                            $img = $img->crop('50% - 50', '50% - 40', 100, 120);
                            $img->saveToFile($foto_arquivo);
                        }
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
        $tabela = "<table id='tabela_usuarios' width='100%' align='center' class='display'>
         <thead> 
                <tr> 
                    <th>Nome</th>
                    <th>Permissão</th>
                    <th>Atuação</th>
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
                    <th>endereco_rua</th>
                    <th>endereco_numero</th>
                    <th>endereco_complemento</th>
                    <th>endereco_bairro</th>
                    <th>endereco_cidade</th>
                    <th>endereco_pais</th>
                    <th>endereco_estado</th>
                    <th>id</th>
                    <th>Status Acesso</th>
                </tr> 
            </thead> 
            <tbody>";
        $usuarioDAO = new UsuarioDAO();
        $papelDAO = new PapelDAO();
        $this->controller = new controllerEndereco();
        $this->usuarios = $usuarioDAO->select(null);
        $quant = count($this->usuarios);
        $i = 0;
        for (; $i < $quant; $i++) {
            $papel = $papelDAO->select("id_papel=" . $this->usuarios[$i]->getId_papel());
//            if ($papel[0]->getId_papel() != 1) { filtro de administrador
            $tabela .= "<tr id=" . $this->usuarios[$i]->getId_usuario() . ">";
            $tabela .= "<td width='60%' class='nome_usuario_datatable' id='nome_completo'>" . $this->usuarios[$i]->getNome_completo() . "</td>";
            $tabela .= "<td width='15%' align='center' id='permissao'>" . $papel[0]->getPapel() . "</td>";
            $tabela .= "<td width='25%' id='atuacao' align='center'>" . $this->usuarios[$i]->getAtuacao() . "</td>";

            $tabela .= "<td width='55%' id='data_nascimento'>" . $this->usuarios[$i]->getData_nascimento() . "</td>";
            $tabela .= "<td width='55%' id='cpf_passaporte'>" . $this->usuarios[$i]->getCpf_passaporte() . "</td>";
            $tabela .= "<td width='0%' id='rg'>" . $this->usuarios[$i]->getRg() . "</td>";
            $tabela .= "<td width='0%' id='id_profissional'>" . $this->usuarios[$i]->getId_profissional() . "</td>";
            $tabela .= "<td width='0%' id='atuacao'>" . $this->usuarios[$i]->getAtuacao() . "</td>";
            $tabela .= "<td width='0%' id='descricao_pessoal'>" . $this->usuarios[$i]->getDescricao_pessoal() . "</td>";
            $tabela .= "<td width='0%' id='sexo'>" . $this->usuarios[$i]->getSexo() . "</td>";
            $tabela .= "<td width='0%' id='tel_principal'>" . $this->usuarios[$i]->getTel_principal() . "</td>";
            $tabela .= "<td width='0%' id='tel_secundario'>" . $this->usuarios[$i]->getTel_secundario() . "</td>";
            $tabela .= "<td width='0%' id='email'>" . $this->usuarios[$i]->getEmail() . "</td>";

            $endereco = $this->controller->getEndereco("id_usuario=" . $this->usuarios[$i]->getId_usuario());

            $tabela .= "<td width='0%' id='rua'>" . $endereco->getRua() . "</td>";
            $tabela .= "<td width='0%' id='numero'>" . $endereco->getNumero() . "</td>";
            $tabela .= "<td width='0%' id='complemento'>" . $endereco->getComplemento() . "</td>";
            $tabela .= "<td width='0%' id='bairro'>" . $endereco->getBairro() . "</td>";
            $tabela .= "<td width='0%' id='cidade'>" . $endereco->getCidade() . "</td>";
            $tabela .= "<td width='0%' id='pais'>" . $endereco->getPais() . "</td>";
            $tabela .= "<td width='0%' id='estado'>" . $endereco->getEstado() . "</td>";
            $tabela .= "<td width='0%' id='id_usuario'>" . $this->usuarios[$i]->getId_usuario() . "</td>";
            $acesso = 'Liberado';
            if (!$this->usuarios[$i]->getStatus_acesso()) {
                $acesso = 'Bloqueado';
            }
            $tabela .= "<td width='15%' id='status_acesso'>" . $acesso . "</td>";

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

