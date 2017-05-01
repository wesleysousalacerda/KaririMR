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

    public function RetornarTodosAutomoveis() {
        try {
            $sql = "";
            $sql = "SELECT cod, nome , marca, modelo, ano, categoria_cod FROM automovel ORDER BY nome ASC";

            $dataTable = $this->pdo->ExecuteQuery($sql, NULL);

            $listaAutomovel = [];

            foreach ($dataTable as $resultado) {// O metodo foreach varre linha por linha na tabela, procurando o parametro AS.
                $automovel = new Automovel(); // Estrutura orientada a objetos, passasse o objeto Automovel, e nao os dados.
                $automovel->setCod($resultado["cod"]);
                $automovel->setNome($resultado["nome"]);
                $automovel->setMarca($resultado["marca"]);
                $automovel->setModelo($resultado["modelo"]);
                $automovel->setAno($resultado["ano"]);
                $automovel->setCategoria($resultado["categoria_cod"]);

                $listaAutomovel[] = $automovel;
            }

            return $listaAutomovel;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornaCod(int $automovelCod) {
        try {
            $sql = "SELECT nome, descricao, placa, renavam, marca,modelo, ano, categoria_cod FROM automovel WHERE cod = :cod";
            $param = array(
                ":cod" => $automovelCod
            );

            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            if ($dt != null) {
                $automovel = new Automovel();

                $automovel->setNome($dt["nome"]);
                $automovel->setDescricao($dt["descricao"]);
                $automovel->setPlaca($dt["placa"]);
                $automovel->setRenavam($dt["renavam"]);
                $automovel->setMarca($dt["marca"]);
                $automovel->setModelo($dt["modelo"]);
                $automovel->setAno($dt["ano"]);
                $automovel->setCategoria($dt["categoria_cod"]);
                return $automovel;
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

}

?>