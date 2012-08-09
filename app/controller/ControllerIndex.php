<?php

class ControllerIndex extends Biotran_Mvc_Controller{

    public function actionIndex() {
        $this->visao->titulo = "Blog Planeta Framework";
        $this->renderizar();
    }
    
    public function actionCadastro() {
        $this->visao->titulo = "Cadastrar Usuário";
        $this->renderizar();
    }
    
    public function actionContato() {
        $this->visao->titulo = "Cadastrar Usuário";
        $this->renderizar();
    }
}

?>
