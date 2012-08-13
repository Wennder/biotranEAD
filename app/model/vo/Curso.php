<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Curso
 *
 * @author cead-p057007
 */
class Curso {
    private $id_curso;
    private $nome;
    private $descricao;
    
    function __construct() {
        
    }
    
    public function getId_curso() {
        return $this->id_curso;
    }

    public function setId_curso($id_curso) {
        $this->id_curso = $id_curso;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
}

?>
