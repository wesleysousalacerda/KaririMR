<?php

require_once("Banco.php");

class AnuncioDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Anuncio $anuncio) {
        try {
            $sql = "INSERT anuncio (nome, descricao, tipo, valor, status, perfil, usuario_cod, categoria_cod) VALUES (:nome, :descricao, :tipo, :valor, :status, :perfil, :usuariocod, :categoriacod)";

            $param = array(
                ":nome" => $anuncio->getNome(),
                ":descricao" => $anuncio->getDescricao(),
                ":tipo" => $anuncio->getTipo(),
                ":valor" => $anuncio->getValor(),
                ":status" => $anuncio->getStatus(),
                ":perfil" => $anuncio->getPerfil(),
                ":usuariocod" => $anuncio->getUsuario()->getCod(),
                ":categoriacod" => $anuncio->getCategoria()->getCod()
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function Alterar(Anuncio $anuncio) {
        try {
            $sql = "UPDATE anuncio SET nome = :nome, descricao = :descricao, tipo = :tipo, valor = :valor, status = :status, perfil = :perfil, categoria_cod = :categoriacod WHERE cod = :cod";

            $param = array(
                ":nome" => $anuncio->getNome(),
                ":descricao" => $anuncio->getDescricao(),
                ":tipo" => $anuncio->getTipo(),
                ":valor" => $anuncio->getValor(),
                ":status" => $anuncio->getStatus(),
                ":perfil" => $anuncio->getPerfil(),
                ":categoriacod" => $anuncio->getCategoria()->getCod(),
                ":cod" => $anuncio->getCod()
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function RetornarTodosFiltro(string $termo, int $tipo, int $status, int $perfil, int $categoriacod) {
        try {
            $sql = "SELECT cod, nome, status FROM anuncio WHERE nome LIKE :termo AND tipo = :tipo AND status = :status AND perfil = :perfil AND  categoria_cod = :categoriacod ORDER BY nome ASC";
            $param = array(
                ":termo" => "%{$termo}%",
                ":tipo" => $tipo,
                ":status" => $status,
                ":perfil" => $perfil,
                ":categoriacod" => $categoriacod
            );

            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaAnuncio = [];

            foreach ($dt as $dr) {
                $anuncio = new Anuncio();

                $anuncio->setCod($dr["cod"]);
                $anuncio->setNome($dr["nome"]);
                $anuncio->setStatus($dr["status"]);

                $listaAnuncio[] = $anuncio;
            }

            return $listaAnuncio;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornarCod(int $cod) {
        try {
            $sql = "SELECT nome, descricao, tipo, valor, status, perfil, categoria_cod FROM anuncio WHERE cod = :cod";
            $param = array(":cod" => $cod);
            //Data Table
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            $anuncio = new Anuncio();

            $anuncio->setNome($dt["nome"]);
            $anuncio->setDescricao($dt["descricao"]);
            $anuncio->setTipo($dt["tipo"]);
            $anuncio->setStatus($dt["status"]);
            $anuncio->setPerfil($dt["perfil"]);
            $anuncio->getCategoria()->setCod($dt["categoria_cod"]);
            $anuncio->setValor($dt["valor"]);

            return $anuncio;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornarCompletoCod($cod) {
        try {
            $sql = "SELECT c.nome as clanome, c.descricao, c.tipo, c.valor, c.status, c.perfil, ca.nome as catnome, u.nome as usnome FROM anuncio c " .
                    "INNER JOIN categoria ca ON ca.cod = c.categoria_cod " .
                    "INNER JOIN usuario u ON u.cod = c.usuario_cod " .
                    "WHERE c.cod = :cod";
            $param = array(
                ":cod" => $cod
            );

            $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);

            //dt = Data Table
            //dr = Data Row

            $anuncio = new Anuncio();

            $anuncio->setNome($dr["clanome"]);
            $anuncio->setDescricao($dr["descricao"]);
            $anuncio->setTipo($dr["tipo"]);
            $anuncio->setValor($dr["valor"]);
            $anuncio->setStatus($dr["status"]);
            $anuncio->setPerfil($dr["perfil"]);
            $anuncio->getCategoria()->setNome($dr["catnome"]);
            $anuncio->getUsuario()->setNome($dr["usnome"]);

            return $anuncio;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

}

?>