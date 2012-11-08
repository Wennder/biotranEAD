<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Topico
 *
 * @author Rodolfo
 */
class Topico {

    //put your code here

    private $id_topico;
    private $id_curso;
    private $id_usuario;
    private $titulo;
    private $mensagem;
    private $data_hora;

    public function __construct() {
        
    }
    
    public function Topico(){
        
    }
    
    public function getId_topico() {
        return $this->id_topico;
    }

    public function getId_curso() {
        return $this->id_curso;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    public function getData_hora(){
        return $this->data_hora;
    }
    
    public function setId_topico($id_topico) {
        $this->id_topico = $id_topico;
    }

    public function setId_curso($id_curso) {
        $this->id_curso = $id_curso;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }
    
    public function setData_hora($data_hora){
        $this->data_hora = $data_hora;
    }
    
}

?>
