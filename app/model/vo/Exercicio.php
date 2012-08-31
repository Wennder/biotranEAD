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
class Exercicio {
    
    private $id_exercicio;
    private $id_atividade;
    private $enuciado;
    
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

}

?>
