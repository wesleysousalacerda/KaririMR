<?php
if (filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING) && filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT)) {

    require_once ("Controller/AnuncioController.php");
    require_once ("Model/ViewModel/AnuncioConsulta.php");

    $AnuncioController = new AnuncioController();

    $listaConsulta = $AnuncioController->RetornarPesquisa(filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT) && filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING));
    $cat = filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT);
    
}
?>

<div id="dvCategoria">
    <h1>Categorias</h1>
    <br />
    
<?php
    
if (count($listaConsulta) > 0) {
    ?>
        <div id="dvCategoriaItens">
        <?php
        foreach($listaConsulta as $anuncioConsulta) {
            ?>
                <div class="panel grid-100">
                    <div class="grid-30 mobile-grid-100 imgGridCategoria">
                        <img src="img/<?=$anuncioConsulta->getImagem();?>" alt=""/>
                    </div>

                    <div class="grid-70 mobile-grid-100 conteudoGridCategoria">
                        <h3><?=$anuncioConsulta->getNome();?></h3>
                        <?=$anuncioConsulta->getDescricao();?>
                    </div>
                    <div class="clear"></div>
                </div>
                <br />
        <?php
    }
    ?>
        </div>

        <div class="paginacao">
            <ul>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
            </ul>
        </div>
    <?php
} else {
    echo 'Desculpe, Nao encontramos nenhum classificado com o termo especificado.';
}
?>
    <br />
</div>