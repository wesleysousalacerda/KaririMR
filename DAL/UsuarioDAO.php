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

            foreach ($dataTable as $resultado) {
                $usuario = new Usuario();
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

}

?>