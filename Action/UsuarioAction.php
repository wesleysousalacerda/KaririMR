<?php

require_once ("../Controller/UsuarioController.php");
require_once ("../Model/Usuario.php");

$usuarioController = new UsuarioController();

$req = filter_input(INPUT_GET, "req", FILTER_SANITIZE_NUMBER_INT);

/*
 * 1- Verifica se o usuário existe. 
 */
switch ($req) {
    case 1:
        $usuario = filter_input(INPUT_POST, "txtUsuario", FILTER_SANITIZE_STRING);
        echo $usuarioController->VerificaUsuarioExiste($usuario);
        break;
}
?>