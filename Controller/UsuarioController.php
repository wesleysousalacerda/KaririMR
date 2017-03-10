<?php

require_once("../DAL/UsuarioDAO.php");

class UsuarioController {

    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function Cadastrar(Usuario $usuario) {
        if (strlen($usuario->getNome()) >= 5 && strlen($usuario->getUsuario()) >= 7 && strpos($usuario->getEmail(), "@") && strpos($usuario->getEmail(), ".") &&
                strlen($usuario->getCpf()) == 14 && $usuario->getSexo() != "" && $usuario->getPermissao() >= 1 && $usuario->getPermissao() <= 2 && $usuario->getStatus() >= 1 && $usuario->getStatus() <= 2) {

            return $this->usuarioDAO->Cadastrar($usuario);
        } else {
            return false;
        }
    }

    public function RetornarUsuarios(string $termo, int $tipo) {
        if ($termo != "" && $tipo >= 1 && $tipo <= 4) {
            return $this->usuarioDAO->RetornarUsuarios($termo, $tipo);
        } else {
            return null;
        }
    }

}
