<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Exercicio
 *
 * @author cead-p057007
 */
class Exercicio {
    //put your code here
    private $id_exercicio = '';
    private $id_modulo = '';
    private $titulo = '';
    private $descricao = '';
    
    
    public function getId_exercicio() {
        return $this->id_exercicio;
    }

    public function setId_exercicio($id_exercicio) {
        $this->id_exercicio = $id_exercicio;
    }

    public function getId_modulo() {
        return $this->id_modulo;
    }

    public function setId_modulo($id_modulo) {
        $this->id_modulo = $id_modulo;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
}

?>
