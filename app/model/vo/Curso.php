<?php

class Curso {
    
    private $id_curso = '';
    private $nome = '';
    private $descricao = '';
    private $tempo = '';
    private $gratuito = '';
    private $valor = '';
    
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
    
    public function getTempo() {
        return $this->tempo;
    }

    public function setTempo($tempo) {
        $this->tempo = $tempo;
    }
    
    //Se boolean == 0, retorna 0 ou 1. Se boolean == 1, retorna Sim ou Não.
    public function getGratuito($boolean) {
        if($boolean == 1){
            return $this->gratuito;
        }
        else{
            if($this->gratuito == 1){
                $this->gratuito = "Sim";
                return $this->gratuito;
            }
            else if($this->gratuito == 0){
                $this->gratuito = "Não";
                return $this->gratuito;
            }
        }
        return $this->gratuito;
    }

    public function setGratuito($gratuito) {
        $this->gratuito = $gratuito;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

}

?>
