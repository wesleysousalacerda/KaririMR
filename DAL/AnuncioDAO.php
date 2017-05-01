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
    public function RetornarTodosAnuncios() {
        try {
            $sql = "SELECT cod, nome, status FROM anuncio ORDER BY nome ASC";
            $dt = $this->pdo->ExecuteQuery($sql, NULL);
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
            $sql = "SELECT a.nome as anunnome, a.descricao, a.tipo, a.valor, a.status, a.perfil, ca.nome as catnome, u.nome as usnome FROM anuncio a " .
                    "INNER JOIN categoria ca ON ca.cod = a.categoria_cod " .
                    "INNER JOIN usuario u ON u.cod = a.usuario_cod " .
                    "WHERE a.cod = :cod";
            $param = array(
                ":cod" => $cod
            );
            $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);
            //dt = Data Table
            //dr = Data Row
            $anuncio = new Anuncio();
            $anuncio->setNome($dr["anunnome"]);
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
    public function RetornarQuantidadeRegistros(int $categoriaCod, string $termo) {
        try {
            $sql = "SELECT count(anun.cod) as total FROM anuncio anun WHERE anun.categoria_cod = :categoriacod AND anun.nome LIKE :termo AND anun.status = 1";
            $param = array(
                ":categoriacod" => $categoriaCod,
                ":termo" => "%{$termo}%"
            );
            $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);
            if ($dr["total"] != null) {
                return $dr["total"];
            } else {
                return 0;
            }
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }
     public function RetornarQuantidadeRegistrosCat(int $categoriaCod) {
        try {
            $sql = "SELECT count(anun.cod) as total FROM anuncio anun WHERE anun.categoria_cod = :categoriacod AND anun.status = 1";
            $param = array(
                ":categoriacod" => $categoriaCod,
            );
            $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);
            if ($dr["total"] != null) {
                return $dr["total"];
            } else {
                return 0;
            }
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }
    public function RetornarQuantidadeRegistrosTotal() {
        try {
            $sql = "SELECT count(anun.cod) as total FROM anuncio anun WHERE anun.status = 1";
            $dr = $this->pdo->ExecuteQueryOneRow($sql, NULL);
            if ($dr["total"] != null) {
                return $dr["total"];
            } else {
                return 0;
            }
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }
    public function RetornarPesquisa(int $categoriaCod, string $termo, int $inicio, int $fim) {
        try {
            $sql = "SELECT anun.cod, anun.nome, anun.descricao, (SELECT imagem FROM imagens WHERE anuncio_cod = anun.cod ORDER BY cod ASC LIMIT 1) as img FROM anuncio anun WHERE anun.categoria_cod = :categoriacod AND anun.nome LIKE :termo AND anun.status = 1 LIMIT :inicio, :fim";
            $param = array(
                ":categoriacod" => $categoriaCod,
                ":termo" => "%{$termo}%",
                ":inicio" => $inicio,
                ":fim" => $fim
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaAnuncio = [];
            foreach ($dt as $dr) {
                $anuncioConsulta = new AnuncioConsulta();
                $anuncioConsulta->setCod($dr["cod"]);
                $anuncioConsulta->setNome($dr["nome"]);
                $anuncioConsulta->setDescricao($dr["descricao"]);
                $anuncioConsulta->setImagem($dr["img"]);
                $listaAnuncio[] = $anuncioConsulta;
            }
            return $listaAnuncio;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }
    public function RetornarPesquisaCat(int $categoriaCod, int $inicio, int $fim) {
        try {
            $sql = "SELECT anun.cod, anun.nome, anun.descricao, (SELECT imagem FROM imagens WHERE anuncio_cod = anun.cod ORDER BY cod ASC LIMIT 1) as img FROM anuncio anun WHERE anun.categoria_cod = :categoriacod AND anun.status = 1 LIMIT :inicio, :fim";
            $param = array(
                ":categoriacod" => $categoriaCod,
                ":inicio" => $inicio,
                ":fim" => $fim
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaAnuncio = [];
            foreach ($dt as $dr) {
                $anuncioConsulta = new AnuncioConsulta();
                $anuncioConsulta->setCod($dr["cod"]);
                $anuncioConsulta->setNome($dr["nome"]);
                $anuncioConsulta->setDescricao($dr["descricao"]);
                $anuncioConsulta->setImagem($dr["img"]);
                $listaAnuncio[] = $anuncioConsulta;
            }
            return $listaAnuncio;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }
    public function RetornarPesquisaTotal(int $inicio, int $fim) {
        try {
            $sql = "SELECT anun.cod, anun.nome, anun.descricao, (SELECT imagem FROM imagens WHERE anuncio_cod = anun.cod ORDER BY cod ASC LIMIT 1) as img FROM anuncio anun WHERE anun.status = 1 ORDER BY anun.perfil ASC LIMIT :inicio, :fim";
            $param = array(
                ":inicio" => $inicio,
                ":fim" => $fim
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaAnuncio = [];
            foreach ($dt as $dr) {
                $anuncioConsulta = new AnuncioConsulta();
                $anuncioConsulta->setCod($dr["cod"]);
                $anuncioConsulta->setNome($dr["nome"]);
                $anuncioConsulta->setDescricao($dr["descricao"]);
                $anuncioConsulta->setImagem($dr["img"]);
                $listaAnuncio[] = $anuncioConsulta;
            }
            return $listaAnuncio;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }
        public function RetornarAnuncioCod(int $cod) {
        try {
            $sql = "SELECT anun.cod, anun.nome, anun.descricao, anun.tipo, anun.valor, cat.nome as catnome, us.nome as usnome, us.email usemail FROM anuncio anun INNER JOIN categoria cat ON cat.cod = anun.categoria_cod INNER JOIN usuario us ON us.cod = anun.usuario_cod WHERE anun.cod = :cod AND anun.status = 1";
            $param = array(
                ":cod" => $cod
            );
            $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);
            $anuncio = new Anuncio();
            $anuncio->setCod($dr["cod"]);
            $anuncio->setNome($dr["nome"]);
            $anuncio->setDescricao($dr["descricao"]);
            $anuncio->setTipo($dr["tipo"]);
            $anuncio->setValor($dr["valor"]);
            //Anuncio
            $anuncio->getCategoria()->setNome($dr["catnome"]);
            //Usuário
            $anuncio->getUsuario()->setNome($dr["usnome"]);
            $anuncio->getUsuario()->setEmail($dr["usemail"]);
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