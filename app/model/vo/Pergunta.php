<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Exercicio
 *
 * @author Torres
 */
class Pergunta {
    
    private $id_pergunta = '';
    private $id_exercicio = '';
    private $numeracao = '';
    private $enuciado = '';
    
    public function getId_exercicio() {
        return $this->id_exercicio;
    }

    public function setId_exercicio($id_exercicio) {
        $this->id_exercicio = $id_exercicio;
    }

    public function getId_atividade() {
        return $this->id_atividade;
    }

    public function setId_atividade($id_atividade) {
        $this->id_atividade = $id_atividade;
    }

    public function getEnuciado() {
        return $this->enuciado;
    }

    public function setEnuciado($enuciado) {
        $this->enuciado = $enuciado;
    }
    
    public function getId_pergunta() {
        return $this->id_pergunta;
    }

    public function setId_pergunta($id_pergunta) {
        $this->id_pergunta = $id_pergunta;
    }

    public function getNumeracao() {
        return $this->numeracao;
    }

    public function setNumeracao($numeracao) {
        $this->numeracao = $numeracao;
    }
}

?>
