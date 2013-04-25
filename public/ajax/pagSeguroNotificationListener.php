<?php

/*
 * ***********************************************************************
  Copyright [2011] [PagSeguro Internet Ltda.]

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

  http://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License.
 * ***********************************************************************
 */

require_once "../../library/Biotran/importar_app.php";

class NotificationListener {

    public static function main() {

        $code = (isset($_POST['notificationCode']) && trim($_POST['notificationCode']) !== "" ? trim($_POST['notificationCode']) : null);
        $type = (isset($_POST['notificationType']) && trim($_POST['notificationType']) !== "" ? trim($_POST['notificationType']) : null);

        if ($code && $type) {

            $notificationType = new PagSeguroNotificationType($type);
            $strType = $notificationType->getTypeFromValue();

            switch ($strType) {

                case 'TRANSACTION':
                    self::TransactionNotification($code);
                    break;

                default:
                    LogPagSeguro::error("Unknown notification type [" . $notificationType->getValue() . "]");
            }

            self::printLog($strType);
        } else {

            LogPagSeguro::error("Invalid notification parameters.");
            self::printLog();
        }
    }

    private static function TransactionNotification($notificationCode) {

        /*
         * #### Crendencials ##### 
         * Substitute the parameters below with your credentials (e-mail and token)
         * You can also get your credentails from a config file. See an example:
         * $credentials = PagSeguroConfig::getAccountCredentials();
         */
        $credentials = PagSeguroConfig::getAccountCredentials();

        try {
            $transaction = PagSeguroNotificationService::checkTransaction($credentials, $notificationCode);
            $sender = $transaction->getSender();
            $item = $transaction->getItems();
            switch ($transaction->getStatus()) {
                case 'WAITING_PAYMENT':
                    /*
                     * Aguardando pagamento: 
                     * o comprador iniciou a transação, mas até o momento o PagSeguro não recebeu nenhuma 
                     * informação sobre o pagamento.
                     */
                    $text_status = "Aguardando pagamento";
                    self::sendMail($sender, $item, $text_status);
                    break;
                case 'IN_ANALYSIS':
                    /*
                     * Em análise: o comprador optou por pagar com um cartão de crédito e 
                     * o PagSeguro está analisando o risco da transação.
                     */
                    $text_status = "Em análise";
                    self::sendMail($sender, $item, $text_status);
                    break;
                case 'PAID':
                    /*
                     * Paga: a transação foi paga pelo comprador e o PagSeguro já recebeu uma 
                     * confirmação da instituição financeira responsável pelo processamento.
                     */
                    $text_status = "Pago";
                    //realizando matricula do aluno
                    $c = new controllerCurso();
                    $curso = $c->getCurso("id_curso=".$item->getId());
                    $c = new controllerUsuario();
                    $usuario = $c->getUsuario("login=".$sender->getEmail());
                    $c = new controllerMatricula_curso();
                    $c->novaMatricula($curso, $usuario);
                    self::sendMail($sender, $item, $text_status);
                    break;
                case 'AVAILABLE':
                    /*
                     * Disponível: a transação foi paga e chegou ao final de seu prazo de 
                     * liberação sem ter sido retornada e sem que haja nenhuma disputa aberta.
                     */
                    $text_status = "Disponível";
                    self::sendMail($sender, $item, $text_status);
                    break;
                case 'IN_DISPUTE':
                    /*
                     * Em disputa: o comprador, dentro do prazo de 
                     * liberação da transação, abriu uma disputa.
                     */
                    $text_status = "Em disputa";
                    self::sendMail($sender, $item, $text_status);
                    break;
                case 'REFUNDED':
                    /*
                     * Devolvida: o valor da transação foi devolvido para o comprador.
                     */
                    $text_status = "Devolvida";
                    self::sendMail($sender, $item, $text_status);
                    break;
                case 'CANCELED':
                    /*
                     * Cancelada: a transação foi cancelada sem ter sido finalizada.
                     */
                    $text_status = "Cancelada";
                    self::sendMail($sender, $item, $text_status);
                    break;
            }
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    private static function printLog($strType = null) {
        $count = 4;
        echo "<h2>Receive notifications</h2>";
        if ($strType) {
            echo "<h4>notifcationType: $strType</h4>";
        }
        echo "<p>Last <strong>$count</strong> items in <strong>log file:</strong></p><hr>";
        echo LogPagSeguro::getHtml($count);
    }

    private static function sendMail(PagSeguroSender $sender, PagSeguroItem $item, $text_status) {
        $c = new controllerUsuario();
        $user = $c->getUsuario("login=" . $sender->getEmail());
        //---enviar e-mail
        $mail = new PHPMailer(); //instancia o objeto PHPMailer
        $mail->IsSMTP(); //informa que foi trabalhar com SMTP
        $mail->Host = "mail.dietsmart.com.br"; //o endereço do meu servidor smtp
        $mail->SMTPAuth = true; //informo que o servidor SMTP requer autenticação
        $mail->Username = "contato@dietsmart.com.br"; //informo o usuário para autenticação no SMTP
        $mail->Password = "teste2012"; //informo a senha do usuário para autenticação no SMTP
        $mail->From = "contato@biotranead.com.br"; //informo o e-mail Remetente
        $mail->FromName = "Biotran EAD"; //o nome do que irá aparecer para a pessoa que vai receber o e-mail
        $mail->AddAddress($sender->getEmail()); //e-mail do destinatário
        $mail->WordWrap = 50; //informo a quebra de linha no e-mail (isso é opcional)
        $mail->IsHTML(true); //informo que o e-mail é em HTML (opcional)
        $mail->Subject = "Notificações PagSeguro - [Compra de curso]"; //informo o assunto do e-mail
        //gerando nova senha de usuario:
        $senha = $this->gerarSenha();
        //criando o corpo do e-mail
        if ($text_status == 'Pago') {
            $mail->Body = "<html><body>
                    Olá, " . $user->getNome_completo() . " </br>
                        Constatamos que o status de sua compra do curso " . $item->getDescription() . " foi alterado para:</br>
                                                
                        <b>" . $text_status . "</b><br><br>
                            Sua matrícula foi efetuada com sucesso e o curso já se encontra disponível. Para maiores informações entre em contato conosco!
                            
            </body></html>"; //aqui vai o corpo do e-mail em HTML
        } else {
            $mail->Body = "<html><body>
                    Olá, " . $user->getNome_completo() . " </br>
                        Constatamos que o status de sua compra do curso " . $item->getDescription() . " foi alterado para:</br>
                                                
                        <b>" . $text_status . "</b><br><br>
                            Para maiores informações entre em contato conosco!                            
                            
            </body></html>"; //aqui vai o corpo do e-mail em HTML            
        }
        //Enfim, envio o e-mail.
        if ($mail->Send()) {
            //atualizando no banco
            $user->setSenha(md5($senha));
            $this->controller->atualizarSenhaUsuario($user);
            return 1;
        }
    }

}

NotificationListener::main();
?>