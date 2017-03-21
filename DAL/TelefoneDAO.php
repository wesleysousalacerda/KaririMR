<?php

require_once("Banco.php");

class TelefoneDAO {

    private $pdo;
    private $debug;

    public function _construct() {
        $this->pdo = new Banco();
    }

    public function Cadastrar(Telefone $telefone) {
        try{
        $sql = "INSERT INTO telefone (tipo, numero,usuario_cod)VALUES (:tipo, :numero, :usuario)";
        $param = array(
            ":tipo" => $telefone->getTipo(),
            ":numero" => $telefone->getNumero(),
            ":usuario" => $telefone->getUsuario()->getCod()
        );
        return $this->pdo->ExecuteNonQuery($sql, $param);
        
    }catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

}
