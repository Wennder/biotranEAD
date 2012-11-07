<?php

class ControllerEad extends Biotran_Mvc_Controller {

    private $controller = null;

    public function actionIndex() {
        $this->visao->usuarioLogado = $_SESSION['usuarioLogado'];
        $this->renderizar();
    }

    public function actionVisualizar_modulo() {
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->controller = new controllerCurso();
        $this->visao->curso = $this->controller->getCurso("id_curso = " . $id_curso);
        $this->renderizar();
    }

    public function actionConteudo_modulo() {
        if (isset($_REQUEST['id_curso'])) {
            $id_curso = $_REQUEST['id_curso'];
            $this->controller = new controllerModulo();
            $modulos_curso = $this->controller->getListaModulo("id_curso=" . $id_curso . " ORDER BY numero_modulo");
            $this->visao->modulo = $modulos_curso[0];
        } else {
            $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
            $this->controller = new controllerModulo();
            $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo);
        }
        $this->visao->listaVideo = $this->controller->visualizar_listaVideo_aulas_modulo($this->visao->modulo->getId_modulo());
        $this->visao->listaTexto = $this->controller->listaArquivos($this->visao->modulo, 'texto_referencia');
        $this->visao->listaMaterial = $this->controller->listaArquivos($this->visao->modulo, 'material_complementar');
        $this->visao->listaExercicio = $this->controller->listaExercicio($this->visao->modulo->getId_modulo());
        
