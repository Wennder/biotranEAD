<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Matricula_curso
 *
 * @author Torres
 */
class Matricula_curso {
    private $id_matricula_curso;
    private $id_curso;
    private $id_usuario;
    private $data_inicio;
    private $data_fim;
    private $status_acesso;
    private $modulo_atual;
    
    public function getId_matricula_curso() {
        return $this->id_matricula_curso;
    }

    public function setId_matricula_curso($id_matricula_curso) {
        $this->id_matricula_curso = $id_matricula_curso;
    }

    public function getId_curso() {
        return $this->id_curso;
    }

    public function setId_curso($id_curso) {
        $this->id_curso = $id_curso;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getData_inicio() {
        return $this->data_inicio;
    }

    public function setData_inicio($data_inicio) {
        $this->data_inicio = $data_inicio;
    }

    public function getData_fim() {
        return $this->data_fim;
    }

    public function setData_fim($data_fim) {
        $this->data_fim = $data_fim;
    }

    public function getStatus_acesso() {
        return $this->status_acesso;
    }

    public function setStatus_acesso($status_acesso) {
        $this->status_acesso = $status_acesso;
    }

    public function getModulo_atual() {
        return $this->modulo_atual;
    }

    public function setModulo_atual($modulo_atual) {
        $this->modulo_atual = $modulo_atual;
    }
    
}

?>
