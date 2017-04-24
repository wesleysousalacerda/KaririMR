<?php

if (file_exists("../DAL/AnuncioDAO.php")) {
    require_once("../DAL/AnuncioDAO.php");
} elseif (file_exists("DAL/AnuncioDAO.php")) {
    require_once("DAL/AnuncioDAO.php");
}

class AnuncioController {

    private $anuncioDAO;

    function __construct() {
        $this->anuncioDAO = new anuncioDAO();
    }

    public function Cadastrar(Anuncio $anuncio) {
        if (trim(strlen($anuncio->getNome())) > 0 && $anuncio->getValor() > 0 && $anuncio->getStatus() > 0 && $anuncio->getPerfil() > 0 && $anuncio->getTipo() > 0 && trim(strlen($anuncio->getDescricao())) >= 10 && $anuncio->getCategoria()->getCod() > 0 && $anuncio->getUsuario()->getCod() > 0) {
            return $this->anuncioDAO->Cadastrar($anuncio);
        } else {
            return false;
        }
    }

    public function Alterar(Anuncio $anuncio) {
        if (trim(strlen($anuncio->getNome())) > 0 && $anuncio->getValor() > 0 && $anuncio->getStatus() > 0 && $anuncio->getPerfil() > 0 && $anuncio->getTipo() > 0 && trim(strlen($anuncio->getDescricao())) >= 10 && $anuncio->getCategoria()->getCod() > 0 && $anuncio->getCod() > 0) {
            return $this->anuncioDAO->Alterar($anuncio);
        } else {
            return false;
        }
    }

    public function RetornarTodosFiltro(string $termo, int $tipo, int $status, int $perfil, int $categoriacod) {

        if (strlen($termo) > 0 && $tipo > 0 && $status > 0 && $perfil > 0 && $categoriacod > 0) {
            return $this->anuncioDAO->RetornarTodosFiltro($termo, $tipo, $status, $perfil, $categoriacod);
        } else {
            return null;
        }
    }

    public function RetornarTodosAnuncios() {
        return $this->anuncioDAO->RetornarTodosAnuncios();
    }

    public function RetornarCod(int $cod) {
        if ($cod > 0) {
            return $this->anuncioDAO->RetornarCod($cod);
        } else {
            return null;
        }
    }

    public function RetornarCompletoCod($cod) {
        if ($cod > 0) {
            return $this->anuncioDAO->RetornarCompletoCod($cod);
        } else {
            return null;
        }
    }

    public function RetornarQuantidadeRegistros(int $categoriaCod, string $termo) {
<<<<<<< HEAD
        if (strlen($termo) >= 3 && $categoriaCod > 0) {
            return $this->anuncioDAO->RetornarQuantidadeRegistros($categoriaCod, $termo);
        } else {
            return 0;
        }
    }

    public function RetornarPesquisa(int $categoriaCod, string $termo, int $inicio, int $fim) {
        if (strlen($termo) >= 3 && $categoriaCod > 0) {
=======
        if (strlen($termo) >= 3 && $categoriaCod > 0) {
            return $this->anuncioDAO->RetornarQuantidadeRegistros($categoriaCod, $termo);
        } else {
            return 0;
        }
    }
    public function RetornarQuantidadeRegistrosCat(int $categoriaCod) {
        if ( $categoriaCod > 0) {
            return $this->anuncioDAO->RetornarQuantidadeRegistrosCat($categoriaCod);
        } else {
            return 0;
        }
    }

    public function RetornarPesquisa(int $categoriaCod, string $termo, int $inicio, int $fim) {
        if (strlen($termo) >= 1 && $categoriaCod > 0) {
>>>>>>> refs/remotes/origin/prod
            return $this->anuncioDAO->RetornarPesquisa($categoriaCod, $termo, $inicio, $fim);
        } else {
            return null;
        }
    }
<<<<<<< HEAD
=======
     public function RetornarPesquisaCat(int $categoriaCod, int $inicio, int $fim) {
        if ($categoriaCod > 0) {
            return $this->anuncioDAO->RetornarPesquisaCat($categoriaCod, $inicio, $fim);
        } else {
            return null;
        }
    }
>>>>>>> refs/remotes/origin/prod

    public function RetornarAnuncioCod(int $cod) {
        if ($cod > 0) {
            return $this->anuncioDAO->RetornarAnuncioCod($cod);
        } else {
            return null;
        }
    }

}

?>