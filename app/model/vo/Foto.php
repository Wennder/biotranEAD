<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Foto
 *
 * @author Rodolfo
 */
class Foto {
    //put your code here
    private $id_foto;
    private $imagem;
    
    public function getId_foto(){
        return $this->id_foto;
    }    
    
    public function getImagem(){
        return $this->imagem;
    }    
    
    public function setId_foto($id_foto){
        $this->id_foto = $id_foto ;
    }
    public function setImagem($imagem){
        $this->imagem = $imagem ;
    }
    
}

?>
