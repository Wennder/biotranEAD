<?php

class ControllerIndex extends Biotran_Mvc_Controller{
    
    
    public function actionIndex() {
        //$this->visao->titulo = "Blog Planeta Framework";
        $this->renderizar();
//        echo "Sou a acao inicial";
    }
        
    public function actionLogin() {
        $this->visao->login = $_POST["login"];
        $this->visao->senha = $_POST["senha"];
        $this->renderizar();
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
