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
    private $login;
    private $senha;
    //papel: chave estrangeira    
    //private $id_papel;
    private $papel;
    private $nome_completo;
    private $data_nascimento;
    private $cpf;
    private $rg;
    private $id_profissional;
    private $atuacao;
    private $descricao_pessoal;
    private $sexo;
    private $tel_residencial;
    private $tel_celular;
    private $email;               
       
    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getPapel() {
        return $this->papel;
    }

    public function setPapel(Papel $papel) {
        $this->papel = $papel;
    }

    public function getNome_completo() {
        return $this->nome_completo;
    }

    public function setNome_completo($nome_completo) {
        $this->nome_completo = $nome_completo;
    }

    public function getData_nascimento() {
        return $this->data_nascimento;
    }

    public function setData_nascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getRg() {
        return $this->rg;
    }

    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function getId_profissional() {
        return $this->id_profissional;
    }

    public function setId_profissional($id_profissional) {
        $this->id_profissional = $id_profissional;
    }

    public function getAtuacao() {
        return $this->atuacao;
    }

    public function setAtuacao($atuacao) {
        $this->atuacao = $atuacao;
    }

    public function getDescricao_pessoal() {
        return $this->descricao_pessoal;
    }

    public function setDescricao_pessoal($descricao_pessoal) {
        $this->descricao_pessoal = $descricao_pessoal;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getTel_residencial() {
        return $this->tel_residencial;
    }

    public function setTel_residencial($tel_residencial) {
        $this->tel_residencial = $tel_residencial;
    }

    public function getTel_celular() {
        return $this->tel_celular;
    }

    public function setTel_celular($tel_celular) {
        $this->tel_celular = $tel_celular;
    }     

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
}

?>
