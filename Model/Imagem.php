<?php
require_once ("Anuncio.php");
class Imagem {

    private $cod;
    private $imagem;
    private $anuncio;
    
    public function __construct() {
        $this ->anuncio = new Anuncio(); 
    }
 
    function getCod() {
        return $this->cod;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getAnuncio() {
        return $this->anuncio;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setAnuncio($anuncio) {
        $this->anuncio = $anuncio;
    }



}

