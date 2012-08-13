<?php

include "../app/model/vo/Usuario.php";
include "../app/model/vo/Papel.php";
include "../app/model/vo/Endereco.php";
include "../app/model/pdo/PDOConnectionFactory.class.php";

class ControllerIndex extends Biotran_Mvc_Controller{            
    
    public function actionIndex() {
        $this->visao->titulo = "TESTE TITULO";
        $this->renderizar(); 
    }
        
    public function actionLogin() {
        $this->visao->login = $_POST["login"];
        $this->visao->senha = $_POST["senha"];
        $this->controllerSeguranca->acaoValidar($this->visao->login, $this->visao->senha);
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
