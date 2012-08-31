<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Modulo
 *
 * @author Torres
 */
class Modulo {
     
     private $id_modulo;
     private $numero_modulo;
     private $id_curso;
     private $titulo_modulo;
     
     public function getId_modulo() {
         return $this->id_modulo;
     }

     public function setId_modulo($id_modulo) {
         $this->id_modulo = $id_modulo;
     }

     public function getNumero_modulo() {
         return $this->numero_modulo;
     }

     public function setNumero_modulo($numero_modulo) {
         $this->numero_modulo = $numero_modulo;
     }

     public function getId_curso() {
         return $this->id_curso;
     }

     public function setId_curso($id_curso) {
         $this->id_curso = $id_curso;
     }

     public function getTitulo_modulo() {
         return $this->titulo_modulo;
     }

     public function setTitulo_modulo($titulo_modulo) {
         $this->titulo_modulo = $titulo_modulo;
     }

}

?>
