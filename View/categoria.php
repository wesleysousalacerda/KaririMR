<?php
if (filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT)) {
    require_once ("Controller/AnuncioController.php");
    require_once ("Model/ViewModel/AnuncioConsulta.php");
    $anuncioController = new AnuncioController();
    $cat = filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT);
    $termo = filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING);
    if (strlen($termo) == 0) {
        $totalRegistros = $anuncioController->RetornarQuantidadeRegistrosCat(filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT));
    } else {
        $totalRegistros = $anuncioController->RetornarQuantidadeRegistros(filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING));
    }
    $totalAnunciosPagina = 5; //Alterar para mais
    $paginaAtual = 1;
    if (filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT)) {
        $paginaAtual = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);
    }
    $fim = ($paginaAtual * $totalAnunciosPagina);
    $inicio = ($fim - $totalAnunciosPagina);
    if (strlen($termo) == 0) {
        $listaConsulta = $anuncioController->RetornarPesquisaCat(filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT), $inicio, $totalAnunciosPagina);
    } else {
        $listaConsulta = $anuncioController->RetornarPesquisa(filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING), $inicio, $totalAnunciosPagina);
    }
}
?>

<div id="dvCategoria">
    <h1>Anúncios</h1>
    <br />

<?php
if (isset($listaConsulta)){
if (count($listaConsulta) > 0) {
    ?>
        <div id="dvCategoriaItens">
        <?php
        foreach ($listaConsulta as $anuncioConsulta) {
            ?>
                <div class="panel grid-100">
                    <div class="grid-30 mobile-grid-100 imgGridCategoria">
                        <a href="?pagina=anuncio&cod=<?= $anuncioConsulta->getCod(); ?>"><img src="img/Anuncios/<?= $anuncioConsulta->getImagem(); ?>" alt="<?= $anuncioConsulta->getNome(); ?>"/></a>
                    </div>

                    <div class="grid-70 mobile-grid-100 conteudoGridCategoria">
                        <h3><a href="?pagina=anuncio&cod=<?= $anuncioConsulta->getCod(); ?>"><?= $anuncioConsulta->getNome(); ?></a></h3>
        <?= $anuncioConsulta->getDescricao(); ?>
                        <br/><br/>
                        <p><a href="?pagina=anuncio&cod=<?= $anuncioConsulta->getCod(); ?>" class="btnAcessar">Acessar</a></p>
                        <br/>
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
    <?php
    $totalNumeracao = ceil($totalRegistros / $totalAnunciosPagina);
    $currentPage = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);
    $categoria = filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT);
    $termo = filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING);
    for ($i = 0; $i < $totalNumeracao; $i++) {
        ?>
                    <li><a href="?pagina=categoria&termo=<?= $termo; ?>&cat=<?= $categoria; ?>&pag=<?= ($i + 1); ?>"><?= ($i + 1); ?></a></li>
                    <?php
                }
                ?>

            </ul>
        </div>
                <?php
            } else {
                echo 'Desculpe, Não encontramos nenhum anuncio com o termo ou categoria especificados.';
            }
}
            ?>
    <br />
</div>