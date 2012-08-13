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
class ControllerSeguranca{
    
    private $seguranca;
    
    public function __construct(){
        $this->seguranca = new Seguranca();
    }
    
    public function acaoValidar($login, $senha){                
        $this->tratarValidacao($this->seguranca->validarLogin($login, $senha));
    }
    
    //trata de acordo com o retorno da funcao validarLogin da classe seguranca.
    public function tratarValidacao($validacao){
        if($validacao == 'usuario validado'){
            //se usuario for validado, então a ação é alterada para direcionar 
            //a pagina de acordo com o papel do usuario
            Biotran_Mvc::pegarInstancia()->mudarControlador('ead');
            Biotran_Mvc::pegarInstancia()->mudarAcao('index');
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
