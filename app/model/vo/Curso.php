<?php

class Curso {
    
    private $id_curso = '';
    private $nome = '';
    private $descricao = '';
    private $tempo = '';
    private $gratuito = '';
    private $status = '';    
    private $numero_modulos = '';    
    private $objetivo = '';    
    private $justificativa = '';    
    private $obs = '';    
    
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
    
    //Se boolean == 1, retorna 0 ou 1. Se boolean == 0, retorna Sim ou Não.
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
    
    //Se $boolean == 1, retorna 0 ou 1, senao, retorna os status
    public function getStatus($boolean) {
        if($boolean == 1){
            return $this->status;
        }
        else {
            if ($this->status == 0) {
                $this->status = "Em construcao";
                return $this->status;
            }
            else if ($this->status == 1) {
                $this->status = "Nao avaliado";
                return $this->status;
            }
            else if ($this->status == 2) {
                $this->status = "Rejeitado";
                return $this->status;
            }
            else if ($this->status == 3) {
                $this->status = "Aprovado e indisponivel";
                return $this->status;
            }
            else if ($this->status == 4) {
                $this->status = "Aprovado e disponivel";
                return $this->status;
            }
        }
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getNumero_modulos() {
        return $this->numero_modulos;
    }

    public function setNumero_modulos($numero_modulos) {
        $this->numero_modulos = $numero_modulos;
    }

    public function getObjetivo() {
        return $this->objetivo;
    }

    public function setObjetivo($objetivo) {
        $this->objetivo = $objetivo;
    }

    public function getJustificativa() {
        return $this->justificativa;
    }

    public function setJustificativa($justificativa) {
        $this->justificativa = $justificativa;
    }

    public function getObs() {
        return $this->obs;
    }

    public function setObs($obs) {
        $this->obs = $obs;
    }


}

?>
