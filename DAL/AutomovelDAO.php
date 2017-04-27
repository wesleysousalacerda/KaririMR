<?php
require_once("Banco.php");
class AutomovelDAO {
    private $pdo;
    private $debug;
    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }
    public function Cadastrar(Automovel $automovel) {
        try { 
            $sql = "INSERT automovel (nome, descricao, placa, renavam, marca, modelo,ano, categoria_cod) VALUES (:nome, :descricao, :placa, :renavam, :marca, :modelo,:ano, :categoriacod)";
            $param = array(
                ":nome" => $automovel->getNome(),
                ":descricao" => $automovel->getDescricao(),
                ":placa" => $automovel->getPlaca(),
                ":renavam" => $automovel->getRenavam(),
                ":marca" => $automovel->getMarca(),
                ":modelo" => $automovel->getModelo(),
                ":ano" => $automovel->getAno(),
                ":categoriacod" => $automovel->getCategoria()->getCod()
            );
            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }
    public function Alterar(Automovel $automovel) {
        try {
            $sql = "UPDATE automovel SET nome = :nome, descricao = :descricao, placa = :placa, renavam= :renavam, marca = :marca, modelo = :modelo, ano = :ano, categoria_cod = :categoriacod WHERE cod = :cod";
            $param = array(
                ":nome" => $automovel->getNome(),
                ":descricao" => $automovel->getDescricao(),
                ":placa" => $automovel->getPlaca(),
                ":renavam" => $automovel->getRenavam(),
                ":marca" => $automovel->getMarca(),
                ":modelo" => $automovel->getModelo(),
                ":ano" => $automovel->getAno(),
                ":categoriacod" => $automovel->getCategoria()->getCod(),
                ":cod" => $automovel->getCod()
            );
            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }
    
}
?>