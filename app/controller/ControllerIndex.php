<?php

class ControllerIndex extends Biotran_Mvc_Controller{            
    
    public function actionIndex() {                               
        $this->renderizar(); 
    }            
    
    public function actionLembrarSenha(){
        $this->visao->login = $_POST["login"];
    }
    
    public function actionCadastro() {
        $this->visao->titulo = "Cadastrar Usuário";
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
