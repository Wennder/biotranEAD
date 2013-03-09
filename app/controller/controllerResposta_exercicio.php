<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerResposta_exercicio
 *
 * @author cead-p057007
 */
class controllerResposta_exercicio {

    public function novoResposta_exercicio(Resposta_exercicio $p) {
        if ($p != null) {            
            $dao = new Resposta_exercicioDAO();
            if($this->getResposta_exercicio("idresposta_exercicio=". $p->getId_resposta_exercicio()) != null){                
                return $p->getId_resposta_exercicio();
            }
            return $dao->insert($p);
        } else {
            return 'ERRO: funcao nopoResposta_exercicio - [controllerResposta_exercicio]';
        }
    }
    
    public function atualizarResposta_exercicio(Resposta_exercicio $p) {
        if ($p != null) {            
            $dao = new Resposta_exercicioDAO();            
            return $dao->update($p);
        } else {
            return 'ERRO: funcao nopoResposta_exercicio - [controllerResposta_exercicio]';
        }
    }

    public function getResposta_exercicio($condicao) {
        $dao = new Resposta_exercicioDAO();
        $p = $dao->select($condicao);
        if ($p != null) {
            return $p[0];
        }
        return $p; // null
    }

    public function getListaResposta_exercicios($condicao = null) {
        $dao = new Resposta_exercicioDAO();
        $p = $dao->select($condicao);
        return $p; // null
    }        

    public function deleteResposta_exercicio(Resposta_exercicio $p) {
        $dao = new Resposta_exercicioDAO();
        return $dao->delete($p);
    }

    public function setResposta_exercicio(Resposta_exercicio $p = null) {
        if($p == null){
            $p = new Resposta_exercicio();
        }
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($p, $setAtributo)) {
                    $p->$setAtributo($v);
                }
            }
        }
        return $p;
    }        
    
    public function getMaxNumeracao($id_exercicio){
        $dao = new Resposta_exercicioDAO();
        $p = $dao->select("id_exercicio=" .$id_exercicio. " ORDER BY numeracao");
        $i = count($p);
        return $p[($i-1)]->getNumeracao();
    }

}

?>
