<?php
require_once("Usuario.php");


class Revendedora {

    private $cod;
    private $razaosocial;
    private $cnpj;
    private $fantasia;
    private $insc_estadual;
    private $descricao;
    private $usuario;
    
    public function __construct() {
        $this->usuario = new Usuario();
        
    }

    function getCod() {
        return $this->cod;
    }

    function getRazaosocial() {
        return $this->razaosocial;
    }

    function getCnpj() {
        return $this->cnpj;
    }

    function getFantasia() {
        return $this->fantasia;
    }

    function getInsc_estadual() {
        return $this->insc_estadual;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setRazaosocial($razaosocial) {
        $this->razaosocial = $razaosocial;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    function setFantasia($fantasia) {
        $this->fantasia = $fantasia;
    }
    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setInsc_estadual($insc_estadual) {
        $this->insc_estadual = $insc_estadual;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

}

?>