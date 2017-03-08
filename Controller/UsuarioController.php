<?php

require_once ("../DAL/UsuarioDAO.php");
class UsuarioController{
    private $usuarioDAO;
    
    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }
    
    public function Cadastrar(Usuario $usuario) {
        if(strlen($usuario->getNome()) >= 5 && strpos($usuario->getEmail(), "@") && strpos($usuario->getEmail(), ".") &&
                strlen($usuario->getCpf()) == 14 && $usuario->getSexo() != "" && $usuario->getPermissao_id() >= 1 &&
                $usuario->getLogradouro_cod() >= 1 && $usuario->getPlano_id() >= 1 && $usuario->getPermissao_id() <= 3 
                && $usuario->getStatus() >= 1 && $usuario->getStatus() <= 2){
            
            return $this->usuarioDAO->Cadastrar($usuario);
        }else{
            return false;
        }
    }
}

