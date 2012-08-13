<?php

class ControllerEad extends Biotran_Mvc_Controller{

    public function actionIndex() {
        $this->visao->titulo = "EAD Biotran";
        $this->renderizar();
    }
    
    public function actionGerenciar_usuarios() {
        $this->visao->titulo = "Gerenciar Usuários";
        $this->renderizar();
    }
    
    public function actionGerenciar_cursos() {
        $this->visao->titulo = "Gerenciar Cursos";
        $this->renderizar();
    }

}
?>
