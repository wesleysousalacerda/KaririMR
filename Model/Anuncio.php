<?php
require_once("Usuario.php");
require_once("Automovel.php");

class Anuncio {

    private $cod;
    private $nome;
    private $descricao;
    private $tipo;
    private $valor;
    private $status;
    private $perfil;
    private $usuario;
    private $automovel;
    public function __construct() {
        $this->usuario = new Usuario();
        $this->automovel = new Automovel();
    }

    function getCod() {
        return $this->cod;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getValor() {
//        $convert = $this->valor;
        return $this->valor;
    }

    function getStatus() {
        return $this->status;
    }

    function getPerfil() {
        return $this->perfil;
    }

    function getAutomovel() {
        return $this->automovel;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    function setAutomovel($automovel) {
        $this->automovel = $automovel;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

}

?>