<?php

require_once("../DAL/AutomovelDAO.php");

class AutomovelController {

    private $automovelDAO;

    public function __construct() {
        $this->automovelDAO = new AutomovelDAO();
    }

    public function Cadastrar(Automovel $automovel) {
        if (strlen($automovel->getNome()) >= 1 && strlen($automovel->getDescricao()) >= 10 &&
                strlen($automovel->getPlaca()) == 7 && $automovel->getRenavam() == 11 && $automovel->getMarca() >= 1 &&
                $automovel->getModelo() >= 1 && $automovel->getAno() == 4 && $automovel->getCategoria() >= 1) {

            return $this->automovelDAO->Cadastrar($automovel);
        } else {
            return false;
        }
    }

    public function Alterar(Automovel $automovel) {
        if (strlen($automovel->getNome()) >= 1 && strlen($automovel->getDescricao()) >= 10 &&
                strlen($automovel->getPlaca()) == 7 && $automovel->getRenavam() == 11 && $automovel->getMarca() >= 1 &&
                $automovel->getModelo() >= 1 && $automovel->getAno() == 4 && $automovel->getCategoria() >= 1) {

            return $this->automovelDAO->Alterar($automovel);
        } else {
            return false;
        }
    }

    public function RetornarTodosAutomoveis() {
        return $this->automovelDAO->RetornarTodosAutomoveis();
    }

    public function RetornaCod(int $automovelCod) {
        if ($automovelCod > 0) {
            return $this->automovelDAO->RetornaCod($automovelCod);
        } else {
            return null;
        }
    }
}
