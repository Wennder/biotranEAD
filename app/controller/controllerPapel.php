<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerPapel
 *
 * @author cead-p057007
 */
class controllerPapel {
    
    public function getTeste(){
        return 'TESTE BEM SUCEDIDO';
    }
    
    public function getPapel($condicao) {
        $dao = new PapelDAO();
        $papel = $dao->select($condicao);
        if ($papel != null) {
            return $papel[0];
        }
        return $papel; // null
    }
    
}

?>
