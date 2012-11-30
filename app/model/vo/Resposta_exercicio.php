<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of resposta_exercicio
 *
 * @author cead-p057007
 */
class Resposta_exercicio {
    
    private $id_resposta_exercicio;
    private $id_pergunta;
    private $id_exercicio;
    private $id_usuario;    
    private $resposta;
    
    public function getId_exercicio() {
        return $this->id_exercicio;
    }

    public function setId_exercicio($id_exercicio) {
        $this->id_exercicio = $id_exercicio;
    }

        public function getId_resposta_exercicio() {
        return $this->id_resposta_exercicio;
    }

    public function setId_resposta_exercicio($id_resposta_exercicio) {
        $this->id_resposta_exercicio = $id_resposta_exercicio;
    }

    public function getId_pergunta() {
        return $this->id_pergunta;
    }

    public function setId_pergunta($id_pergunta) {
        $this->id_pergunta = $id_pergunta;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getResposta() {
        return $this->resposta;
    }

    public function setResposta($resposta) {
        $this->resposta = $resposta;
    }



     
}

?>
