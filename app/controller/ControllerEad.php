<?php

class ControllerEad extends Biotran_Mvc_Controller {

    public function actionIndex() {
        $this->visao->titulo = "EAD Biotran";
        $this->renderizar();
    }

    public function actionGerenciar_usuarios() {
        $this->visao->titulo = "Gerenciar Usuários";

        $usuarioDAO = new UsuarioDAO();
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        if ($id_usuario != '') {
            $this->visao->usuario = $usuarioDAO->select("id_usuario=" . $id_usuario . "");
            $this->visao->usuario = $this->visao->usuario[0];
        }
        else{
            $this->visao->usuario = null;
        }
        
        //Monta a tabela de usuários
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
//        $this->actionGerenciar_usuarios();
    }

    public function actionDados_pessoais() {
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $usuarioDAO = new UsuarioDAO();
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->usuario = $usuarioDAO->select("id_usuario=" . $id_usuario . "");
        $this->visao->usuario = $this->visao->usuario[0];
        $this->renderizar();
    }

    public function actionProfile() {
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $usuarioDAO = new UsuarioDAO();
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->usuario = $usuarioDAO->select("id_usuario=" . $id_usuario . "");
        $this->visao->usuario = $this->visao->usuario[0];
        $this->renderizar();
    }

}

?>