        $this->renderizar();
    }

    public function actionCadastrar_usuario() {
        $this->controller = new controllerUsuario();
        if ($this->controller->validarLogin($_POST["email"])) {
            $this->controller->inserirNovoUsuario_post();
            Biotran_Mvc::pegarInstancia()->mudarAcao('gerenciar_usuarios');
            $this->renderizar();
        } else {
            trigger_error("1 Reenvio de formulario, usuario ja cadastrado");
        }
    }

    public function actionGerenciar_usuarios() {
        $this->visao->titulo = "Gerenciar Usuários";
        $this->controller = new controllerUsuario();
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        if ($id_usuario != '') {
            $this->visao->usuario = $this->controller->getUsuario("id_usuario=" . $id_usuario . "");
            $this->visao->endereco = $this->controller->getEndereco_usuario($id_usuario);
        } else {
            $this->visao->usuario = null;
            $this->visao->endereco = null;
        }
        //Monta a tabela de usuários        
        $this->visao->tabela = $this->controller->tabelaUsuarios();
        $this->renderizar();
    }

    public function actionGerenciar_usuarios_1() {
        $this->visao->titulo = "Gerenciar Usuários";
        $this->controller = new controllerUsuario();
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        if ($id_usuario != '') {
            $this->visao->usuario = $this->controller->getUsuario("id_usuario=" . $id_usuario . "");
            $this->visao->endereco = $this->controller->getEndereco_usuario($id_usuario);
        } else {
            $this->visao->usuario = null;
            $this->visao->endereco = null;
        }
        //Monta a tabela de usuários        
        $this->visao->tabela = $this->controller->tabelaUsuarios();
        $this->renderizar();
    }

    public function actionCursos_professor() {
        $this->controller = new controllerCurso();
        $id_usuario = $_SESSION['usuarioLogado']->getId_usuario();
        $this->visao->lista = $this->controller->listaCursos_professor($id_usuario);

        $this->visao->usuario = $_SESSION['usuarioLogado'];
        $this->renderizar();
    }

    public function actionAtualizar_cadastro_usuario() {
        $this->controller = new controllerUsuario();
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        if ($id_usuario != '') {
            $this->controller->atualizarUsuario_post($id_usuario);
        }
        Biotran_Mvc::pegarInstancia()->mudarAcao('index');
//        $this->visao->tabela = $this->controller->tabelaUsuarios();
        $this->renderizar();
    }

    public function actionAtualizar_cadastro_admin() {
        $this->controller = new controllerUsuario();
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        if ($id_usuario != '') {
            $this->controller->atualizarUsuario_post($id_usuario);
            Biotran_Mvc::pegarInstancia()->mudarAcao('gerenciar_usuarios');
        }

        $this->visao->tabela = $this->controller->tabelaUsuarios();
        $this->renderizar();
    }

    public function actionGerenciar_cursos() {
        $this->visao->titulo = "Gerenciar Cursos";

        $this->controller = new controllerCurso();
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = null;
        if ($id_curso != '') {
            $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
            $this->visao->optionsPC = $this->controller->comboProfessores_curso($id_curso);
            $this->visao->optionsPD = $this->controller->comboProfessoresDisponiveis($id_curso);
        } else {
            $this->visao->optionsTP = $this->controller->comboTodos_Professores();
        }
        //print_r($this->visao->curso);die();
        //Monta a tabela de cursos            
        $this->visao->tabela = $this->controller->tabelaCursos();
        $this->renderizar();
    }

    public function actionCadastrar_curso() {

        $this->controller = new controllerCurso();
        //$_POST['destino'] - destino é o select dos professores responsaveis
        if ($this->controller->validarNome($_POST['nome']) && count($_POST["destino"]) > 0) {
            $this->controller->novoCurso_post();

            Biotran_Mvc::pegarInstancia()->mudarAcao('gerenciar_cursos');
            $this->actionGerenciar_cursos();
            // $this->renderizar();
        } else {
            trigger_error("1 Reenvio de formulario, curso ja cadastrado");
        }
    }

    public function actionDados_pessoais() {
        $this->controller = new controllerUsuario();
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->usuario = $this->controller->getUsuario("id_usuario=" . $id_usuario . "");
        $this->visao->endereco = $this->controller->getEndereco_usuario($id_usuario);

        $this->renderizar();
    }

    public function actionProfile() {
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $usuarioDAO = new UsuarioDAO();
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->usuario = $usuarioDAO->select("id_usuario=" . $id_usuario . "");
        $this->visao->usuario = $this->visao->usuario[0];
        $this->visao->usuarioLogado = $_SESSION['usuarioLogado'];
        $this->renderizar();
    }

    public function actionAcesso_negado() {
        $this->renderizar();
    }

    public function actionAtualizar_curso() {
        if (count($_POST["destino"]) == 0) {
            trigger_error("1 Reenvio de formulario, curso ja cadastrado");
        } else {

            $this->controller = new controllerCurso();
            $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
            if ($id_curso != '') {
                $this->controller->atualizarCurso_post($id_curso);
            }
            //$_GET['a'] = 'gerenciar_curso';
            Biotran_Mvc::pegarInstancia()->mudarAcao('index');
//        $this->visao->tabela = $this->controller->tabelaUsuarios();
            $this->renderizar();
        }
    }

    public function actionTodos_cursos() {
        $this->renderizar();
    }

    public function actionCurso() {
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->controller = new controllerCurso();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        $this->renderizar();
    }

    public function actionMatricula() {
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->controller = new controllerCurso();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        $this->renderizar();
    }

    public function actionEditar_modulo_talvez_nao_faca_nada() {
        $this->controller = new controllerCurso();
        $this->visao->options = $this->controller->comboCursos();
//        if ($this->visao->options != null) {
//            $this->renderizar();
//        }//possivel parada de erro
        $this->renderizar();
    }

    public function actionCadastrar_modulo() {
        $this->controller = new controllerCurso();
        $this->visao->options = $this->controller->comboCursos();
        if ($this->visao->options != null) {
            $this->renderizar();
        }//possivel parada de erro
        $this->renderizar();
    }

    public function actionAdicionar_videoaula() {
        $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->controller = new controllerModulo();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo);
        $this->renderizar();
    }

    public function actionAdicionar_bibliografia() {
        $this->renderizar();
    }

    public function actionCadastrar_primeiro_acesso_curso() {
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        if ($this->visao->curso->getStatus(1) == 0) {
            $this->controller->primeiro_acesso($this->visao->curso);
        }
        Biotran_Mvc::pegarInstancia()->mudarAcao('gerenciar_curso');
        $this->renderizar();
    }

    public function actionEditar_curso() {
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        if ($this->visao->curso->getNumero_modulos() == 0) {
            Biotran_Mvc::pegarInstancia()->mudarAcao('primeiro_acesso_curso');
        }
        $this->renderizar();
    }

    public function actionProfessor_editar_curso() {
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        if ($this->visao->curso->getNumero_modulos() == 0) {
            Biotran_Mvc::pegarInstancia()->mudarAcao('primeiro_acesso_curso');
        }
        $this->renderizar();
    }

    public function actionGerenciar_curso() {
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        if ($this->visao->curso->getNumero_modulos() == 0) {
            Biotran_Mvc::pegarInstancia()->mudarAcao('primeiro_acesso_curso');
        }
        $this->renderizar();
    }

    public function actionPrimeiro_acesso_curso() {
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        $this->renderizar();
    }

    public function actionEditar_modulo() {
        $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->controller = new controllerModulo();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo . "");
        $this->visao->listaVideo = $this->controller->listaVideo_aulas_modulo($id_modulo);
        $this->visao->listaTexto = $this->controller->listaArquivos($this->visao->modulo, 'texto_referencia');
        $this->visao->listaMaterial = $this->controller->listaArquivos($this->visao->modulo, 'material_complementar');
        $this->visao->listaExercicio = $this->controller->listaExercicio($id_modulo);
        $this->renderizar();
    }

    public function actionAdicionar_texto_referencia() {
        $this->controller = new controllerModulo();
        $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo . "");
        $this->renderizar();
    }

    public function actionAdicionar_material_complementar() {
        $this->controller = new controllerModulo();
        $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo . "");
        $this->renderizar();
    }

    public function actionJanela_video() {
        $this->controller = new controllerVideo();
        $id_video = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->video = $this->controller->getVideo('id_video=' . $id_video);
        $this->controller = new controllerModulo();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $this->visao->video->getId_modulo() . "");
        $this->visao->caminho = "cursos/" . $this->visao->modulo->getId_curso() . "/modulos/" . $this->visao->video->getId_modulo() . "/video_aula/" . $this->visao->video->getId_video() . ".mp4";
        $this->renderizar();
    }

    public function actionAdicionar_exercicio() {
        $this->controller = new controllerModulo();
        $id_modulo = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->modulo = $this->controller->getModulo("id_modulo=" . $id_modulo . "");
        $this->renderizar();
    }

    public function actionEditar_exercicio() {
        $this->controller = new controllerExercicio();
        $id_exercicio = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->exercicio = $this->controller->getExercicio("id_exercicio=" . $id_exercicio . "");
        $this->visao->listaPerguntas = $this->controller->listaPerguntas($id_exercicio);
        $this->renderizar();
    }

}

?>
