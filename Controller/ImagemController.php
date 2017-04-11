<?php

require_once("../DAL/ImagemDAO.php");

class ImagemController {

    private $imagemDAO;

    function __construct() {
        $this->imagemDAO = new ImagemDAO();
    }

    public function CadastrarImagens(array $imagem) {
        if ($imagem != null) {
            return $this->imagemDAO->CadastrarImagens($imagem);
        } else {
            return false;
        }
    }

    public function CarregarImagensAnuncio(int $anuncioCod) {
        if ($anuncioCod > 0) {
            return $this->imagemDAO->CarregarImagensAnuncio($anuncioCod);
        } else {
            return null;
        }
    }

    public function VerificarArquivoExiste(int $anuncioCod, int $imagemCod) {
        if ($anuncioCod > 0 && $imagemCod > 0) {
            return $this->imagemDAO->VerificarArquivoExiste($anuncioCod, $imagemCod);
        } else {
            return null;
        }
    }

    public function RemoverImagem(int $anuncioCod, int $imagemCod) {
        if ($anuncioCod > 0 && $imagemCod > 0) {
            return $this->imagemDAO->RemoverImagem($anuncioCod, $imagemCod);
        } else {
            return false;
        }
    }

}
