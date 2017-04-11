<?php

require_once("Banco.php");

class ImagemDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
    }

    public function CadastrarImagens(array $imagem) {
        //http://stackoverflow.com/questions/6523062/php-function-arguments-array-of-objects-of-a-specific-class
        try {
            $erros = 0;

            $this->pdo->BeginTransaction();

            foreach ($imagem as $i) {
                $sql = "INSERT INTO imagens (imagem, anuncio_cod) VALUES (:imagem, :anunciocod)";
                $param = array(
                    ":imagem" => $i->getImagem(),
                    ":anunciocod" => $i->getAnuncio()->getCod()
                );
                if (!$this->pdo->ExecuteNonQuery($sql, $param)) {
                    $erros++;
                }
            }

            if ($erros == 0) {
                $this->pdo->Commit();
                return true;
            } else {
                $this->pdo->Rollback();
                return false;
            }
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            $this->pdo->Rollback();
            return false;
        }
    }

    public function CarregarImagensAnuncio(int $anuncioCod) {
        try {
            $sql = "SELECT cod, imagem FROM imagens WHERE anuncio_cod = :anunciocod";
            $param = array(
                ":anunciocod" => $anuncioCod
            );

            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaImagens = [];

            foreach ($dt as $dr) {
                $imagem = new Imagem();
                $imagem->setCod($dr["cod"]);
                $imagem->setImagem($dr["imagem"]);

                $listaImagens[] = $imagem;
            }

            return $listaImagens;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function VerificarArquivoExiste(int $anuncioCod, int $imagemCod) {
        try {
            $sql = "SELECT imagem FROM imagens WHERE anuncio_cod  = :anunciocod AND cod = :cod";
            $param = array(
                ":anunciocod" => $anuncioCod,
                ":cod" => $imagemCod
            );

            $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);

            return $dr["imagem"];
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RemoverImagem(int $anuncioCod, int $imagemCod) {
        try {
            $sql = "DELETE FROM imagens WHERE anuncio_cod  = :anunciocod AND cod = :cod";
            $param = array(
                ":anunciocod" => $anuncioCod,
                ":cod" => $imagemCod
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