<?php

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);

$arrayPaginas = array(
    "home" => "View/home.php", //Página inicial
    "contato" => "View/ContatoView/ContatoView.php",
    "usuario" => "View/UsuarioView/UsuarioView.php",
    "endereco" => "View/UsuarioView/EnderecoView.php",
    "anuncio" => "View/AnuncioView/AnuncioView.php",
    "categoria" => "View/CategoriaView/CategoriaView.php"
);

if ($pagina) {
    $encontrou = false;

    foreach ($arrayPaginas as $page => $key) {
        if ($pagina == $page) {
            $encontrou = true;
            require_once($key);
        }
    }

    if (!$encontrou) {
        require_once("View/home.php");
    }
} else {
    require_once("View/home.php");
}
?>