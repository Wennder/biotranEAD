<?php

class ControllerEad extends Biotran_Mvc_Controller {
    
    private $controller;
    
    public function actionLogin(){
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $controllerSeguranca = new ControllerSeguranca();
        $resposta = $controllerSeguranca->actionValidarLogin_ajax($login, $senha);        
        if($resposta == 'validado'){
            Biotran_Mvc::pegarInstancia()->mudarAcao('Index');            
        }else{            
            if ($resposta == 'invalido') {
                Biotran_Mvc::pegarInstancia()->mudarControlador('Index');
                Biotran_Mvc::pegarInstancia()->mudarAcao('Index');
                $this->visao->invalidado = true;
            } else {
                //usuario inexistente
                if ($resposta == 'cadastrar') {
                    Biotran_Mvc::pegarInstancia()->mudarControlador('Index');
                    Biotran_Mvc::pegarInstancia()->mudarAcao('Cadastrar');
                    $this->visao->invalidado = true;
                }
            }        
        }             
    }
    
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
        } else {
            $this->visao->usuario = null;
        }

        //Monta a tabela de usuários        
        $this->visao->tabela = $this->controller->tabelaUsuarios();
        $this->renderizar();
    }
    
    public function actionAtualizarCadastro(){
        $this->controller = new controllerUsuario();
        $id_usuario = Biotran_Mvc::pegarInstancia()->pegarId();
        if($id_usuario != ''){
            $this->controller->atualizarUsuario_ead($id_usuario);
        }
        
        $this->visao->tabela = $this->controller->tabelaUsuarios();
        $this->renderizar();
    }

    public function actionGerenciar_cursos() {
        $this->visao->titulo = "Gerenciar Cursos";
        $this->renderizar();
    }

    public function actionCadastrar_usuario() {
        $ctrl = new controllerUsuario();
        $ctrl->novoUsuario_ead();
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
        $this->visao->usuarioLogado = $_SESSION['usuarioLogado'];
        $this->renderizar();
    }

    public function actionAcesso_negado() {
        $this->renderizar();
    }
    
}

?>
