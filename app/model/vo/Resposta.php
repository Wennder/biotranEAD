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
    private $id_exercicio;
    private $resposta;
    private $eh_resposta;
    
    public function getId_resposta() {
        return $this->id_resposta;
    }

    public function setId_resposta($id_resposta) {
        $this->id_resposta = $id_resposta;
    }

    public function getId_exercicio() {
        return $this->id_exercicio;
    }

    public function setId_exercicio($id_exercicio) {
        $this->id_exercicio = $id_exercicio;
    }

    public function getResposta() {
        return $this->resposta;
    }

    public function setResposta($resposta) {
        $this->resposta = $resposta;
    }

    public function getEh_resposta() {
        return $this->eh_resposta;
    }

    public function setEh_resposta($eh_resposta) {
        $this->eh_resposta = $eh_resposta;
    }

}

?>
