<?php
require_once ("Banco.php");
class UsuarioDAO{
   
    private $pdo;
    
    public function __construct() {
        $this->pdo = new Banco();
    }
            
    public function Cadastrar(Usuario $usuario) {
       $sql = "INSERT INTO usuario(nome, email, cpf, usuario, senha, nascimento, sexo, status, plano_id, permissao_id, logradouro_cod ) VALUES(:nome, :email, :cpf, :usuario, :senha, :nascimento, :sexo, :status, :plano_id, :permissao_id, :logradouro_cod)";
    $parem = array(
        ":nome" => $usuario->getNome(),
        ":email" => $usuario->getEmail(),
        ":cpf" => $usuario->getCpf(),
        ":usuario" => $usuario->getUsuario(),
        ":senha" => $usuario->getSenha(),
        ":nascimento" => $usuario->getNascimento(),
        ":sexo" => $usuario->getSexo(),
        ":status" => $usuario->getStatus(),
        ":plano_id"=>$usuario->getPlano_id(),
        ":permissao_id" => $usuario->getPermissao_id(),
        ":logradouro_cod" => $usuario->getLogradouro_cod(),
       );
    }
    
    
    
}



?>

