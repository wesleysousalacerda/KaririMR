<?php

require_once ("Ususario.php");

class Telefone {
    
    private $cod;
    private $tipo;
    private $numero;
    private $ususario;
    
    public function __construct() {
        $this ->usuario = new Usuario(); 
    }
}

function getCod() {
    return $this->cod;
}

 function getTipo() {
    return $this->tipo;
}

 function getNumero() {
    return $this->numero;
}

 function getUsusario() {
    return $this->ususario;
}

 function setCod($cod) {
    $this->cod = $cod;
}

 function setTipo($tipo) {
    $this->tipo = $tipo;
}

 function setNumero($numero) {
    $this->numero = $numero;
}

 function setUsusario($ususario) {
    $this->ususario = $ususario;
}



