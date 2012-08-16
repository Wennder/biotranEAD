<?php


class ControllerEad extends Biotran_Mvc_Controller{   
    
    public function actionIndex() {
        $this->visao->titulo = "EAD Biotran";
        $this->renderizar();
    }
    
    public function actionGerenciar_usuarios() {
        $this->visao->titulo = "Gerenciar Usuários";
        $ctrl = new controllerUsuario();        
        $this->visao->usuario = $ctrl->getUsuario('id_usuario = 33');
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
    
    public function actionProfile() {
        $ctrl = new controllerUsuario();        
        $this->visao->usuario = $ctrl->getUsuario('id_usuario = 33');
        $this->renderizar();
    }        

}
?>
