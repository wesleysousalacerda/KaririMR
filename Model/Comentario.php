<?php

require_once("Anuncio.php");
require_once("Usuario.php");

class Comentario {

    private $cod;
    private $mensagem;
    private $data;
    private $status;
    private $anuncio;
    private $usuario;

    public function __construct() {
        $this->anuncio = new Anuncio();
        $this->usuario = new Usuario();
    }

    function getCod() {
        return $this->cod;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    function getData() {
        return $this->data;
    }

    function getStatus() {
        return $this->status;
    }

    function getAnuncio() {
        return $this->anuncio;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setAnuncio($anuncio) {
        $this->anuncio = $anuncio;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

}

?>