<?php

include ROOT_PATH . '/app/model/seguranca/Seguranca.php';

class ControllerSeguranca {

    private $papeis;
    private $seguranca;
    private $controller;

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
            return $this->seguranca->isPapel_pagina($pagina);
        } else {
            return 'nao logado';
        }
    }

    public function actionEnviarSenhaEmail($email, $cpf_passaporte) {
        $this->controller = new controllerUsuario();
        $user = $this->controller->getUsuario("login ='" . $email . "'");
        //se o usuario(email) existe no bd E cpf_passaporte for válido          
        if ($user != null && $cpf_passaporte == $user->getCpf_passaporte()) {
            //---enviar e-mail
            $mail = new PHPMailer(); //instancia o objeto PHPMailer
            $mail->IsSMTP(); //informa que foi trabalhar com SMTP
            $mail->Host = "mail.dietsmart.com.br"; //o endereço do meu servidor smtp
            $mail->SMTPAuth = true; //informo que o servidor SMTP requer autenticação
            $mail->Username = "contato@dietsmart.com.br"; //informo o usuário para autenticação no SMTP
            $mail->Password = "teste2012"; //informo a senha do usuário para autenticação no SMTP
            $mail->From = "contato@biotraead.com.br"; //informo o e-mail Remetente
            $mail->FromName = "Biotran EAD"; //o nome do que irá aparecer para a pessoa que vai receber o e-mail
//            $mail->AddAddress($email); //e-mail do destinatário
            $mail->WordWrap = 50; //informo a quebra de linha no e-mail (isso é opcional)
            $mail->IsHTML(true); //informo que o e-mail é em HTML (opcional)
            $mail->Subject = "Mudança de senha"; //informo o assunto do e-mail
            //gerando nova senha de usuario:
            $senha = $this->gerarSenha();
            //criando o corpo do e-mail
            $mail->Body = "<html><body>
                    Olá, ".$user->getNome_completo()." </br>
                        Sua nova senha é: ".$senha."</br>
                        
                        Para a sua segurança altere sua sua senha ;).
                        
            </body></html>"; //aqui vai o corpo do e-mail em HTML
            //Enfim, envio o e-mail.
            if($mail->Send()){         
                //atualizando no banco
                $user->setSenha($senha);
                $this->controller->atualizarUsuario($user);
                return 1;
            }
        }
        return 0;
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
