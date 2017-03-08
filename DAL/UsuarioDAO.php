<?php
require_once ("Banco.php");
class UsuarioDAO{
   
    private $pdo;
    
    public function __construct() {
        $this->pdo = new Banco();
    }
            
    public function Cadastrar(Usuario $usuario) {
       $sql = "INSERT INTO usuario(nome, email, cpf, usuario, senha, nascimento, sexo, status, permissao, ip) VALUES(:nome, :email, :cpf, :usuario, :senha, :nascimento, :sexo, :status, :permissao, :ip)";
    $parem = array(
        ":nome" => $usuario->getNome(),
        ":email" => $usuario->getEmail(),
        ":cpf" => $usuario->getCpf(),
        ":usuario" => $usuario->getUsuario(),
        ":senha" => $usuario->getSenha(),
        ":nascimento" => $usuario->getNascimento(),
        ":sexo" => $usuario->getSexo(),
        ":status" => $usuario->getStatus(),
        ":permissao" => $usuario->getPermissao(),
        
       );
    }
    
    
    
}



?>

