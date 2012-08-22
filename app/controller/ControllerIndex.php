<?php

class ControllerIndex extends Biotran_Mvc_Controller{            
    
    private $controller;
    
    public function actionIndex() {                               
        $this->renderizar(); 
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
