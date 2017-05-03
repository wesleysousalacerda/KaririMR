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
            $automovel->getModelo() >= 1 && $automovel->getAno() == 4 && $automovel->getStatus() == 1 && $automovel->getCategoria() >= 1 && $automovel->getUsuario() >= 1) {

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
public function RetornarTodosFiltro(string $termo, string $placa, int $usuario) {
    if (strlen($termo) > 0 && $placa > 0 && $usuario > 0) {
        return $this->automovelDAO->RetornarTodosFiltro($termo, $placa, $usuario);
    } else {
        return null;
    }
}
public function RetornarAutomoveis(string $termo, int $tipo) {
    if ($termo != "" && $tipo >= 1 && $tipo <= 4) {
        return $this->automovelDAO->RetornarAutomoveis($termo, $tipo);
    } else {
        return null;
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
