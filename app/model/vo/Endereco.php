<?php

class Endereco {
    private $id_endereco_usuario;    
    private $rua;    
    private $numero;    
    private $complemento;    
    private $bairro;    
    private $cidade;
    private $pais;
    private $estado;
    private $id_usuario;            
    
    public function getId_endereco_usuario() {
        return $this->id_endereco_usuario;
    }

    public function setId_endereco_usuario($id_endereco_usuario) {
        $this->id_endereco_usuario = $id_endereco_usuario;
    }

    public function getRua() {
        return $this->rua;
    }

    public function setRua($rua) {
        $this->rua = $rua;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }
    
    public function getId_usuario(){
        return $this->id_usuario;
    }
    
    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }
    
    public function getPais() {
        return $this->pais;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

}

?>
