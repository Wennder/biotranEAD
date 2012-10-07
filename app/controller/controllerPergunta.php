<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerPergunta
 *
 * @author cead-p057007
 */
class controllerPergunta {

    public function novoPergunta(Pergunta $p) {
        if ($p != null) {
            $dao = new PerguntaDAO();
            return $dao->insert($p);
        } else {
            return 'ERRO: funcao nopoPergunta - [controllerPergunta]';
        }
    }

    public function getPergunta($condicao) {
        $dao = new PerguntaDAO();
        $p = $dao->select($condicao);
        if ($p != null) {
            return $p[0];
        }
        return $p; // null
    }

    public function getListaPerguntas($condicao = null) {
        $dao = new PerguntaDAO();
        $p = $dao->select($condicao);
        return $p; // null
    }

    public function deletePergunta(Pergunta $p) {
        $dao = new PerguntaDAO();
        return $dao->delete($p);
    }

    public function setPergunta() {
        $pergunta = new Pergunta();
        if (!empty($_POST)) {
            foreach ($_POST as $k => $v) {
                $setAtributo = 'set' . ucfirst($k);
                if (method_exists($this->modulo, $setAtributo)) {
                    $this->modulo->$setAtributo($v);
                }
            }
        }
        return $pergunta;
    }

}

?>
