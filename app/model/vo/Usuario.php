<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author cead-p057007
 */
class Usuario {
    private $id_usuario;
    private $nome;
    private $tel;
    //chave estrangeira
    private $papel;
    private $email;
    private $senha;
    
    function __construct() {
        
    }
    
    public function getId_usuario() {
        return $this->id_usuario;           
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getTel() {
        return $this->tel;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }

    public function getPapel() {
        return $this->id_papel;
    }

    public function setPapel($papel) {
        $this->papel = $papel;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }        

}

?>
