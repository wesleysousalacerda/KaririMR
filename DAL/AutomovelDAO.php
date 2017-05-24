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
            $sql = "INSERT INTO automovel (nome, descricao, placa, renavam, marca, modelo,ano,status, categoria_cod, usuario_cod) VALUES (:nome, :descricao, :placa, :renavam, :marca, :modelo,:ano,:status, :categoriacod, :usuariocod)";
            $param = array(
                ":nome" => $automovel->getNome(),
                ":descricao" => $automovel->getDescricao(),
                ":placa" => $automovel->getPlaca(),
                ":renavam" => $automovel->getRenavam(),
                ":marca" => $automovel->getMarca(),
                ":modelo" => $automovel->getModelo(),
                ":ano" => $automovel->getAno(),
                ":status" => $automovel->getStatus(),
                ":categoriacod" => $automovel->getCategoria()->getCod(),
                ":usuariocod" => $automovel->getUsuario()->getCod()
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
            $sql = "UPDATE automovel SET nome = :nome, descricao = :descricao, placa = :placa, renavam= :renavam, marca = :marca, modelo = :modelo, ano = :ano, status= :status, categoria_cod = :categoriacod, usuario_cod=:usuariocod WHERE cod = :cod";
            $param = array(
                ":nome" => $automovel->getNome(),
                ":descricao" => $automovel->getDescricao(),
                ":placa" => $automovel->getPlaca(),
                ":renavam" => $automovel->getRenavam(),
                ":marca" => $automovel->getMarca(),
                ":modelo" => $automovel->getModelo(),
                ":ano" => $automovel->getAno(),
                ":status" => $automovel->getStatus(),
                ":categoriacod" => $automovel->getCategoria()->getCod(),
                ":usuariocod" => $automovel->getUsuario()->getCod(),
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
            $sql = "SELECT cod, nome ,placa, marca, modelo, ano, status FROM automovel ORDER BY nome ASC";

            $dataTable = $this->pdo->ExecuteQuery($sql, NULL);

            $listaAutomovel = [];

            foreach ($dataTable as $resultado) {// O metodo foreach varre linha por linha na tabela, procurando o parametro AS.
                $automovel = new Automovel(); // Estrutura orientada a objetos, passasse o objeto Automovel, e nao os dados.
                $automovel->setCod($resultado["cod"]);
                $automovel->setNome($resultado["nome"]);
                $automovel->setPlaca($resultado["placa"]);
                $automovel->setMarca($resultado["marca"]);
                $automovel->setModelo($resultado["modelo"]);
                $automovel->setAno($resultado["ano"]);
                $automovel->setStatus($resultado["status"]);
                
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
    public function RetornarUsuarioAutomoveis(int $usuario) {
        try {
            $sql = "";
            $sql = "SELECT cod, nome ,placa, marca, modelo, ano, usuario_cod, status FROM automovel WHERE usuario_cod = :usuariocod ORDER BY nome ASC";

            $param = array(
                ":usuariocod" => $usuario);
            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaAutomovel = [];

            foreach ($dataTable as $resultado) {// O metodo foreach varre linha por linha na tabela, procurando o parametro AS.
                $automovel = new Automovel(); // Estrutura orientada a objetos, passasse o objeto Automovel, e nao os dados.
                $automovel->setCod($resultado["cod"]);
                $automovel->setNome($resultado["nome"]);
                $automovel->setPlaca($resultado["placa"]);
                $automovel->setMarca($resultado["marca"]);
                $automovel->setModelo($resultado["modelo"]);
                $automovel->setAno($resultado["ano"]);
                $automovel->setStatus($resultado["status"]);
                
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
    public function RetornarTodosFiltro(string $termo, string $placa, int $usuario) {
        try {
            $sql = "SELECT cod, nome, placa, marca,ano, status FROM automovel WHERE nome LIKE :termo AND placa = :placa AND usuario = :usuario ORDER BY nome ASC";
            $param = array(
                ":termo" => "%{$termo}%",
                ":placa" => $placa,
                ":usuario" => $usuario
                );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaAnuncio = [];
            foreach ($dt as $dr) {
                $automovel = new Automovel();
                $automovel->setCod($dr["cod"]);
                $automovel->setNome($dr["nome"]);
                $automovel->setMarca($dr["marca"]);
                $automovel->setAno($dr["ano"]);
                $automovel->setStatus($dr["status"]);
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

    public function RetornarAutomoveis(string $termo, int $tipo) {
        try {
            $sql = "";

            switch ($tipo) {
                case 1:
                $sql = "SELECT cod, nome, placa, marca, modelo, ano FROM automovel WHERE nome LIKE :termo ORDER BY nome ASC";
                break;
                case 2:
                $sql = "SELECT cod, nome, placa, marca, modelo, ano FROM automovel WHERE marca LIKE :termo ORDER BY nome ASC";
                break;
                case 3:
                $sql = "SELECT cod, nome, placa, marca, modelo, ano FROM automovel WHERE modelo LIKE :termo ORDER BY nome ASC";
                break;
                case 4:
                $sql = "SELECT cod, nome, placa, marca, modelo, ano FROM automovel WHERE placa LIKE :termo ORDER BY nome ASC";
                break;
            }

            $param = array(
                ":termo" => "%{$termo}%"
                );

            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaAutomovel = [];

            foreach ($dataTable as $resultado) {// O metodo foreach varre linha por linha na tabela, procurando o parametro AS.
                $automovel = new Automovel(); // Estrutura orientada a objetos, passasse o objeto Automovel, e nao os dados.
                $automovel->setCod($resultado["cod"]);
                $automovel->setNome($resultado["nome"]);
                $automovel->setPlaca($resultado["placa"]);
                $automovel->setMarca($resultado["marca"]);
                $automovel->setModelo($resultado["modelo"]);
                $automovel->setAno($resultado["ano"]);
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