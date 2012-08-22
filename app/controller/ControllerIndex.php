<?php

class ControllerIndex extends Biotran_Mvc_Controller{            
    
    private $controller;
    
    public function actionIndex() {                               
        $this->renderizar(); 
    }
    
    public function actionLogin() {
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $controllerSeguranca = new ControllerSeguranca();
        $resposta = $controllerSeguranca->actionValidarLogin_ajax($login, $senha);
        if ($resposta == 'validado') {
            Biotran_Mvc::pegarInstancia()->mudarAcao('Index');
        } else {
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
    
    public function actionLembrarSenha(){
        $this->controller = new controllerUsuario();        
        $cpf_passaporte = $_POST["cpf_passaporte"];
        //captura e-mail do usuario a partir do cpf, através do controlador usuario
        $email = $this->controller->getUsuario("cpf_passaporte='".$cpf_passaporte."'")->getEmail();
    }
    
    public function actionCadastro() {
        $this->visao->titulo = "Cadastrar Usuário";
        $this->renderizar();
    }
    
    public function actionCadastrar_usuario() {
        $this->visao->titulo = "Cadastrar Usuário";
        $ctrl = new controllerUsuario();
        $ctrl->novoUsuario_ead();                
        $this->renderizar();
    }
    
    public function actionContato() {
        $this->visao->titulo = "Contato";
        $this->renderizar();
    }
    
    public function actionCursos() {
        $this->visao->titulo = "Cursos";
        $this->renderizar();
    }
    
    public function actionFotos() {
        $this->visao->titulo = "Fotos";
        $this->renderizar();
    }
}

?>
