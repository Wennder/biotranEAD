<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerAlternativa
 *
 * @author cead-p057007
 */
class controllerAlternativa {

    public function novoAlternativa(Alternativa $p) {
        if ($p != null) {
            $dao = new AlternativaDAO();
            return $dao->insert($p);
        } else {
            return 'ERRO: funcao nopoAlternativa - [controllerAlternativa]';
        }
    }
    
    public function atualizarAlternativa(Alternativa $p) {
        if ($p != null) {
            $dao = new AlternativaDAO();
            return $dao->update($p);
        } else {
            return 'ERRO: funcao nopoAlternativa - [controllerAlternativa]';
        }
    }

    public function getAlternativa($condicao) {
        $dao = new AlternativaDAO();
        $p = $dao->select($condicao);
        if ($p != null) {
            return $p[0];
        }
        return $p; // null
    }

    public function getListaAlternativas($condicao = null) {
        $dao = new AlternativaDAO();
        $p = $dao->select($condicao);
        return $p; // null
    }

    public function deleteAlternativa(Alternativa $p) {
        $dao = new AlternativaDAO();
        return $dao->delete($p);
    }

    /*
     * retorna um vetor de Alternativa setando via post
     */

    public function setTodasAlternativa($alternativa = null) {
        if ($alternativa == null) {
            $alternativa = array(new Alternativa(), new Alternativa(), new Alternativa(), new Alternativa);
        }
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $aux = explode('-', $k);
                if (isset($aux[1])) {
                    $setAtributo = 'set' . ucfirst($aux[0]);
                    if (method_exists($alternativa[$aux[1]], $setAtributo)) {
                        $alternativa[$aux[1]]->$setAtributo($v);
                    }
                } else {
                    if ($k == 'eh_correta') {
                        $alternativa[$v]->setEh_correta(1);
                    }
                }
            }
        }
        return $alternativa;
    }

}

?>
