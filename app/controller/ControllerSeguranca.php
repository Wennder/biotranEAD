<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include ROOT_PATH . '/app/model/seguranca/Seguranca.php';

/**
 * Description of ControllerSeguranca
 *
 * @author cead-p057007
 */
class ControllerSeguranca {

    private $papeis;
    private $seguranca;

    public function __construct() {
        $this->setPapeis();
        $this->seguranca = new Seguranca();
    }    

    /*
     * retorna sempre uma lista de papeis dos sistema no banco
     */
    public function getPapeis() {
        return $this->papeis;
    }

    public function setPapeis() {
        $dao = new PapelDAO();
        $this->papeis = $dao->select();
    }        

    public function actionValidarLogin_ajax($login, $senha) {
        return $this->seguranca->validarLogin($login, $senha);
    }
    
    //trata de acordo com o retorno da funcao validarLogin da classe seguranca.
    public function tratarValidacaoLogin_ajax($validacao) {
        if ($validacao == 'usuario validado') {
            //se usuario for validado, então a ação é alterada para direcionar 
            //a pagina de acordo com o papel do usuario
            $valores = array(
                'validacao' => 'validado',
                'controlador' => 'ead',
                'acao' => 'index'
            );
            return $valores;
        } else {
            if ($validacao == 'senha invalida') {
                $valores = array(
                    'validacao' => 'invalido'
                );
                return $valores;
            } else {
                if ($validacao == 'nao cadastrado') {
                    $valores = array(
                        'validacao' => 'cadastrar'
                    );
                    return $valores;
                }
            }
        }
    }
    
    public function actionLiberarAcesso($pagina){
        
        return $this->seguranca->isPapel_pagina($pagina);            
    }

    public function acaoEnviarSenhaEmail($login) {
        
    }

}

?>
