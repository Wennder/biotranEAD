<?php

class ControllerEad extends Biotran_Mvc_Controller {

    public function actionIndex() {
        $this->visao->titulo = "EAD Biotran";
        $this->renderizar();
    }

    public function actionGerenciar_usuarios() {
        $this->visao->titulo = "Gerenciar Usuários";

//        $usuarioDAO = new UsuarioDAO();        
//        $this->visao->usuario = $usuarioDAO->select("id_usuario=33");
//        $this->visao->usuario = $this->visao->usuario[0];

        $controllerUsuario = new controllerUsuario();
        $this->visao->tabela = $controllerUsuario->tabelaUsuarios();

        $this->renderizar();
    }

    public function actionGerenciar_cursos() {
        $this->visao->titulo = "Gerenciar Cursos";
        $this->renderizar();
    }

    public function actionCadastrar_usuario() {
        $ctrl = new controllerUsuario();
        $ctrl->novoUsuario();
        Biotran_Mvc::pegarInstancia()->mudarAcao('gerenciar_usuarios');
        $this->renderizar();
    }

    public function actionDados_pessoais() {
//        $usuarioDAO = new UsuarioDAO();
//        $this->visao->usuario = new Usuario();
//        $this->visao->usuario = $usuarioDAO->select("id_usuario=33");
        $this->visao->usuario;
        $this->renderizar();
    }

    public function actionProfile() {
        $usuarioDAO = new UsuarioDAO();
        $this->visao->usuario = $usuarioDAO->select("id_usuario=33");
        $this->visao->usuario = $this->visao->usuario[0];
//        $this->visao->usuario;// = $_SESSION["usuarioLogado"];
        $this->renderizar();
    }

}

?>
