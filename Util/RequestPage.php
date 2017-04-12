<?php

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);

$arrayPaginas = array(
    "home" => "View/home.php", //Página inicial
    "contato" => "View/ContatoView/ContatoView.php",
    "usuario" => "View/UsuarioView/UsuarioView.php",
    "endereco" => "View/UsuarioView/EnderecoView.php",
    "telefone" => "View/UsuarioView/TelefoneView.php",
    "alterarsenha" => "View/UsuarioView/AlterarSenhaView.php",
    "visualizarusuario" => "View/UsuarioView/VisualizarView.php",
    "anuncio" => "View/AnuncioView/AnuncioView.php",
    "visualizarusuario" => "View/UsuarioView/VisualizarView.php",
    "alterarsenha" => "View/UsuarioView/AlterarSenhaView.php",
    "categoria" => "View/CategoriaView/CategoriaView.php",
    "subcategoria" => "View/CategoriaView/SubcategoriaView.php",
    "categoriaimagem" => "View/CategoriaView/AlterarImagem.php",
    "gerenciarimagemanuncio" => "View/AnuncioView/ImagensAnuncioView.php",
    "visualizaranuncio" => "View/AnuncioView/VisualizarAnuncio.php",
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