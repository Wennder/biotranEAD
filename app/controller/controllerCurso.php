<?php

class controllerCurso {

    private $curso = null;
    private $curso_professor = null;
    private $controller = null;

    public function validarNome($nome, $id_curso) {
        $user = $this->getCurso("nome='" . $nome . "'");
        if ($user != null) {
            if ($id_curso != -1) {
                $curso_id = $this->getCurso("id_curso=" . $id_curso);
                if ($curso_id->getNome() == $nome) {
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
     * Seta os objetos $this->curso e $this->curso_professor
     * a partir de dados enviados via POST
     */

    public function setCurso_post() {
        if (!empty($_POST)) {
            if ($this->curso == null) {
                $this->curso = new Curso();
            }
            if ($this->curso_professor == null) {
                $this->curso_professor = array();
            }
            foreach ($_POST as $k => $v) {
                if ($k == "destino") {
                    $professores = $v;
                    for ($i = 0; $i < count($professores); $i++) {                        
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
        }
    }

    /*
     * insere foto no curso de id=$id_curso
     * @param @id_curso
     */

    public function inserirFotoCurso($id_curso) {
        //Inserção da foto
        if (isset($_FILES["imagem"])) {
            if ($_FILES["imagem"]["name"] != '') {
                $imagem = $_FILES["imagem"];
                $tipos = array("image/jpg");
                $pasta_dir = "img/cursos/";
                if (!in_array($imagem['type'], $tipos)) {
                    $imagem_nome = $pasta_dir . $id_curso . ".jpg";
                    move_uploaded_file($imagem["tmp_name"], $imagem_nome);
                    $imagem_arquivo = "img/cursos/" . $id_curso . ".jpg";
                    list($altura, $largura) = getimagesize($imagem_arquivo);
                    if ($altura > 180 && $largura > 240) {
                        $img = wiImage::load($imagem_arquivo);
                        $img = $img->resize(290, 230, 'outside');
                        $img = $img->crop('50% - 50', '50% - 40', 240, 180);
                        $img->saveToFile($imagem_arquivo);
                    }
                }
            }
        }
    }

    /*
     * Insere um novo Curso no BD.     
     *     
     * @param $curso: objeto curso
     * @param $cp: objeto curso_professor
     * 
     * @return Mensagem de erro caso a insersao via parametros falhe por objetos nulos
     */

    public function novoCurso(Curso $curso, array $cp) {
        if ($curso != null && $cp != null) {
            $dao = new CursoDAO();
            //se realmente não existe registro com o mesmo nome, insere
            if ($dao->select("nome='" . $curso->getNome() . "'") == null) {
                $dao->insert($curso, $cp);                
            } else {
                //caso contrário, enviar para a página principal
                trigger_error("1 Reenvio de formulario, curso ja cadastrado");
            }
        } else {
            return 'ERRO: funcao novoCurso - [controllerCurso]';
        }
    }

    /*
     * retorna uma lista de usuarios(professor) responsaveis pelo curso
     * de id = $id_curso
     * @param $id_curso - id do curso
     * @return Array - de usuarios(professor) responsaveis
     */

    public function getListaCurso_professor($id_curso) {
        $this->controller = new controllerCurso_professor();
        return $this->controller->getListaCurso_professor("id_curso_professor = " . $id_curso);
    }

    /*
     * insere novo curso via formulário post
     */

    public function novoCurso_post() {
        //seta as variaveis $this->curso e $this->cp
        $this->setCurso_post();
        $this->novoCurso($this->curso, $this->curso_professor);
        //se existir foto: para filtrar os cadastros feitos pela pag inicial
        if (isset($_FILES["imagem"])) {
            // NOME? NÃO É UMA ENTRADA ÚNICA... =/
            $this->curso = $this->getCurso("nome='" . $this->curso->getNome() . "'");
            $this->inserirFotoCurso($this->curso->getId_curso());
        }
    }

    /*
     * Atualiza Curso no banco. Faz acesso ao CursoDAO
     */

    public function atualizarCurso(Curso $curso = null, array $cp = null) {
        //atualiza usuario
        if ($curso != null) {
            $dao = new CursoDAO();
            if ($cp != null) {
                $dao->update($curso, $cp);
            } else {
                $dao->update($curso);
            }
        } else {
            return 'ERRO: parametros nullos - funcao novoUsuario - [controllerUsuario]';
        }
    }

    public function atualizarCurso_post($id_curso) {
        $this->curso = $this->getCurso("id_curso = " . $id_curso);
        //seta as variaveis $this->curso e $this->cp
        $this->setCurso_post();

        //remove entradas antigas
        $this->controller = new controllerCurso_professor();
        $this->controller->removeProfessoresCurso($id_curso);

        //atualizar
        $this->atualizarCurso($this->curso, $this->curso_professor);
        //se existir foto: para filtrar os cadastros feitos pela pag inicial
        if (isset($_FILES["imagem"])) {
            // NOME? NÃO É UMA ENTRADA ÚNICA... =/            
            $this->inserirFotoCurso($this->curso->getId_curso());
        }
    }

    public function getCurso($condicao) {
        $dao = new CursoDAO();
        $curso = $dao->select($condicao);
        if ($curso != null) {
            return $curso[0];
        }
        return $curso; // null
    }

    public function removerCurso(Curso $curso) {
        $dao = new CursoDAO();
        $affectedrows = $dao->delete($curso);
        if ($affectedrows >= 1) {
            return 1;
        } else {
            return 0;
        }
    }

    /*
     * FIM: FUNÇÕES DE CRUD
     * INICIO: FUNÇÕES AUXILIARES (geração de documento em html e funções de suporte)
     */

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
        $cursoDAO = new CursoDAO();
        $this->cursos = $cursoDAO->select(null, null);
        $quant = count($this->cursos);
        $i = 0;
        for (; $i < $quant; $i++) {
            $tabela .= "<tr id=tabela_linha" . $this->cursos[$i]->getId_curso() . ">";
            $tabela .= "<td width='59%' id='nome'>" . $this->cursos[$i]->getNome() . "</td>";
            $tabela .= "<td width='7%' id='tempo' align='center'>" . $this->cursos[$i]->getTempo() . " dias</td>";
            $tabela .= "<td width='8%' id='gratuito' align='center'>" . $this->cursos[$i]->getGratuito(0) . "</td>";
            $tabela .= "<td width='14%' id='valor' align='center'>R$" . $this->cursos[$i]->getValor() . "</td>";
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

    public function comboTodos_Professores() {
        $this->controller = new controllerUsuario();
        $todos_professores = $this->controller->getListaUsuarioProfessor();
        $options = "";
        foreach ($todos_professores as $professor) {
            $options .= "<option value='" . $professor->getId_usuario() . "'>" . $professor->getNome_completo() . "</option>";
        }
        return $options;
    }

    public function comboProfessores_curso($idCurso) {        
        $this->controllerCP = new controllerCurso_professor();        
        $professores_curso = $this->controllerCP->getProfessoresCurso($idCurso);
        $options = "";

        for ($j = 0; $j < count($professores_curso); $j++) {        
            $options .= "<option value='" . $professores_curso[$j]->getId_usuario() . "' selected='selected'>" . $professores_curso[$j]->getNome_completo() . "</option>";
        }
        return $options;
    }

    public function comboProfessoresDisponiveis($idCurso) {
        $this->controller = new controllerUsuario();
        $this->controllerCP = new controllerCurso_professor();
        $todos_professores = $this->controller->getListaUsuarioProfessor();
        $professores_curso = $this->controllerCP->getProfessoresCurso($idCurso);
        $options = "";

        for ($j = 0; $j < count($professores_curso); $j++) {
            for ($i = 0; $i < count($todos_professores); $i++) {
                if ($todos_professores[$i] != null && $todos_professores[$i]->getId_usuario() == $professores_curso[$j]->getId_usuario()) {
                    $todos_professores[$i] = null;
                }
            }
        }
        for ($i = 0; $i < count($todos_professores); $i++) {
            if ($todos_professores[$i] != null) {
                $options .= "<option value='" . $todos_professores[$i]->getId_usuario() . "'>" . $todos_professores[$i]->getNome_completo() . "</option>";
            }
        }
        return $options;
    }

    public function getProfessores_curso($idCurso) {
        $this->controller = new controllerCurso_professor();
        return $this->controller->getProfessoresCurso($idCurso);
    }

    public function getProfessores() {
        $this->controller = new controllerUsuario();
        return $this->controller->getListaUsuarioProfessor();
    }

    /*
     * FIM: FUNÇÕES AUXILIARES
     */
}

?>
