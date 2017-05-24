<?php

require_once("../DAL/RevendedoraDAO.php");

class RevendedoraController {

    private $revendedoraDAO;

    public function __construct() {
        $this->revendedoraDAO = new RevendedoraDAO();
    }

    public function Cadastrar(Revendedora $revendedora) {
        // if (strlen($revendedora->getRazaosocial()) >= 1 && strlen($revendedora->getCnpj()) == 14 && strlen($revendedora->getFantasia()) >= 2 && 
        //         strlen($revendedora->getInsc_estadual()) >=10 && $revendedora->getDescricao() >= 10 && $revendedora->getUsuario() >= 1 ) {
        
            return $this->revendedoraDAO->Cadastrar($revendedora);
        // } else {
        //     return false;
        // }
    }

    public function Alterar(Usuario $usuario) {
        if (strlen($usuario->getNome()) >= 5 && strlen($usuario->getUsuario()) >= 7 && strpos($usuario->getEmail(), "@") && strpos($usuario->getEmail(), ".") &&
                strlen($usuario->getCpf()) == 14 && $usuario->getSexo() != "" && $usuario->getPermissao() >= 1 && $usuario->getPermissao() <= 2 && $usuario->getStatus() >= 1 && $usuario->getStatus() <= 2) {

            return $this->usuarioDAO->Alterar($usuario);
        } else {
            return false;
        }
    }

    public function RetornarRevendedoras(string $termo) {
        if ($termo != "") {
            return $this->revendedoraDAO->RetornarRevendedoras($termo);
        } else {
            return null;
        }
    }

    public function RetornarTodasRevendedoras() {
        return $this->revendedoraDAO->RetornarTodasRevendedoras();
    }

    public function RetornaCod(int $revendaCod) {
        if ($revendaCod > 0) {
            return $this->revendedoraDAO->RetornaCod($revendaCod);
        } else {
            return null;
        }
    }

    public function AutenticarUsuarioPainel(string $usu, string $senha) {

        if (strlen($usu) >= 7 && strlen($senha) >= 7) {
            $senha = md5($senha);
            return $this->usuarioDAO->AutenticarUsuarioPainel($usu, $senha);
        } else {
            return null;
        }
    }

    public function AlterarSenha(string $senha, int $cod) {
        if (strlen($senha) >= 7 && $cod > 0) {

            return $this->usuarioDAO->AlterarSenha($senha, $cod);
        } else {
            return false;
        }
    }    
    
    public function VerificaUsuarioExiste(string $user) {
        if (strlen($user) >= 3) {
            return $this->usuarioDAO->VerificaUsuarioExiste($user);
        } else {
            -10;
        }
    }

}
