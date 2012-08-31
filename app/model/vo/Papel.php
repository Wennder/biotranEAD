<?php

class Papel {

    private $id_papel;
    private $papel;

    function __construct() {
        
    }

    public function getId_papel() {
        return $this->id_papel;
    }

    public function setId_papel($id_papel) {
        $this->id_papel = $id_papel;
    }

    public function getPapel() {
        return $this->papel;
    }

    public function setPapel($papel) {
        $this->papel = $papel;
    }

}

?>
