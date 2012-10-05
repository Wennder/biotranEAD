<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerMaterial_complementar
 *
 * @author cead-p057007
 */
class controllerMaterial_complementar extends PDOConnectionFactory {
    //put your code here
    public function novoMaterial_complementar(Material_complementar $v) {
        if ($v != null) {
            $dao = new Material_complementarDAO();
            return $dao->insert($v);
        } else {
            return 'ERRO: funcao novoMaterial_complementar - [controllerMaterial_complementar]';
        }
    }

    public function getMaterial_complementar($condicao) {
        $dao = new Material_complementarDAO();
        $v = $dao->select($condicao);
        if ($v != null) {
            return $v[0];
        }
        return $v; // null
    }

    public function getListaMaterial_complementars($condicao = null) {
        $dao = new Material_complementarDAO();
        $v = $dao->select($condicao);
        return $v; // null
    }
    
    public function deleteMaterial_complementar(Material_complementar $v) {
        $dao = new Material_complementarDAO();
        return $dao->delete($v);        
    }        
}

?>
