<?php

class ControllerIndex extends Biotran_Mvc_Controller{            
    
    private $controller;

    public function actionLogin_ajax($login, $senha) {               
        $this->controller = new ControllerSeguranca();
        return $this->controller->actionValidarLogin_ajax($login, $senha);        
    }
    
    public function actionLogin() {
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $this->controller = new ControllerSeguranca();
        $resposta = $this->controller->actionValidarLogin($login, $senha);
        if ($resposta == 'validado') {    
            Biotran_Mvc::pegarInstancia()->mudarControlador('ead');
            Biotran_Mvc::pegarInstancia()->mudarAcao('index');
            $this->visao->invalidado = 0;
        } else {
            if ($resposta == 'invalido') {                
                Biotran_Mvc::pegarInstancia()->mudarAcao('index');
                $this->visao->invalidado = 1;
            } else {
                //usuario inexistente
                if ($resposta == 'cadastrar') {                                        
                    Biotran_Mvc::pegarInstancia()->mudarAcao('cadastro');                    
//                    $this->visao->invalidado = true;
                }
            }
        }
    }
        
    public function actionIndex() {
//        $this->visao->invalidado = 0;
        $this->renderizar(); 
    }
    
    public function actionRecuperar_senha(){
        $this->renderizar(); 
    }
    
    public function actionCadastro() {
        $this->visao->titulo = "Cadastrar Usuário";
        $this->renderizar();
    }
    
    public function actionCadastrar_usuario() {
        $this->visao->titulo = "Cadastrar Usuário";
        $ctrl = new controllerUsuario();
        $ctrl->inserirNovoUsuario_post();
        Biotran_Mvc::pegarInstancia()->mudarAcao('index');
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
    
    public function actionExibir_curso() {
        //Pega a id passa na url e monta o objeto buscando os dados no banco
        $cursoDAO = new CursoDAO();
        $id_curso = Biotran_Mvc::pegarInstancia()->pegarId();
        $this->visao->curso = $cursoDAO->select("id_curso=" . $id_curso . "");
        $this->visao->curso = $this->visao->curso[0];
        $this->renderizar();
    }
}

?>
