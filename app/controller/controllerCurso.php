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
            return 0;
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
                $pasta_dir = "../img/cursos/";
                if (!in_array($imagem['type'], $tipos)) {
                    $imagem_nome = $pasta_dir . $id_curso . ".jpg";
                    move_uploaded_file($_FILES['imagem']["tmp_name"], $imagem_nome);
                    $imagem_arquivo = "../img/cursos/" . $id_curso . ".jpg";
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

    public function inserirAssinaturaCurso($id_curso) {
        //Inserção da foto
        if (isset($_FILES["assinatura"])) {
            if ($_FILES["assinatura"]["name"] != '') {
                $imagem = $_FILES["assinatura"];
                $tipos = array("image/jpg", "image/jpeg");
                $pasta_dir = "../img/cursos/";
                if (in_array($imagem['type'], $tipos)) {
                    $imagem_nome = $pasta_dir . "ass-" . $id_curso . ".jpg";
                    move_uploaded_file($_FILES['assinatura']["tmp_name"], $imagem_nome);
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
            // inserindo assinatura digital;
        }
        if (isset($_FILES["assinatura"])) {
            $this->inserirAssinaturaCurso($this->curso->getId_curso());
        }

        //cria o diretório do curso na pasta pdf
        $this->criaDiretorioCurso($this->curso->getId_curso());
        return $this->curso->getId_curso();
    }

    /*
     * Ao criar um curso serão criados os diretórios do curso e de módulos
     * ao criar um módulo será criado as pastas:
     * video_aula
     * texto_referencia
     * material_complementar
     */

    public function criaDiretorioCurso($id) {
        $caminho = ROOT_PATH . '/public/cursos/' . $id . '/modulos/';
        if (!mkdir($caminho, 0777, true))
            trigger_error("Não foi possível criar o diretório de modulos");
    }

    public function criaDiretorioCurso_videoAula($id) {
        $caminho = ROOT_PATH . '/public/cursos/' . $id . '/video_aula/';
        $caminho = ROOT_PATH . '/public/cursos/' . $id . '/texto_referencia/';
        $caminho = ROOT_PATH . '/public/cursos/' . $id . '/material_complementar/';
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
        //atualiza curso
        if ($curso != null) {
            $dao = new CursoDAO();
            if ($cp != null) {
                return $dao->update($curso, $cp);
            } else {
                return $dao->update($curso);
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
        if (isset($_FILES["assinatura"])) {
            $this->inserirAssinaturaCurso($this->curso->getId_curso());
        }
    }

    public function atualizarDescritivoCurso($id_curso) {
        $this->curso = $this->getCurso("id_curso = " . $id_curso);
        //seta as variaveis $this->curso e $this->cp
        $this->setCurso_post();
        //atualizar
        $this->updateCurso($this->curso);
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
     * @param status = 0 - Desabilitado 1º acesso
     * @param status = 1 - Desabilitado 2º acesso
     * @param status = 2 - Em análise pelo administrador
     * @param status = 3 - Aprovado e desabilitado
     * @param status = 4 - Aprovado e habilitado
     */

    public function getListaCursos_porStatus($status, $id) {
        $dao = new CursoDAO();
        $curso = $dao->select("status=" . $status);
        return $curso; // null
    }

    public function removerCurso($id_curso) {
        $dao = new CursoDAO();
//        echo $id_curso;die();
        $curso = $this->getCurso("id_curso=" . $id_curso);
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
                $caminho = ROOT_PATH . '/public/img/cursos/' . $curso->getId_curso() . '.jpg';
                if (is_file($caminho)) {
                    unlink($caminho);
                }
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
        //echo $id_professor;die();
        //Lista todos os cursos existentes, de acordo com o status.
        $this->controller = new controllerCurso_professor();
        $cursos = $this->controller->getListaCurso_professor("id_usuario =" . $id_professor);
        $construcao = "";
        $nao_avaliado = "";
        $rejeitado = "";
        $aprovado_indisponivel = "";
        $aprovado_disponivel = "";
        $a = 0;
        $b = 0;
        $c = 0;
        $d = 0;
        $e = 0;

        $listaCursos = 'Nenhum curso vinculado a sua conta';

        for ($i = 0; $i < count($cursos); $i++) {
            $this->curso = $this->getCurso("id_curso=" . $cursos[$i]->getId_curso());
            if ($this->curso->getStatus(1) == 0) {
                if ($this->curso->getNumero_modulos() == 0) {
                    $construcao .= "<li class='conteudo_row'><label><a href=index.php?c=ead&a=primeiro_acesso_curso&id=" . $this->curso->getId_curso() . ">" . $this->curso->getNome() . "</a></label></li>";
                } else {
                    $construcao .= "<li class='conteudo_row'><label><a href=index.php?c=ead&a=gerenciar_curso&id=" . $this->curso->getId_curso() . ">" . $this->curso->getNome() . "</a></label></li>";
                }
                $a++;
            } else if ($this->curso->getStatus(1) == 1) {
                $nao_avaliado .= "<li class='conteudo_row'><label><a href=index.php?c=ead&a=gerenciar_curso&id=" . $this->curso->getId_curso() . ">" . $this->curso->getNome() . "</a></label></li>";
                $b++;
            } else if ($this->curso->getStatus(1) == 2) {
                $rejeitado .= "<li class='conteudo_row'><label><a href=index.php?c=ead&a=gerenciar_curso&id=" . $this->curso->getId_curso() . ">" . $this->curso->getNome() . "</a></label></li>";
                $c++;
            } else if ($this->curso->getStatus(1) == 3) {
                $aprovado_indisponivel .= "<li class='conteudo_row'><label><a href=index.php?c=ead&a=gerenciar_curso&id=" . $this->curso->getId_curso() . ">" . $this->curso->getNome() . "</a></label></li>";
                $d++;
            } else if ($this->curso->getStatus(1) == 4) {
                $aprovado_disponivel .= "<li class='conteudo_row'><label><a href=index.php?c=ead&a=gerenciar_curso&id=" . $this->curso->getId_curso() . ">" . $this->curso->getNome() . "</a></label></li>";
                $e++;
            }

            $listaCursos = "";

            // Lista os cursos em construcao
            $listaCursos .= "<div class='accord_body accord_list' style='border-left:3px solid #7f90d0; padding-left:5px;'><label class='accord_label'>Cursos em Construção</label><label class='accord_label_2'>$a Curso(s)</label></div>";
            $listaCursos .= "<div class='accord_content_body' style='display:none;'><ul class='accord_ul'>";

            if ($construcao != "") {
                $listaCursos .= $construcao;
            } else {
                $listaCursos .= "<li class='conteudo_row'><label>Não existem cursos com esse status no momento.</label></li>";
            }
            $listaCursos .= "</ul></div>";

            // Lista os cursos aprovados e disponiveis
            $listaCursos .= "<div class='accord_body accord_list' style='border-left:3px solid #7fd08b; padding-left:5px;'><label class='accord_label'>Cursos Aprovados e Disponíveis</label><label class='accord_label_2'>$e Curso(s)</label></div>";
            $listaCursos .= "<div class='accord_content_body' style='display:none;'><ul class='accord_ul'>";

            if ($aprovado_disponivel != "") {
                $listaCursos .= $aprovado_disponivel;
            } else {
                $listaCursos .= "<li class='conteudo_row'><label>Não existem cursos com esse status no momento.</label></li>";
            }
            $listaCursos .= "</ul></div>";

            // Lista os cursos aprovados e indisponiveis
            $listaCursos .= "<div class='accord_body accord_list' style='border-left:3px solid #cdd07f; padding-left:5px;'><label class='accord_label'>Cursos Aprovados e Indisponíveis</label><label class='accord_label_2'>$d Curso(s)</label></div>";
            $listaCursos .= "<div class='accord_content_body' style='display:none;'><ul class='accord_ul'>";

            if ($aprovado_indisponivel != "") {
                $listaCursos .= $aprovado_indisponivel;
            } else {
                $listaCursos .= "<li class='conteudo_row'><label>Não existem cursos com esse status no momento.</label></li>";
            }
            $listaCursos .= "</ul></div>";

            // Lista os cursos nao avaliados
            $listaCursos .= "<div class='accord_body accord_list' style='border-left:3px solid #d07f7f; padding-left:5px;'><label class='accord_label'>Cursos Não Avaliados</label><label class='accord_label_2'>$b Curso(s)</label></div>";
            $listaCursos .= "<div class='accord_content_body' style='display:none;'><ul class='accord_ul'>";

            if ($nao_avaliado != "") {
                $listaCursos .= $nao_avaliado;
            } else {
                $listaCursos .= "<li class='conteudo_row'><label>Não existem cursos com esse status no momento.</label></li>";
            }
            $listaCursos .= "</ul></div>";

            // Lista os cursos rejeitados
            $listaCursos .= "<div class='accord_body accord_list' style='border-left:3px solid #af7fd0; padding-left:5px;'><label class='accord_label'>Cursos Rejeitados</label><label class='accord_label_2'>$c Curso(s)</label></div>";
            $listaCursos .= "<div class='accord_content_body' style='display:none;'><ul class='accord_ul'>";

            if ($rejeitado != "") {
                $listaCursos .= $rejeitado;
            } else {
                $listaCursos .= "<li class='conteudo_row'><label>Não existem cursos com esse status no momento.</label></li>";
            }
            $listaCursos .= "</ul></div>";
        }
        return $listaCursos;
    }

    public function tabelaCursos() {

        $tabela = "<table id='tabela_cursos' width='100%' align='center' class='display'>
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
                    <th>Disponibilizar</th>                   
                </tr> 
            </thead> 
            <tbody>";

        $cursoDAO = new CursoDAO();

        $this->cursos = $cursoDAO->select(null, null);

        $quant = count($this->cursos);
        $i = 0;
        $controller = new controllerModulo();
        for (; $i < $quant; $i++) {
            $tabela .= "<tr id=" . $this->cursos[$i]->getId_curso() . ">";
            $tabela .= "<td width='50%' id='nome'>" . $this->cursos[$i]->getNome() . "</td>";
            $tabela .= "<td width='12%' id='tempo' align='center'>" . $this->cursos[$i]->getTempo() . "</td>";
            $tabela .= "<td width='8%' id='gratuito' align='center'>" . $this->cursos[$i]->getGratuito(0) . "</td>";
            $tabela .= "<td width='8%' id='valor' align='center'>" . $this->cursos[$i]->getValor() . "</td>";
            $tabela .= "<td width='10%' id='status' align='center'>" . $this->getNomeStatus($this->cursos[$i]->getStatus()) . "</td>";
            $tabela .= "<td width='0%' id='descricao' align='center'>" . $this->cursos[$i]->getDescricao() . "</td>";
            $tabela .= "<td width='0%' id='numero_modulos' align='center'>" . $this->cursos[$i]->getNumero_modulos() . "</td>";
            $tabela .= "<td width='0%' id='objetivo' align='center'>" . $this->cursos[$i]->getObjetivo() . "</td>";
            $tabela .= "<td width='0%' id='justificativa' align='center'>" . $this->cursos[$i]->getJustificativa() . "</td>";
            $tabela .= "<td width='0%' id='obs' align='center'>" . $this->cursos[$i]->getObs() . "</td>";
            $tabela .= "<td width='0%' id='id_curso' align='center'>" . $this->cursos[$i]->getId_curso() . "</td>";
            switch ($this->cursos[$i]->getStatus()) {
                case 2: $tabela .= "<td width='12%' id='input_liberar' align='center'> <input type='checkbox' value='0' disabled='true' id='check_habilitar' /></td>";
                    break;
                case 3: $tabela .= "<td width='12%' id='input_liberar' align='center'> <input name='" . $this->cursos[$i]->getId_curso() . "' type='checkbox' value='1' id='check_habilitar' /></td>";
                    break;
                case 4: $tabela .= "<td width='12%' id='input_liberar' align='center'> <input name='" . $this->cursos[$i]->getId_curso() . "' type='checkbox' checked='checked' value='0' id='check_habilitar' /></td>";
                    break;
                default: $tabela .= "<td width='12%' id='input_liberar' align='center'> <input type='checkbox' value='0' disabled='true' id='check_habilitar' /></td>";
                    break;
            }
            $tabela .= "</tr>";
        }

        $tabela .= "</tbody></table>";
        return $tabela;
    }

    public function lista_cursosAluno() {
        $tabela = null;
        $this->cursos = $this->getListaCursos("status = 4");
        $matricula_cursoDAO = new Matricula_cursoDAO();
        $matriculados = $matricula_cursoDAO->select("id_usuario=" . $_SESSION["usuarioLogado"]->getId_usuario());
        $quant = count($matriculados);
        $i = 0;

        $tabela .= "<div class='accord_body accord_list' style='border-left:3px solid #7f90d0; padding-left:5px;'><label class='accord_label'>Meus Cursos</label></div>";
        $tabela .= "<div class='accord_content_body' style='display: none;'><ul class='accord_ul'>";
        if ($quant > 0) {
            for (; $i < $quant; $i++) {
                $auxCurso = $this->getListaCursos("id_curso=" . $matriculados[$i]->getId_curso());
                $tabela.="<li class='conteudo_row' style='height: 26px;'><label><a href='index.php?c=ead&a=curso_aluno&id=" . $auxCurso[0]->getId_curso() . "'>" . $auxCurso[0]->getNome() . '</a></label></li>';
            }
        } else {
            $tabela.="<li class='conteudo_row' style='height: 26px;'><label>Você não possui nenhum curso no momento.</label></li>";
        }
        $tabela .= "</ul></div>";
        $quant = count($this->cursos);
        $i = 0;
        $tabela .= "<div class='accord_body accord_list' style='border-left:3px solid #7fd08b; padding-left:5px;'><label class='accord_label'>Outros Cursos</label></div>";
        $tabela .= "<div class='accord_content_body' style='display: none;'><ul class='accord_ul'>";
        if ($quant > 0)
            for (; $i < $quant; $i++) {
                if ($matricula_cursoDAO->select("id_usuario=" . $_SESSION["usuarioLogado"]->getId_usuario() . " AND id_curso=" . $this->cursos[$i]->getId_curso()) == null) {
                    $tabela.="<li class='conteudo_row' style='height: 26px;'><label>" . $this->cursos[$i]->getNome() . "</label>";
                    $tabela.="<div style='float: right;'><input id='btn_visualizarCurso' name='" . $this->cursos[$i]->getId_curso() . "' type='button' class='button3' value='Visualizar'/></div></li>";
                }
            } else {
            $tabela.="<li class='conteudo_row' style='height: 26px;'><label>Não há outros cursos disponíveis no momento.</label></li>";
        }
        $tabela .='</ul></div>';
        return $tabela;
    }

    public function modulosCurso($id_curso) {
        $lista = null;
        $moduloDAO = new ModuloDAO();
        $modulos = $moduloDAO->select("id_curso=" . $id_curso);

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
        if ($todos_professores == null) {
            return 'erro_professor';
        }
        foreach ($todos_professores as $professor) {
            $options .= "<option value='" . $professor->getId_usuario() . "'>" . $professor->getNome_completo() . "</option>";
        }
        return $options;
    }

    public function comboProfessores_curso($idCurso) {
        $this->controllerCP = new controllerCurso_professor();
        $professores_curso = $this->controllerCP->getProfessoresCurso($idCurso);
        $options = "";
        if ($professores_curso == null) {
            return 'erro_professor';
        }
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
        if ($status >= 3) {
            return 'Aprovado';
        }
    }

    public function primeiro_acesso(Curso $curso) {
        $this->curso = $curso;
        $this->setCurso_post();
//        $this->curso->setStatus(1);
        $this->updateCurso($this->curso);
        $this->controller = new controllerModulo();
        for ($i = 0; $i < $this->curso->getNumero_modulos(); $i++) {
            $modulo = new Modulo();
            $modulo->setId_curso($this->curso->getId_curso());
            $modulo->setNumero_modulo($i + 1);
            $this->controller->inserirModulo($modulo);
        }
        $modulos = $this->controller->getListaModulo("id_curso=" . $this->curso->getId_curso());
        for ($i = 0; $i < count($modulos); $i++) {
            $this->controller->criaDiretorioModulo($modulos[$i]);
        }
    }

    public function aprovarCurso($id_curso) {
        $curso = $this->getCurso('id_curso=' . $id_curso);
        if ($curso->getStatus() == 1) {
            $curso->setStatus(3);
            return $this->updateCurso($curso);
        }
        if ($curso->getStatus() == 0) {
            return 2;
        }
        return 0;
    }

    public function reprovarCurso($id_curso) {
        $curso = $this->getCurso('id_curso=' . $id_curso);
        if ($curso->getStatus() == 1) {
            $curso->setStatus(2);
            return $this->updateCurso($curso);
        }
        if ($curso->getStatus() == 2) {
            return 2;
        }
        return 0;
    }

    public function habilitarCurso($id_curso, $chave) {
        $curso = $this->getCurso('id_curso=' . $id_curso);
        if ($curso->getStatus() > 1) {
            if ($chave) {
                $curso->setStatus(4);
            } else {
                $curso->setStatus(3);
            }
            return $this->updateCurso($curso);
        }
        return 0;
    }

    public function submeter_analiseCurso($id_curso) {
        $curso = $this->getCurso('id_curso=' . $id_curso);
        if ($curso->getStatus() == 0 || $curso->getStatus() == 2) {
            $curso->setStatus(1);
            return $this->updateCurso($curso);
        }
        return 0;
    }

    public function tabelaGerenciar_matricula($id_usuario) {
        $tabela = "<table id='tabela_matricula_cursos' width='100%' align='center' class='display'>
         <thead> 
                <tr> 
                    <th>Curso</th> 
                    <th>Status acesso</th> 
                    <th>Progresso</th>
                    <th>Data início</th>
                    <th>Data término</th>
                </tr> 
            </thead> 
            <tbody id='tbody_tb_ger_matricula'>";

        $cursoDAO = new CursoDAO();

        $this->cursos = $cursoDAO->select(null, null);

        $quant = count($this->cursos);
        $i = 0;
        $controller = new controllerMatricula_curso();
        for (; $i < $quant; $i++) {
            $m = $controller->getMatricula_curso('id_curso=' . $this->cursos[$i]->getId_curso() . ' AND id_usuario=' . $id_usuario);
            if ($m != null) {
                $tabela .= "<tr name='matricula' id=" . $m->getId_matricula_curso() . ">";
                $tabela .= "<td width='49%' id='nome'>" . $this->cursos[$i]->getNome() . "</td>";
                if ($m->getStatus_acesso() == 1) {
                    $tabela .= "<td width='14%' id='status' align='center'><input type='checkbox' value='0' checked='checked' name='" . $m->getId_matricula_curso() . "' id='check_liberar_matricula' /></td>";
                } else {
                    $tabela .= "<td width='14%' id='status' align='center'><input type='checkbox' value='1' id='check_liberar_matricula' name='" . $m->getId_matricula_curso() . "' /></td>";
                }
                //Calculando Desempenho
                $p = number_format($this->analise_progresso($this->cursos[$i], $m), 2);
                $tabela .= "<td width='11%' id='progresso' align='center'>" . $p . "%</td>";
                $tabela .= "<td width='13%' id='data_inicio' align='center'>" . $m->getData_inicio() . "</td>";
                $tabela .= "<td width='13%' id='data_termino' align='center'><input type='text' value='" . $m->getData_fim() . "' id='data-" . $m->getId_matricula_curso() . "' name='" . $m->getId_matricula_curso() . "' class='i_data_termino' /></td>";
            } else {
                $tabela .= "<tr name='nova_matricula' id='" . $this->cursos[$i]->getId_curso() . "'>";
                $tabela .= "<td width='49%' id='nome'>" . $this->cursos[$i]->getNome() . "</td>";
                $tabela .= "<td width='14%' id='status' align='center'>Não Matriculado</td>";
                $tabela .= "<td width='11%' id='progresso' align='center'> -- </td>";
                $tabela .= "<td width='13%' id='data_inicio' align='center'> -- </td>";
                $tabela .= "<td width='13%' id='data_termino' align='center'> -- </td>";
            }
            $tabela .= "</tr>";
        }

        $tabela .= "</tbody></table>";
        return $tabela;
    }

    /*
     * Conta simples:
     * O progesso é a porc relativa do módulo atual + porc relativa de exercicios concluidos no módulo
     */
    public function analise_progresso(Curso $c, Matricula_curso $mc) {
        $controller = new controllerModulo();
        $modulo = $controller->getModulo("id_curso=" . $c->getId_curso() . " AND numero_modulo=" . $mc->getModulo_atual());
        $qnt_exer = $controller->getQuantidadeExercicios($modulo->getId_modulo());
        $y = (100 / $c->getNumero_modulos()) / $qnt_exer;
        $p = $mc->getModulo_atual() * (100 / $c->getNumero_modulos()) + $y;
        return $p;
    }

    /*
     * Conta simples:
     * Média de acertos entre os exercícios que já fez - por módulo;
     */
    public function analise_desempenho(Curso $c, Matricula_curso $mc) {
        $ctr_modulo = new controllerModulo();
        $ctr_usuario_exer = new controllerUsuario_exercicio();
        $num_mod = $mc->getModulo_atual();
        $soma_desem = 0;
        $total_exer = 0;
        //percorrendo módulo
        while ($num_mod) {
            $modulo = $ctr_modulo->getModulo("id_curso=" . $c->getId_curso() . " AND numero_modulo=" . $num_mod);
            $lista = $ctr_usuario_exer->getListaUsuario_exercicios('id_modulo='.$modulo->getId_modulo());
            $i = 0;
            $aux = 0;
            //percorrendo exercícios do módulo
            for($i = 0; $i < count($lista); $i++){
                $aux = $lista[$i]->getPorc_acertos();
            }
            //armazenando estatísticas base
            $soma_desem += $aux;
            $total_exer += $i;
            $num_mod--;
        }
        //estatística (média) final
        $desempenho_final = $soma_desem/$total_exer;                
        return $desempenho_final;
    }

}

?>
