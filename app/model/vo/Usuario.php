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
    private $id_papel;
    private $nome_completo;
    private $data_nascimento;
    private $cpf;
    private $rg;
    private $id_profissional;
    private $atuacao;
    private $descricao_pessoal;
    private $sexo;
    private $tel_residencial;
    private $tel_comercial;
    private $tel_celular1;
    private $tel_celular2;
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

    public function getId_papel() {
        return $this->id_papel;
    }

    public function setId_papel($id_papel) {
        $this->id_papel = $id_papel;
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
        return utf8_encode($this->descricao_pessoal);
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

    public function getTel_comercial() {
        return $this->tel_comercial;
    }
    
    public function setTel_comercial($tel_comercial) {
        $this->tel_comercial = $tel_comercial;
    }

    public function getTel_celular1() {
        return $this->tel_celular1;
    }

    public function setTel_celular1($tel_celular1) {
        $this->tel_celular1 = $tel_celular1;
    }
    
    public function getTel_celular2() {
        return $this->tel_celular2;
    }

    public function setTel_celular2($tel_celular2) {
        $this->tel_celular2 = $tel_celular2;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        $this->setLogin($email);
    }

}

?>
