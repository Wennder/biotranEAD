<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Resposta
 *
 * @author Torres
 */
class Resposta {

    private $id_resposta;
    private $id_topico;
    private $id_usuario;
    private $mensagem;
    private $data_hora;

    public function getId_resposta() {
        return $this->id_resposta;
    }

    public function getId_topico() {
        return $this->id_topico;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function getMensagem(){
        return $this->mensagem;
    }
    
    public function getData_hora(){
        return $this->data_hora;
    }
    
    public function setId_resposta($id_resposta){
        $this->id_resposta = $id_resposta;
    }
    public function setId_topico($id_topico){
        $this->id_topico = $id_topico;
    }
    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }
    
    public function setMensagem($mensagem){
        $this->mensagem = $mensagem;
    }
    
    public function setData_hora($data_hora){
        $this->data_hora = $data_hora;
    }
    
}

?>
