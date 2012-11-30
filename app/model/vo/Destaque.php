<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Destaque
 *
 * @author Rodolfo
 */
class Destaque {
    //put your code here
    private $id_destaque;
    private $destaque;
    
    public function getId_destaque(){
        return $this->id_destaque;
    }
    
    public function getDestaque(){
        return $this->destaque;
    }
    
    public function setId_destaque($id_destaque){
        $this->id_destaque = $id_destaque;
    }
    
    public function setDestaque($destaque){
        $this->destaque = $destaque;
    }
    
}

?>
