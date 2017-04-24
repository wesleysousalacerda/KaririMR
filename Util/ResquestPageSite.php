<?php

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);

$arrayPaginas = array(
    "home" => "View/home.php", //Página inicial
    "contato" => "View/contato.php",
    "anuncio" => "View/anuncio.php",
    "categoria" => "View/categoria.php",
    "quemsomos" => "View/quemsomos.php",
    "cadastro" => "View/cadastro.php"

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