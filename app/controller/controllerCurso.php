<?php

class controllerCurso {

    private $curso = null;
    private $curso_professor = null;
    private $controller = null;
    private $modulo = null;

    public function validarNome($nome, $id_curso = -1) {
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

    public function inserirCurso() {
        //seta as variaveis $this->curso e $this->cp
        $this->setCurso_post();
        $this->novoCurso($this->curso, $this->curso_professor);

        //se existir foto: para filtrar os cadastros feitos pela pag inicial
        $this->curso = $this->getCurso("nome='" . $this->curso->getNome() . "'");
        if (isset($_FILES["imagem"])) {
            // NOME? NÃO É UMA ENTRADA ÚNICA... =/
            $this->inserirFotoCurso($this->curso->getId_curso());
        }

        //cria o diretório do curso na pasta pdf
        $this->criaDiretorioCurso($this->curso->getId_curso());
        $this->criaDiretorioCurso_videoAula($this->curso->getId_curso());
        $this->criaDiretorioCurso_textos($this->curso->getId_curso());
        return $this->curso->getId_curso();
    }

    public function criaDiretorioCurso($id) {
        $caminho = ROOT_PATH . '/public/cursos/' . $id . '/';
        if (!mkdir($caminho, 0777))
            trigger_error("Não foi possível criar o diretório do curso" . $id);
    }

    public function criaDiretorioCurso_videoAula($id) {
        $caminho = ROOT_PATH . '/public/cursos/' . $id . '/videoAulas/';
        if (!mkdir($caminho))
            trigger_error("Não foi possível criar o diretório de video aulas do curso" . $id);
    }

    public function criaDiretorioCurso_textos($id) {
        $caminho = ROOT_PATH . '/public/cursos/' . $id . '/textos/';
        if (!mkdir($caminho))
            trigger_error("Não foi possível criar o diretório de textos do curso" . $id);
    }

    /*
     * Atualiza Curso no banco. Faz acesso ao CursoDAO
     */

    public function updateCurso(Curso $curso = null, array $cp = null) {
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

    public function atualizarCurso($id_curso) {
        $this->curso = $this->getCurso("id_curso = " . $id_curso);
        //seta as variaveis $this->curso e $this->cp
        $this->setCurso_post();

        //remove entradas antigas
        $this->controller = new controllerCurso_professor();
        $this->controller->removeProfessoresCurso($id_curso);

        //atualizar
        $this->updateCurso($this->curso, $this->curso_professor);
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

    public function getListaCursos($condicao = null) {
        $dao = new CursoDAO();
        $curso = $dao->select($condicao);
        return $curso; // null
    }

    /* Retorna lista de cursos para situações diferentes situações
     * @param status = 0 - Desabilitado 1ºacesso
     * @param status = 1 - Desabilitado 2º acesso
     * @param status = 2 - Em análise pelo administrador
     * @param status = 3 - Habilitado
     */

    public function getListaCursos_porStatus($status, $id) {
        $dao = new CursoDAO();
        $curso = $dao->select("status=" . $status);
        return $curso; // null
    }

    public function removerCurso(Curso $curso) {
        $dao = new CursoDAO();
        $affectedrows = $dao->delete($curso);
        if ($affectedrows >= 1) {
            $caminho = ROOT_PATH . '/public/cursos/' . $curso->getId_curso();
            if (is_dir($caminho)) {
                $objects = scandir($caminho);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (filetype($caminho . "/" . $object) == "dir")
                            rmdir($caminho . "/" . $object); else
                            unlink($caminho . "/" . $object);
                    }
                }
                reset($objects);
                rmdir($caminho);
            }
            return 1;
        } else {
            return 0;
        }
    }

    /*
     * FIM: FUNÇÕES DE CRUD
     * INICIO: FUNÇÕES AUXILIARES (geração de documento em html e funções de suporte)
     */

    public function listaCursos_professor($id_professor) {
        //Lista todos os cursos existentes, de acordo com o status.
        $this->controller = new controllerCurso_professor();
        $id_curso = $this->controller->getCurso_professor("id_usuario =" . $id_professor)->getId_curso();
        $this->cursos = $this->getListaCursos("id_curso=" . $id_curso);
        $contrucao = "";
        $nao_avalidado = "";
        $rejeitado = "";
        $aprovado_indisponivel = "";
        $aprovado_disponivel = "";

        for ($i = 0; $i < count($this->cursos); $i++) {
            if ($this->cursos[$i]->getStatus(1) == 0) {
                $contrucao .= "<li><p><a>" . $this->cursos[$i]->getNome() . "</a></p></li>";
            } else if ($this->cursos[$i]->getStatus(1) == 1) {
                $nao_avaliado .= "<li><p><a>" . $this->cursos[$i]->getNome() . "</a></p></li>";
            } else if ($this->cursos[$i]->getStatus(1) == 2) {
                $rejeitado .= "<li><p><a>" . $this->cursos[$i]->getNome() . "</a></p></li>";
            } else if ($this->cursos[$i]->getStatus(1) == 3) {
                $aprovado_indisponivel .= "<li><p><a>" . $this->cursos[$i]->getNome() . "</a></p></li>";
            } else if ($this->cursos[$i]->getStatus(1) == 4) {
                $aprovado_disponivel .= "<li><p><a>" . $this->cursos[$i]->getNome() . "</a></p></li>";
            }

            $listaCursos = "";
            
            // Lista os cursos em construcao
            $listaCursos .= "<a><div class='list_index_admin_gray'><div class='detalhe'></div><img  src='img/seta_gray.png' />Cursos em Construcao</div></a>";
            $listaCursos .= "<div><ul style='list-style-type:none;'>";

            if ($construcao != "") {
                $listaCursos .= $construcao;
            } else {
                $listaCursos .= "<li><p>Não existem cursos com esse status no momento!</p></li>";
            }
            $listaCursos .= "</ul></div>";
            
            // Lista os cursos aprovados e disponiveis
            $listaCursos .= "<a><div class='list_index_admin_blue'><div class='detalhe1'></div><img  src='img/seta_blue.png' />Cursos Aprovados e Disponíveis</div></a>";
            $listaCursos .= "<div><ul style='list-style-type:none;'>";
            if ($aprovado_disponivel != "") {
                $listaCursos .= $aprovado_disponivel;
            } else {
                $listaCursos .= "<li><p>Não existem cursos com esse status no momento!</p></li>";
            }
            $listaCursos .= "</ul></div>";

            // Lista os cursos aprovados e indisponiveis
            $listaCursos .= "<a><div class='list_index_admin_gray'><div class='detalhe'></div><img  src='img/seta_gray.png' />Cursos Aprovados e Indisponíveis</div></a>";
            $listaCursos .= "<div><ul style='list-style-type:none;'>";

            if ($aprovado_indisponivel != "") {
                $listaCursos .= $aprovado_indisponivel;
            } else {
                $listaCursos .= "<li><p>Não existem cursos com esse status no momento!</p></li>";
            }
            $listaCursos .= "</ul></div>";

            // Lista os cursos nao avaliados
            $listaCursos .= "<a><div class='list_index_admin_blue'><div class='detalhe1'></div><img  src='img/seta_blue.png' />Cursos Não Avaliados</div></a>";
            $listaCursos .= "<div><ul style='list-style-type:none;'>";

            if ($nao_avaliado != "") {
                $listaCursos .= $nao_avaliado;
            } else {
                $listaCursos .= "<li><p>Não existem cursos com esse status no momento!</p></li>";
            }
            $listaCursos .= "</ul></div>";
            
            // Lista os cursos rejeitados
            $listaCursos .= "<a><div class='list_index_admin_gray'><div class='detalhe'></div><img  src='img/seta_gray.png' />Cursos Rejeitados</div></a>";
            $listaCursos .= "<div><ul style='list-style-type:none;'>";

            if ($rejeitado != "") {
                $listaCursos .= $rejeitado;
            } else {
                $listaCursos .= "<li><p>Não existem cursos com esse status no momento!</p></li>";
            }
            $listaCursos .= "</ul></div>";
            
            
            return $listaCursos;
        }
    }

    public function listaConteudo_curso($id_curso) {
        //Lista todo o conteúdo do curso
    }

    public function tabelaCursos() {
        $tabela = "<table id='tabela_cursos' width='100%' align='center'>
         <thead> 
                <tr> 
                    <th>Nome</th> 
                    <th>Tempo (dias)</th> 
                    <th>Gratuito</th>
                    <th>Valor</th>
                    <th>Status</th>                                       
                    <th>descricao</th> 
                    <th>numero_modulos</th> 
                    <th>objetivo</th>
                    <th>justificativa</th>
                    <th>obs</th>                   
                    <th>id</th>                   
                </tr> 
            </thead> 
            <tbody>";
        $cursoDAO = new CursoDAO();
        $this->cursos = $cursoDAO->select(null, null);
        $quant = count($this->cursos);
        $i = 0;
        for (; $i < $quant; $i++) {
            $tabela .= "<tr id=tabela_linha" . $this->cursos[$i]->getId_curso() . ">";
            $tabela .= "<td width='45%' id='nome'>" . $this->cursos[$i]->getNome() . "</td>";
            $tabela .= "<td width='10%' id='tempo' align='center'>" . $this->cursos[$i]->getTempo() . "</td>";
            $tabela .= "<td width='10%' id='gratuito' align='center'>" . $this->cursos[$i]->getGratuito(0) . "</td>";
            $tabela .= "<td width='14%' id='valor' align='center'>" . $this->cursos[$i]->getValor() . "</td>";
            $tabela .= "<td width='14%' id='status' align='center'>" . $this->getNomeStatus($this->cursos[$i]->getStatus()) . "</td>";
            $tabela .= "<td width='14%' id='descricao' align='center'>" . $this->cursos[$i]->getDescricao() . "</td>";
            $tabela .= "<td width='14%' id='numero_modulos' align='center'>" . $this->cursos[$i]->getNumero_modulos() . "</td>";
            $tabela .= "<td width='14%' id='objetivo' align='center'>" . $this->cursos[$i]->getObjetivo() . "</td>";
            $tabela .= "<td width='14%' id='justificativa' align='center'>" . $this->cursos[$i]->getJustificativa() . "</td>";
            $tabela .= "<td width='14%' id='obs' align='center'>" . $this->cursos[$i]->getObs() . "</td>";
            $tabela .= "<td width='14%' id='id_curso' align='center'>" . $this->cursos[$i]->getId_curso() . "</td>";
        }
        $tabela .= "</tbody></table>";
        return $tabela;
    }

    public function cursosAluno() {
        $tabela = null;
        $cursoDAO = new CursoDAO();
        $this->cursos = $cursoDAO->select(null, null);
        $matricula_cursoDAO = new Matricula_cursoDAO();
        $matriculados = $matricula_cursoDAO->select("id_usuario=" . $_SESSION["usuarioLogado"]->getId_usuario());
        $quant = count($matriculados);
        $i = 0;
        for (; $i < $quant; $i++) {
            $auxCurso = $cursoDAO->select("id_curso=" . $matriculados[$i]->getId_curso());

            $tabela.="<table style='width: 100%;' class='matriculado'><tr><td><label>" . $auxCurso[0]->getNome() . "</label>
            </td>";
            $tabela.="<td align='right'>
                <a href='index.php?c=ead&a=curso&id=" . $auxCurso[0]->getId_curso() . "' class='button'>Acessar</a></td></tr>";
            $tabela.= "<tr><td><label style='font-size: 12px'>Duração do curso:" . $auxCurso[0]->getTempo() . "</label>
            </td>";
            $tabela.="</tr>
            </table>";
        }
        $quant = count($this->cursos);
        $i = 0;
        for (; $i < $quant; $i++) {
            if ($matricula_cursoDAO->select("id_usuario=" . $_SESSION["usuarioLogado"]->getId_usuario() .
                            " AND id_curso=" . $this->cursos[$i]->getId_curso()) == null) {
                $tabela.="<table style='width: 100%;' class='nao_matriculado'><tr><td><label>" . $this->cursos[$i]->getNome() . "</label>
                </td>";
                $tabela.="<td align='right'>
                    <a href='index.php?c=ead&a=matricula&id=" . $this->cursos[$i]->getId_curso() . "' class='button'>Matricular</a></td></tr>";
                $tabela.= "<tr><td><label style='font-size: 12px'>Duração do curso:" . $this->cursos[$i]->getTempo() . "</label>
                </td>";
                $tabela.="</tr>
                </table>";
            }
        }

        return $tabela;
    }

    public function modulosCurso() {
        $lista = null;
        $moduloDAO = new ModuloDAO();
        $modulos = $moduloDAO->select("id_curso=" . $_GET['id']);

        $quant = count($modulos);
        $i = 0;
        for (; $i < $quant; $i++) {
            $lista .= "<li><h4 class='navbar_item materialIcon'><a href='#'> Modulo " . $modulos[$i]->getNumero_modulo() . "</a></h4></li>";
        }

        return $lista;
    }

    public function comboCursos() {
        $cursos = $this->getListaCursos();
        $options = null;
        if ($cursos != null) {
            $options = "";
            for ($j = 0; $j < count($cursos); $j++) {
                $options .= "<option value='" . $cursos[$j]->getId_curso() . "'>" . $cursos[$j]->getNome() . "</option>";
            }
        }
        return $options;
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

    /*
     * CRUD: MÓDULOS
     */

    public function setModulo_post() {
        if (!empty($_POST)) {
            if ($this->modulo == null) {
                $this->modulo = new Modulo();
            }
            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($this->modulo, $setAtributo)) {
                    $this->modulo->$setAtributo($v);
                }
            }
        }
    }

    public function novoModulo_post() {
        //seta modulo via post
        $this->setModulo_post();
        //insere novo modulo
        $this->novoModulo($this->modulo);
    }

    public function novoModulo(Modulo $modulo) {
        if ($modulo) {
            $dao = new ModuloDAO();
            //se realmente não existe registro com o mesmo nome, insere
            if ($dao->select("titulo_modulo='" . $modulo->getTitulo_modulo() . "'") == null) {
                $dao->insert($modulo);
            } else {
                //caso contrário, enviar para a página principal
                trigger_error("1 Reenvio de formulario, modulo ja cadastrado");
            }
        } else {
            return 'ERRO: funcao novoModulo - [controllerCurso]';
        }
    }

    public function getNomeStatus($status) {
        if ($status == 0) {
            return 'Em construção';
        }
        if ($status == 1) {
            return 'Não avaliado';
        }
        if ($status == 2) {
            return 'Rejeitado';
        }
        if ($status == 3) {
            return 'Aprovado e indisponível';
        }
        if ($status == 3) {
            return 'Aprovado e disponível';
        }
    }

}

?>
