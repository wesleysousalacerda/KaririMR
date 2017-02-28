<?php
require_once ("Banco.php");
class UsuarioDAO{
   
    private $pdo;
    
    public function __construct() {
        $this->pdo = new Banco();
    }
            
    public function Cadastrar(Usuario $usuario) {
        return "ok" . $usuario->getNome();
    }
    
}



?>

