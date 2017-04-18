<?php

if (filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING) && filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT)){
    


require_once ("Controller/AnuncioController.php");
require_once ("Model/ViewModel/AnuncioConsulta.php");

$anuncioController = new AnuncioController();
}
?>

<div id="dvCategoria">
    <h1>Categorias</h1>
    <br />
    <div id="dvCategoriaItens">

        <div class="panel grid-100">
            <div class="grid-30 mobile-grid-100 imgGridCategoria">
                <img src="img/Anuncios/db1f82cf3d2dc13ff4a31390fa72ee7e0.jpg" alt=""/>
            </div>
            
            <div class="grid-70 mobile-grid-100 conteudoGridCategoria">
            <h3>Nome do Produto</h3>
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="panel grid-100">
            <div class="grid-30 mobile-grid-100 imgGridCategoria">
                <img src="img/Anuncios/db1f82cf3d2dc13ff4a31390fa72ee7e0.jpg" alt=""/>
            </div>
            
            <div class="grid-70 mobile-grid-100 conteudoGridCategoria">
            <h3>Nome do Produto</h3>
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="panel grid-100">
            <div class="grid-30 mobile-grid-100 imgGridCategoria">
                <img src="img/Anuncios/db1f82cf3d2dc13ff4a31390fa72ee7e0.jpg" alt=""/>
            </div>
            
            <div class="grid-70 mobile-grid-100 conteudoGridCategoria">
            <h3>Nome do Produto</h3>
            </div>
            <div class="clear"></div>
        </div>
        
        <br />
    </div>
    
    <div class="paginacao">
        <ul>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
        </ul>
    </div>
    <br />
</div>