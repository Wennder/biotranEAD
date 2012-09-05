<?php

class ControllerEad extends Biotran_Mvc_Controller {

    private $controller = null;    

    public function actionIndex() {
        $this->visao->usuarioLogado = $_SESSION['usuarioLogado'];
        $this->renderizar();
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

    public function actionAtualizar_cadastro_admin(){
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
        } 
        //Monta a tabela de cursos
        $this->visao->tabela = $this->controller->tabelaCursos();
        
        $this->visao->optionsTP = $this->controller->comboTodos_Professores();
        $this->renderizar();
    }

    public function actionCadastrar_curso() {
        $this->controller = new controllerCurso();
        $this->controller->novoCurso_post();
        Biotran_Mvc::pegarInstancia()->mudarAcao('gerenciar_cursos');        
        $this->renderizar();
    }

    public function actionCadastrar_usuario() {
        $this->controller = new controllerUsuario();
        if ($this->controller->validarLoginCadastro($_POST["email"])) {
            $this->controller->inserirNovoUsuario_post();
            Biotran_Mvc::pegarInstancia()->mudarAcao('gerenciar_usuarios');
            $this->renderizar();
//          $this->actionGerenciar_usuarios();
        }else{
            //redirecionar página,TRATAR LOGIN sei lá.
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
    
    public function actionAtualizar_curso(){
        $this->controller = new controllerCurso();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();            
        if ($id_curso != '') {
            $this->controller->atualizarCurso_post($id_curso);
        }
        Biotran_Mvc::pegarInstancia()->mudarAcao('index');
//        $this->visao->tabela = $this->controller->tabelaUsuarios();
        $this->renderizar();
    }

}

?>
