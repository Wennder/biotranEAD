<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Video
 *
 * @author Torres
 */
class Video {
    
    private $id_video;
    private $descricao;    
    private $titulo;
    private $id_modulo;
    
    public function getId_video() {
        return $this->id_video;
    }

    public function setId_video($id_video) {
        $this->id_video = $id_video;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }  

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getId_modulo() {
        return $this->id_modulo;
    }

    public function setId_modulo($id_modulo) {
        $this->id_modulo = $id_modulo;
    }

}

?>
