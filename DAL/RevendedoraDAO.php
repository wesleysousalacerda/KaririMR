<?php

require_once("Banco.php");

class RevendedoraDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Revendedora $revendedora) {
        try {
            $sql = "INSERT INTO revendedora (razaosocial,cnpj, fantasia, insc_estadual, descricao, usuario_cod) VALUES (:razaosocial, :cnpj, :fantasia, :insc_estadual, :descricao, :usuariocod)";
            $param = array(
                ":razaosocial" => $revendedora->getRazaosocial(),
                ":cnpj" => $revendedora->getCnpj(),
                ":fantasia" => $revendedora->getFantasia(),
                ":insc_estadual" => $revendedora->getInsc_estadual(),
                ":descricao" => $revendedora->getDescricao(),
                ":usuariocod" => $revendedora->getUsuario()->getCod()
                );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function Alterar(Revendedora $revendedora) {
        try {
            $sql = "UPDATE usuario SET nome = :nome, email = :email, cpf =:cpf, usuario = :usuario, nascimento = :nascimento, sexo = :sexo, status = :status, permissao =:permissao WHERE cod = :cod";
            $param = array(
                ":nome" => $usuario->getNome(),
                ":email" => $usuario->getEmail(),
                ":cpf" => $usuario->getCpf(),
                ":usuario" => $usuario->getUsuario(),
                ":nascimento" => $usuario->getNascimento(),
                ":sexo" => $usuario->getSexo(),
                ":status" => $usuario->getStatus(),
                ":permissao" => $usuario->getPermissao(),
                ":cod" => $usuario->getCod()
                );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function RetornarRevendedoras(string $termo) {
        try {
            $sql = "";
            $sql = "SELECT cod, razaosocial, fantasia, usuario_cod FROM revendedora WHERE fantasia LIKE :termo ORDER BY fantasia ASC";


            $param = array(
                ":termo" => "%{$termo}%"
                );

            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaRevenda = [];

            foreach ($dataTable as $resultado) {// O metodo foreach varre linha por linha na tabela, procurando o parametro AS.
                $revendedora = new Revendedora(); // Estrutura orientada a objetos, passasse o objeto Revendedora,nao os dados.
                $revendedora->setCod($resultado["cod"]);
                $revendedora->setRazaosocial($resultado["razaosocial"]);
                $revendedora->setFantasia($resultado["fantasia"]);
                $revendedora->setUsuario($resultado["usuario_cod"]);
                $listaRevenda[] = $revendedora;
            }

            return $listaRevenda;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornarTodasRevendedoras() {
        try {
            $sql = ""; 
            $sql = "SELECT cod, razaosocial, fantasia, usuario_cod FROM revendedora ORDER BY fantasia ASC";

            $dataTable = $this->pdo->ExecuteQuery($sql, NULL);

            $listaRevendaTodos = [];

            foreach ($dataTable as $resultado) {// O metodo foreach varre linha por linha na tabela, procurando o parametro AS.
                $revendedora = new Revendedora(); // Estrutura orientada a objetos, passasse o objeto Revendedora,nao os dados.
                $revendedora->setCod($resultado["cod"]);
                $revendedora->setRazaosocial($resultado["razaosocial"]);
                $revendedora->setFantasia($resultado["fantasia"]);
                $revendedora->setUsuario($resultado["usuario_cod"]);

                $listaRevendaTodos[] = $revendedora;
            }

            return $listaRevendaTodos;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornaCod(int $revendaCod) {
        try {
            $sql = "SELECT razaosocial,cnpj, fantasia, insc_estadual, descricao, usuario_cod FROM revendedora WHERE cod = :cod";
            $param = array(
                ":cod" => $revendaCod
                );

            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            if ($dt != null) {
                $revenda = new Revendedora();

                $revenda->setRazaosocial($dt["razaosocial"]);
                $revenda->setCnpj($dt["cnpj"]);
                $revenda->setFantasia($dt["fantasia"]);
                $revenda->setInsc_estadual($dt["insc_estadual"]);
                $revenda->setDescricao($dt["descricao"]);
                $revenda->setUsuario($dt["usuario_cod"]);
                return $revenda;
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

    public function AutenticarUsuarioPainel(string $usu, string $senha) {
        try {
            $sql = "SELECT cod, nome FROM usuario WHERE status = 1 AND permissao = 1 AND usuario = :usuario AND senha = :senha";

            $param = array(
                ":usuario" => $usu,
                ":senha" => $senha
                );

            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            if ($dt != null) {
                $usuario = new Usuario();
                $usuario->setCod($dt["cod"]);
                $usuario->setNome($dt["nome"]);

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

    public function AlterarSenha(string $senha, int $cod) {
        try {
            $sql = "UPDATE usuario SET senha = :senha WHERE cod = :cod";
            $param = array(
                ":senha" => md5($senha),
                ":cod" => $cod
                );
            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    //____________Validar dados existentes_________________________\\
    public function VerificaUsuarioExiste(string $user) {
        try {
            $sql = "SELECT usuario FROM usuario WHERE usuario = :usuario";

            $param = array(
                ":usuario" => $user
                );

            $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);


            if (!empty($dr)) {
                return 1;
            } else {
                return -1;
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