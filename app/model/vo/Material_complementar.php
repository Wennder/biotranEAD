<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Material_complementar
 *
 * @author cead-p057007
 */
class Material_complementar {
    
    private $id_material_complementar = '';
    private $id_modulo ='';
    private $nome ='';
    
    public function getId_material_complementar() {
        return $this->id_material_complementar;
    }

    public function setId_material_complementar($id_material_complementar) {
        $this->id_material_complementar = $id_material_complementar;
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
