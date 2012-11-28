<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_exercicio
 *
 * @author cead-p057007
 */
class Usuario_exercicio {
    private $id_usuario_exercicio = '';
    private $id_usuario = '';
    private $id_exercicio = '';
    private $id_modulo = '';
    private $porc_acertos = '';
    
    public function getId_modulo() {
        return $this->id_modulo;
    }

    public function setId_modulo($id_modulo) {
        $this->id_modulo = $id_modulo;
    }
        
    public function getId_usuario_exercicio() {
        return $this->id_usuario_exercicio;
    }

    public function setId_usuario_exercicio($id_usuario_exercicio) {
        $this->id_usuario_exercicio = $id_usuario_exercicio;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getId_exercicio() {
        return $this->id_exercicio;
    }

    public function setId_exercicio($id_exercicio) {
        $this->id_exercicio = $id_exercicio;
    }

    public function getPorc_acertos() {
        return $this->porc_acertos;
    }

    public function setPorc_acertos($porc_acertos) {
        $this->porc_acertos = $porc_acertos;
    }

}

?>
