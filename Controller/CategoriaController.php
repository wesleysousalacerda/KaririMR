<?php

require_once("../DAL/CategoriaDAO.php");

class CategoriaController {

    private $categoriaDAO;

    function __construct() {
        $this->categoriaDAO = new CategoriaDAO();
    }

    public function Cadastrar(Categoria $categoria) {
        if (strlen($categoria->getNome()) > 2 && strlen($categoria->getLink()) > 2 && $categoria->getThumb() != "" && strlen($categoria->getDescricao()) > 10) {
            return $this->categoriaDAO->Cadastrar($categoria);
        } else {
            return false;
        }
    }

    public function Alterar(Categoria $categoria) {
        if (strlen($categoria->getNome()) > 2 && strlen($categoria->getLink()) > 2 && $categoria->getCod() > 0 && strlen($categoria->getDescricao()) > 10) {
            return $this->categoriaDAO->Alterar($categoria);
        } else {
            return false;
        }
    }

    public function AlterarImagem(string $thumb, int $cod) {
        if (trim(strlen($thumb)) > 0 && $cod > 0) {
            return $this->categoriaDAO->AlterarImagem($thumb, $cod);
        } else {
            return false;
        }
    }

    public function RetornarCategoriasResumido() {
        return $this->categoriaDAO->RetornarCategoriasResumido();
    }
    public function RetornarCategorias() {
        return $this->categoriaDAO->RetornarCategorias();
    }

    public function RetornarTodosJSON() {
        return $this->categoriaDAO->RetornarTodosJSON();
    }

    public function RetornarTodosCat() {
        return $this->categoriaDAO->RetornarTodosCat();
    }

    public function RetornarTodosSub() {
        return $this->categoriaDAO->RetornarTodosSub();
    }

    public function RetornarCod(int $cod) {

        if ($cod > 0) {
            return $this->categoriaDAO->RetornarCod($cod);
        } else {
            return null;
        }
    }

}
