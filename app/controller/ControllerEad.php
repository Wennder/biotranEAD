<?php

//include "../app/model/vo/Usuario.php";

class ControllerEad extends Biotran_Mvc_Controller{

    public function actionIndex() {
        $this->visao->titulo = "EAD Biotran";
        $this->renderizar();
    }
    
    public function actionGerenciar_usuarios() {
        $this->visao->titulo = "Gerenciar Usuários";
        $usuarioDAO = new UsuarioDAO();
//        $this->visao->usuario = null;
        $this->visao->usuario = new Usuario();
        $this->visao->usuario = $usuarioDAO->select(null, "id_usuario=33")->fetchObject("Usuario");
        $this->visao->usuarios = $usuarioDAO->selectAll();
//        echo $this->visao->usuarios[0]->getNome_completo();
//        die();
        $this->renderizar();
    }
    
    public function actionGerenciar_cursos() {
        $this->visao->titulo = "Gerenciar Cursos";
        $this->renderizar();
    }
    
    public function actionCadastrar_usuario() {
//        $usuarioDAO = new UsuarioDAO();
//        $this->visao->usuario = new Usuario();
//        $this->visao->usuario = $usuarioDAO->select("id_usuario, nome_completo", "id_usuario=33")->fetchObject("Usuario");
        $this->renderizar();
    }

}
?>
