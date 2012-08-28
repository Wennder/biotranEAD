<?php

class controllerCurso {

    private $curso;
    
    /*
     * Insere um novo Usuario no BD.
     * Captura os dados do usuario via POST ou através dos paramtros
     *     
     * @param $user: objeto usuario
     * @param $end1: objeto endereco
     * 
     * @return Mensagem de erro caso a insersao via parametros falhe por objetos nulos
     */

    public function novoCurso() {
        if (!empty($_POST)) {
            $this->curso = new Curso();
            $this->curso_professor = array();
            foreach ($_POST as $k => $v) {
                if ($k == "professores") {
                    $professores = $v;
                    for($i = 0; $i < count($professores); $i++){
                        $this->curso_professor[$i] = new Curso_professor();
                        $this->curso_professor[$i]->setId_usuario($professores[$i]);
                    }
                } else {
                    $setAtributo = 'set' . ucfirst($k);
                    if (method_exists($this->curso, $setAtributo)) {
                        $this->curso->$setAtributo($v);
                    }
                }
            }

            $dao = new CursoDAO();
            $dao->insert($this->curso, $this->curso_professor);
            // NOME? NÃO É UMA ENTRADA ÚNICA... =/
            $idCurso = $dao->select("nome='" . $this->curso->getNome() . "'");
            $idCurso = $idCurso[0]->getId_curso();

            //Inserção da foto
            if (isset($_FILES["imagem"])) {
                if ($_FILES["imagem"]["name"] != '') {
                    $imagem = $_FILES["imagem"];
                    $tipos = array("image/jpg");
                    $pasta_dir = "img/cursos/";
                    if (!in_array($imagem['type'], $tipos)) {
                        $imagem_nome = $pasta_dir . $idCurso . ".jpg";
                        move_uploaded_file($imagem["tmp_name"], $imagem_nome);
                        $imagem_arquivo = "img/cursos/" . $idCurso . ".jpg";
                        list($altura, $largura) = getimagesize($imagem_arquivo);
                        if ($altura > 180 && $largura > 240) {
                            $img = wiImage::load($imagem_arquivo);
                            $img = $img->resize(230, 290, 'outside');
                            $img = $img->crop('50% - 50', '50% - 40', 180, 240);
                            $img->saveToFile($imagem_arquivo);
                        }
                    }
                }
            }
        }
    }

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
            $dao = new UsuarioDAO();
            $dao->update($this->usuario, $this->end);

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

    public function tabelaCursos() {
        $tabela = "<table id='tabela_cursos' width='100%' align='center'>
         <thead> 
                <tr> 
                    <th>Nome</th> 
                    <th>Tempo</th> 
                    <th>Gratuito</th>
                    <th>Valor</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr> 
            </thead> 
            <tbody>";
        $tabela = $tabela;
        $cursoDAO = new CursoDAO();
        $this->cursos = $cursoDAO->select(null, null);
        $quant = count($this->cursos);
        $i = 0;
        for (; $i < $quant; $i++) {
            $tabela .= "<tr id=tabela_linha" . $this->cursos[$i]->getId_curso() . ">";
            $tabela .= "<td width='59%' id='nome'>" . $this->cursos[$i]->getNome() . "</td>";
            $tabela .= "<td width='7%' id='tempo' align='center'>" . $this->cursos[$i]->getTempo() . " dias</td>";
            $tabela .= "<td width='8%' id='gratuito' align='center'>" . $this->cursos[$i]->getGratuito(0) . "</td>";
            $tabela .= "<td width='14%' id='valor' align='center'>" . $this->cursos[$i]->getValor() . "</td>";
            $tabela .= "<td width='3%' id='b_visualizar' align='center'>
                <input type='button' title='Visualizar dados do Curso' id='b_vis-" . $this->cursos[$i]->getId_curso() . "' value='' onclick='visualizarCurso(this.id);' class='botaoVisualizar' /> </td>";
            $tabela .= "<td width='3%' id='b_editar' align='center'>
                <input type='button' title='Editar dados do Curso' id='b_edt-" . $this->cursos[$i]->getId_curso() . "' value='' onclick='editarCurso(this.id);' class='botaoEditar' /> </td>";
            $tabela .= "<td width='3%' id='b_excluir' align='center'>
                <input type='button' title='Excluir Curso' id='b_exc-" . $this->cursos[$i]->getId_curso() . "' value='' onclick='removerCurso(this.id);' class='botaoExcluir' /> </td>";
            $tabela .= "</tr>";
        }
        $tabela .= "</tbody></table>";
        return $tabela;
    }

    public function getCurso($condicao) {
        $dao = new CursoDAO();
        $curso = $dao->select($condicao);
        return $curso[0];
    }

    public function removerCurso(Curso $curso) {
        $dao = new CursoDAO();
        $affectedrows = $dao->delete($curso);
        if ($affectedrows >= 1) {
            return 1;
        }else{
            return 0;
        }

//        $dao = new EnderecoDAO();
//        $affectedrows = $dao->deleteEnderecoUsuario($curso->getId_usuario());
//        if ($affectedrows > 0) {
//            $dao = new UsuarioDAO();
//            $affectedrows = $dao->delete($curso);
//            if ($affectedrows >= 1) {
//                return 1;
//            }else
//                return 0;
//        }else {
//            return 3;
//        }
    }

}

?>
