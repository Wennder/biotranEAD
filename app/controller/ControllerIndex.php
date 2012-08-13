<?php

include "../app/model/vo/Usuario.php";
include "../app/model/vo/Papel.php";
include "../app/model/vo/Endereco.php";
include "../app/model/dao/UsuarioDAO.php";

class ControllerIndex extends Biotran_Mvc_Controller{
    
    
    public function actionIndex() {
        //$this->visao->titulo = "Blog Planeta Framework";
        $this->renderizar();        
//        echo "Sou a acao inicial";
    }
        
    public function actionLogin() {
        $this->visao->login = $_POST["login"];
        $this->visao->senha = $_POST["senha"];
        
        //TESTE DE INSERCAO
        $user = new Usuario();
        $user->setAtuacao($this->visao->login);
        $user->setCpf(123);
        $user->setData_nascimento($this->visao->login);
        $user->setDescricao_pessoal($this->visao->login);
        $user->setEmail($this->visao->login);
        $user->setId_profissional(123);        
        $user->setLogin($this->visao->login);
        $user->setNome_completo($this->visao->login);
        
        $papel = new Papel();
        $papel->setId_papel(1);
        $papel->setPapel('teste1');
        
        $user->setPapel($papel);
        $user->setRg(123);
        $user->setSenha($this->visao->senha);
        $user->setSexo($this->visao->login);
        $user->setTel_celular($this->visao->login);
        $user->setTel_residencial($this->visao->login);        
        
        $end1 = new Endereco();
        $end2 = new Endereco();
        
        $end1->setBairro("qwe");
        $end1->setCidade("qwe");
        $end1->setComplemento("qwe");
        $end1->setNumero(123);        
        $end1->setRua("qwe");
        
        $end2->setBairro("qwe");
        $end2->setCidade("qwe");
        $end2->setComplemento("qwe");
        $end2->setNumero(123);
        $end2->setRua("qwe");
        
        $userDAO = new UsuarioDAO();
        $userDAO->insert($user, $end1, $end2);
        $this->renderizar();
//        echo "Sou a acao inicial";
    }
}

?>
