<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Patrocinador
 *
 * @author Rodolfo
 */
class Patrocinador {
    //put your code here
    private $id_patrocinador;
    private $imagem;
    
    public function getId_patrocinador(){
        return $this->id_patrocinador;
    }
    
    public function getImagem(){
        return $this->imagem;
    }
    
    public function setId_patrocinador($id_patrocinador){
        $this->id_patrocinador = $id_patrocinador;
    }
    
    public function setImagem($imagem){
        $this->imagem = $imagem;
    }
    
}

?>
