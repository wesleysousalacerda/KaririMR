<?php

require_once("../DAL/TelefoneDAO.php");

class TelefoneController {

    private $telefoneDAO;

    public function _construct() {
        $this->telefoneDAO = new TelefoneDAO();
    }

    public function Cadastrar(Telefone $telefone) {
        if (strlen($telefone->getNumero())>5 && $telefone->getTipo()>0 && $telefone->getTipo()<=3){
            return $this->telefoneDAO->Cadastrar($telefone);            
        }else{
            return false;
        }
    }

}
