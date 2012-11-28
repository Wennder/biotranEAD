<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controllerUsuario_exercicio
 *
 * @author cead-p057007
 */
class controllerUsuario_exercicio {

    public function novoUsuario_exercicio(Usuario_exercicio $p) {
        if ($p != null) {            
            $dao = new Usuario_exercicioDAO();
            if($this->getUsuario_exercicio("id_pergunta=". $p->getId_pergunta()) != null){                
                return $p->getId_pergunta();
            }
            return $dao->insert($p);
        } else {
            return 'ERRO: funcao nopoUsuario_exercicio - [controllerUsuario_exercicio]';
        }
    }
    
    public function atualizarUsuario_exercicio(Usuario_exercicio $p) {
        if ($p != null) {            
            $dao = new Usuario_exercicioDAO();            
            return $dao->update($p);
        } else {
            return 'ERRO: funcao nopoUsuario_exercicio - [controllerUsuario_exercicio]';
        }
    }

    public function getUsuario_exercicio($condicao) {
        $dao = new Usuario_exercicioDAO();
        $p = $dao->select($condicao);
        if ($p != null) {
            return $p[0];
        }
        return $p; // null
    }

    public function getListaUsuario_exercicios($condicao = null) {
        $dao = new Usuario_exercicioDAO();
        $p = $dao->select($condicao);
        return $p; // null
    }

    public function deleteUsuario_exercicio(Usuario_exercicio $p) {
        $dao = new Usuario_exercicioDAO();
        return $dao->delete($p);
    }

    public function setUsuario_exercicio(Usuario_exercicio $p = null) {
        if($p == null){
            $p = new Usuario_exercicio();
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
        
}

?>
