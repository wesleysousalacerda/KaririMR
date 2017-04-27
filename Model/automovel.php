<?php

class Automovel {

    private $cod;
    private $nome;
    private $descricao;
    private $placa;
    private $renavam;
    private $marca;
    private $modelo;
    private $ano;
    private $categoria;
    
    function getCod() {
        return $this->cod;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getPlaca() {
        return $this->placa;
    }

    function getRenavam() {
        return $this->renavam;
    }

    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }
    function getAno() {
        return $this->ano;
    }
    function getCategoria() {
        return $this->categoria;
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

    function setPlaca($placa) {
        $this->placa = $placa;
    }

    function setRenavam($renavam) {
        $this->renavam = $renavam;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }
    
    function setAno($ano) {
        $this->ano = $ano;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

}

?>