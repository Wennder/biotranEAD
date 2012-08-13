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
}

?>
