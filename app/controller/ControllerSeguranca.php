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
        return $this->tratarValidacaoLogin_ajax($this->seguranca->validarLogin($login, $senha));
    }

    public function actionValidarLogin($login, $senha) {
        return $this->seguranca->validarLogin($login, $senha);
    }

    //trata de acordo com o retorno da funcao validarLogin da classe seguranca.
    public function tratarValidacaoLogin_ajax($validacao) {
        if ($validacao == 'validado') {
            //se usuario for validado, então a ação é alterada para direcionar 
            //a pagina de acordo com o papel do usuario
            $valores = array(
                'validacao' => 'validado',
                'controlador' => 'ead',
                'acao' => 'index'
            );
            return $valores;
        } else {
            if ($validacao == 'invalidado') {
                $valores = array(
                    'validacao' => 'invalido'
                );
                return $valores;
            } else {
                if ($validacao == 'cadastrar') {
                    $valores = array(
                        'validacao' => 'cadastrar'
                    );
                    return $valores;
                }
            }
        }
    }

    public function actionLiberarAcesso($pagina) {
        if ($this->seguranca->validarSessao()) {
            return$this->seguranca->isPapel_pagina($pagina);
        } else {
            return 'nao logado';
        }
    }

    public function actionEnviarSenhaEmail($usuario) {

        $mail = new SMTP;
        $mail->Delivery('relay');
        $mail->Relay('smtp.gmail.com', 'dietsmar', 'r2lsmart', 25, 'login', false);
        $mail->From('rafael11690@gmail.com', 'DietSmart');
        $mail->AddTo("rafael11690@gmail.com", "Rafael PEresss!");
        $body = "Olá";
        $mail->Html($body);
        $mail->Send('Assinatura confirmada por mais ');        
    }

    public function actionLogout() {
        $this->seguranca->expulsar();
    }

    function gerarSenha() {
        $senha = "";
        $letras = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
        $numeros = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
        for ($i = 0; $i < 3; $i++) {
            $random = rand(0, 24);
            $senha = $senha . $letras[$random];
        }
        for ($i = 0; $i < 3; $i++) {
            $random = rand(0, 9);
            $senha = $senha . $numeros[$random];
        }
        return $senha;
    }

}

?>
