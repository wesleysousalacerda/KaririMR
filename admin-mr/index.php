<?php

session_start(); 
require_once ("../Controller/UsuarioController.php");
require_once ("../Model/Usuario.php");

$retorno = "&nbsp;";

if (filter_input(INPUT_POST, "btnEntrar", FILTER_SANITIZE_STRING)) {

    $usuarioController = new UsuarioController();
    $user = filter_input(INPUT_POST, "txtUsuario", FILTER_SANITIZE_STRING);
    $pass = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING);

    $resultado = $usuarioController->AutenticarUsuarioPainel($user, $pass);
    
    if ($resultado != null) {
        $_SESSION["cod"] = $resultado->getCod();
        $_SESSION["nome"] = $resultado->getNome();
        $_SESSION["logado"] = true;
        header("Location: painel.php");
        
    } else {
        $retorno = "<div class=\"alert alert-danger\" role=\"alert\">Usuario ou senha inválidos.</div>";
    }
}
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <title>Kariri Multi Revendedoras - Login</title>
        <meta charset="utf-8" />
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../img/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
        <div id="dvLogin">
            <form method="post">
                <div class="row">
                    <div class="col-lg-12 alignCenter">
                        <img src="../img/logoKaririmr.jpg" alt="Kariri Multi Revendedoras"/>
                    </div>
                    <div class="clear"></div>

                    <br /> 
                    <div class="borderBottom"></div>
                    <br /> 

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="txtUsuario">Usuário</label>
                            <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" placeholder="Usuário">
                        </div>
                        <div class="form-group">
                            <label for="txtSenha">Senha</label>
                            <input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="*******">
                        </div>
                        <input class="btn btn-success" type="submit" name="btnEntrar" value="Entrar">
                        <a href="#" data-toggle="modal" data-target="#myModal">Recuperar senha</a>
                    </div>

                    <p>&nbsp</p>
                    <div class="col-lg-12">
                        <?=$retorno;?>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Recuparar senha</h4>
                    </div>
                    <div class="modal-body">
                        <p>Para recuperar a sua senha, por favor, dentre em contato com o administrador.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Sair</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus();
            })
        </script>
    </body>
</html>