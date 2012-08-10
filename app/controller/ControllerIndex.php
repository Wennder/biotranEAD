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
//        echo "Sou a acao inicial";
    }
}

?>
