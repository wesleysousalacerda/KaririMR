<?php

if(file_exists("../DAL/AnuncioDAO.php")){
require_once("../DAL/AnuncioDAO.php");
}elseif(file_exists("DAL/AnuncioDAO.php")){
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
    
    public function RetornarPesquisa(int $categoriaCod, string $termo) {
        if (strlen($termo) >= 3 && $categoriaCod > 0) {
            return $this->anuncioDAO->RetornarCompletoCod($categoriaCod, $termo);
        } else {
            return null;
        }
    }

}

?>