<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comentario
 *
 * @author Rodolfo
 */
class Comentario {
    //put your code here
    private $id_comentario;
    private $autor;
    private $comentario;
    private $data;
    
    public function getId_comentario(){
        return $this->id_comentario;
    }
    public function getAutor(){
        return $this->autor;
    }
    public function getComentario(){
        return $this->comentario;
    }
    public function getData(){
        return $this->data;
    }
    
    public function setId_comentario($id_comentario){
        $this->id_comentario = $id_comentario; 
    }
    public function setAutor($autor){
        $this->autor = $autor; 
    }
    public function setComentario($comentario){
        $this->comentario = $comentario; 
    }
    public function setData($data){
        $this->data = $data; 
    }
    
}

?>
