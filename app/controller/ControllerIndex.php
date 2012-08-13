<?php

include "../app/model/vo/Usuario.php";
include "../app/model/vo/Papel.php";
include "../app/model/vo/Endereco.php";
include "../app/model/pdo/PDOConnectionFactory.class.php";

class ControllerIndex {
    
    private $controlSeguranca;
    private $mvc_controller;
    
    public function __construct() {
        $this->controlSeguranca = new ControllerSeguranca();
        $this->mvc_controller = new Biotran_Mvc_Controller();
    }
    
    public function actionIndex() {
        //echo 'aqui--'; die();
        //$this->visao->titulo = "Blog Planeta Framework";
        $this->mvc_controller->renderizar();        
//        echo "Sou a acao inicial";
    }
        
    public function actionLogin() {
        
        $this->visao->login = $_POST["login"];
        $this->visao->senha = $_POST["senha"];
        //echo 'aqui'; die();
        $this->controlSeguranca->acaoValidar($this->visao->login, $this->visao->senha);                
        //echo $this->visao->login; die();
        $this->mvc_controller->renderizar();        
//        echo "Sou a acao inicial";
    }
}

?>
