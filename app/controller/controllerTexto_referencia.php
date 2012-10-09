<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerTexto_referencia
 *
 * @author cead-p057007
 */
class controllerTexto_referencia {
    //put your code here
    public function novoTexto_referencia(Texto_referencia $v) {
        if ($v != null) {
            $dao = new Texto_referenciaDAO();
            return $dao->insert($v);
        } else {
            return 'ERRO: funcao novoTexto_referencia - [controllerTexto_referencia]';
        }
    }

    public function getTexto_referencia($condicao) {
        $dao = new Texto_referenciaDAO();
        $v = $dao->select($condicao);
        if ($v != null) {
            return $v[0];            
        }
        return $v; // null
    }

    public function getListaTexto_referencias($condicao = null) {
        $dao = new Texto_referenciaDAO();
        $v = $dao->select($condicao);
        return $v; // null
    }
    
    public function deleteTexto_referencia(Texto_referencia $v) {
        $dao = new Texto_referenciaDAO();
        return $dao->delete($v);        
    }        
}

?>
