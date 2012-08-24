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
    private $cpf_passaporte;
    private $rg;
    private $id_profissional;
    private $atuacao;
    private $descricao_pessoal;
    private $sexo;
    private $tel_principal;
    private $tel_secundario;
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
        return utf8_encode($this->nome_completo);
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

    public function getCpf_passaporte() {
        return $this->cpf_passaporte;
    }

    public function setCpf_passaporte($cpf_passaporte) {
        $this->cpf_passaporte = $cpf_passaporte;
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
        return utf8_encode($this->atuacao);
    }

    public function setAtuacao($atuacao) {
        $this->atuacao = utf8_decode($atuacao);
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

    public function getTel_principal() {
        return $this->tel_principal;
    }

    public function setTel_principal($tel_principal) {
        $this->tel_principal = $tel_principal;
    }

    public function getTel_secundario() {
        return $this->tel_secundario;
    }
    
    public function setTel_secundario($tel_secundario) {
        $this->tel_secundario = $tel_secundario;
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
