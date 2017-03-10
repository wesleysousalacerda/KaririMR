<?php

class Usuario {
    private $cod;
    private $nome;
    private $email;
    private $cpf;
    private $usuario;
    private $senha;
    private $nascimento;
    private $sexo;
    private $status;
//    private $plano_id;
    private $permissao_id;
//    private $logradouro_cod;
    
    function getCod() {
        return $this->cod;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getSenha() {
        return $this->senha;
    }

    function getNascimento() {
        return $this->nascimento;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getStatus() {
        return $this->status;
    }

//    function getPlano_id() {
//        return $this->plano_id;
//    }

    function getPermissao_id() {
        return $this->permissao_id;
    }

//    function getLogradouro_cod() {
//        return $this->logradouro_cod;
//    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setSenha($senha) {
        $this->senha = md5($senha); //Criptografia de senha
    }

    function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setStatus($status) {
        $this->status = $status;
    }

//    function setPlano_id($plano_id) {
//        $this->plano_id = $plano_id;
//    }

    function setPermissao_id($permissao_id) {
        $this->permissao_id = $permissao_id;
    }

//    function setLogradouro_cod($logradouro_cod) {
//        $this->logradouro_cod = $logradouro_cod;
//    }
}
?>