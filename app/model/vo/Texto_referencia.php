<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Texto_complementar
 *
 * @author cead-p057007
 */
class Texto_referencia {
    
    private $id_texto_referencia = '';
    private $id_modulo ='';
    private $nome = '';
    
    
    public function getId_texto_referencia() {
        return $this->id_texto_referencia;
    }

    public function setId_texto_referencia($id_texto_referencia) {
        $this->id_texto_referencia = $id_texto_referencia;
    }

    public function getId_modulo() {
        return $this->id_modulo;
    }

    public function setId_modulo($id_modulo) {
        $this->id_modulo = $id_modulo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }


}

?>
