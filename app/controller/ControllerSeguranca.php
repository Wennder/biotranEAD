<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include '../app/model/seguranca/Seguranca.php';
/**
 * Description of ControllerSeguranca
 *
 * @author cead-p057007
 */
class ControllerSeguranca extends Biotran_Mvc_Controller{
    
    private $seguranca;
    
    public function acaoValidar(){
        $this->seguranca = new Seguranca();
        //capturar login e senha via post
        $this->visao->login = $_POST["login"];
        $this->visao->senha = $_POST["senha"];
        
        $this->tratarValidacao($this->seguranca->validarLogin($this->visao->login, $this->visao->senha));
        $this->renderizar();
    }
    
    public function tratarValidacao($validacao){
        if($validacao == 'usuario validado'){
            //se usuario for validado, então a ação é alterada para direcionar 
            //a pagina de acordo com o papel do usuario
            Biotran_Mvc::pegarInstancia()->mudarAcao($_SESSION["usuarioLogado"]->getPapel()->getPapel());
        }else{
            if($validacao == 'senha invalida'){
                Biotran_Mvc::pegarInstancia()->mudarAcao('senhainvalida');
            }else{
                if($validacao == 'nao cadastrado'){
                    Biotran_Mvc::pegarInstancia()->mudarAcao('naocadastrado');
                }
            }
        }
        
    }
    
}

?>
