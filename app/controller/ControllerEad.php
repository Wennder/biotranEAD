<?php

class ControllerEad extends Biotran_Mvc_Controller {

    private $controller = null;

    public function actionIndex() {
        $this->visao->usuarioLogado = $_SESSION['usuarioLogado'];
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

    public function actionListaCursos_professor() {
        $this->controller = new controllerCurso();
        $this->visao->lista = $this->controller->listaCursos_professor();
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

    public function actionMatricula(){
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->controller = new controllerCurso();
        $this->visao->curso = $this->controller->getCurso("id_curso=" . $id_curso . "");
        $this->renderizar();
    }
    
    public function actionAdicionar_modulo(){
        $this->renderizar();
    }
    
    public function actionAdicionar_videoaula(){
        $this->renderizar();
    }
    
    public function actionAdicionar_bibliografia(){
        $this->renderizar();
    }
    
    public function actionAdicionar_materialcomplementar(){
        $this->renderizar();
    }
    
}

?>
