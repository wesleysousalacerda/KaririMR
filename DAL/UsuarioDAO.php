<?php

require_once("Banco.php");

class UsuarioDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Usuario $usuario) {
        try {
            $sql = "INSERT INTO usuario (nome, email, cpf, usuario, senha, nascimento, sexo, status, permissao, ip) VALUES (:nome, :email, :cpf, :usuario, :senha, :nascimento, :sexo, :status, :permissao, :ip)";
            $param = array(
                ":nome" => $usuario->getNome(),
                ":email" => $usuario->getEmail(),
                ":cpf" => $usuario->getCpf(),
                ":usuario" => $usuario->getUsuario(),
                ":senha" => $usuario->getSenha(),
                ":nascimento" => $usuario->getNascimento(),
                ":sexo" => $usuario->getSexo(),
                ":status" => $usuario->getStatus(),
                ":permissao" => $usuario->getPermissao(),
                ":ip" => $_SERVER["REMOTE_ADDR"],
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function Alterar(Usuario $usuario) {
        try {
            $sql = "UPDATE usuario SET nome = :nome, email = :email, cpf = :cpf, usuario = :usuario, nascimento = :nascimento , sexo = :sexo, status = :status, permissao = :permissao WHERE cod = :cod"; 
            $param = array(
                ":nome" => $usuario->getNome(),
                ":email" => $usuario->getEmail(),
                ":cpf" => $usuario->getCpf(),
                ":usuario" => $usuario->getUsuario(),
                ":nascimento" => $usuario->getNascimento(),
                ":sexo" => $usuario->getSexo(),
                ":status" => $usuario->getStatus(),
                ":permissao" => $usuario->getPermissao(),
                ":cod" =>$usuario->getCod(),
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }
    
    public function RetornarUsuarios(string $termo, int $tipo) {
        try {
            $sql = "";

            switch ($tipo) {
                case 1:
                    $sql = "SELECT cod, nome, usuario, status, permissao FROM usuario WHERE nome LIKE :termo ORDER BY nome ASC";
                    break;
                case 2:
                    $sql = "SELECT cod, nome, usuario, status, permissao FROM usuario WHERE email LIKE :termo ORDER BY nome ASC";
                    break;
                case 3:
                    $sql = "SELECT cod, nome, usuario, status, permissao FROM usuario WHERE cpf LIKE :termo ORDER BY nome ASC";
                    break;
                case 4:
                    $sql = "SELECT cod, nome, usuario, status, permissao FROM usuario WHERE usuario LIKE :termo ORDER BY nome ASC";
                    break;
            }

            $param = array(
                ":termo" => "%{$termo}%"
            );

            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaUsuario = [];

            foreach ($dataTable as $resultado) { // O metodo foreach varre linha por linha na tabela, procurando o parametro AS.
                $usuario = new Usuario(); // Estrutura orientada a objetos, passasse o objeto Usuario, e nao os dados.
                $usuario->setCod($resultado["cod"]);
                $usuario->setNome($resultado["nome"]);
                $usuario->setStatus($resultado["status"]);
                $usuario->setPermissao($resultado["permissao"]);
                $usuario->setUsuario($resultado["usuario"]);

                $listaUsuario[] = $usuario;
            }

            return $listaUsuario;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornaCod(int $usuarioCod) {
        try {
            $sql = "SELECT nome,email,cpf,usuario,nascimento,sexo,status,permissao FROM usuario WHERE cod = :cod";
            $param = array(
                ":cod" => $usuarioCod
            );
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            if ($dt != null) {
                $usuario = new Usuario();
                $usuario->setNome($dt["nome"]);
                $usuario->setEmail($dt["email"]);
                $usuario->setCpf($dt["cpf"]);
                $usuario->setUsuario($dt["usuario"]);
                $usuario->setNascimento($dt["nascimento"]);
                $usuario->setSexo($dt["sexo"]);
                $usuario->setStatus($dt["status"]);
                $usuario->setPermissao($dt["permissao"]);
                return $usuario;
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }
    
    public function AutenticarUsuarioPainel(string $usu, string $senha){
        
        try {
            $sql = "SELECT cod, nome FROM usuario WHERE status = 1 AND permissao = 1 AND usuario = :usuario AND senha = :senha";
            
       
            $param = array(  //Array associativo para passar os dados do usuário
                ":usuario" => $usu,
                ":senha" => $senha
            );
            
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            if($dt != null){
                $usuario = new Usuario();
                
                $usuario->setCod($dt["cod"]);
                $usuario->setNome($dt["nome"]);
               
                
                return $usuario;
                        
            }else{
                return null;
            }
            
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
        }
    }

?>