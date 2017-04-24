<?php
if (filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT)) {

    require_once ("Controller/AnuncioController.php");
    require_once ("Model/ViewModel/AnuncioConsulta.php");

    $anuncioController = new AnuncioController();
<<<<<<< HEAD

    $totalRegistros = $anuncioController->RetornarQuantidadeRegistros(filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING));
    $totalAnunciosPagina = 3; //Alterar para mais
=======
    $cat = filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT);
    $termo = filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING);
    if (strlen($termo) == 0) {
        $totalRegistros = $anuncioController->RetornarQuantidadeRegistrosCat(filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT));
    } else {
        $totalRegistros = $anuncioController->RetornarQuantidadeRegistros(filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING));
    }
    $totalAnunciosPagina = 5; //Alterar para mais
>>>>>>> refs/remotes/origin/prod

    $paginaAtual = 1;

    if (filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT)) {
        $paginaAtual = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);
    }

    $fim = ($paginaAtual * $totalAnunciosPagina);
    $inicio = ($fim - $totalAnunciosPagina);
<<<<<<< HEAD

    $listaConsulta = $anuncioController->RetornarPesquisa(filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING), $inicio, $totalAnunciosPagina);
=======
    if (strlen($termo) == 0) {
        $listaConsulta = $anuncioController->RetornarPesquisaCat(filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT), $inicio, $totalAnunciosPagina);
    } else {
        $listaConsulta = $anuncioController->RetornarPesquisa(filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING), $inicio, $totalAnunciosPagina);
    }
>>>>>>> refs/remotes/origin/prod
}
?>

<div id="dvCategoria">
    <h1>Categorias</h1>
    <br />

<<<<<<< HEAD
    <?php
    if (count($listaConsulta) > 0) {
        ?>
        <div id="dvCategoriaItens">
            <?php
            foreach ($listaConsulta as $anuncioConsulta) {
                ?>
=======
<?php
if (isset($listaConsulta)){
if (count($listaConsulta) > 0) {
    ?>
        <div id="dvCategoriaItens">
        <?php
        foreach ($listaConsulta as $anuncioConsulta) {
            ?>
>>>>>>> refs/remotes/origin/prod
                <div class="panel grid-100">
                    <div class="grid-30 mobile-grid-100 imgGridCategoria">
                        <a href="?pagina=anuncio&cod=<?= $anuncioConsulta->getCod(); ?>"><img src="img/Anuncios/<?= $anuncioConsulta->getImagem(); ?>" alt="<?= $anuncioConsulta->getNome(); ?>"/></a>
                    </div>

                    <div class="grid-70 mobile-grid-100 conteudoGridCategoria">
                        <h3><a href="?pagina=anuncio&cod=<?= $anuncioConsulta->getCod(); ?>"><?= $anuncioConsulta->getNome(); ?></a></h3>
<<<<<<< HEAD
                        <?= $anuncioConsulta->getDescricao(); ?>
=======
        <?= $anuncioConsulta->getDescricao(); ?>
>>>>>>> refs/remotes/origin/prod
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
<<<<<<< HEAD
                <?php
                $totalNumeracao = ceil($totalRegistros / $totalAnunciosPagina);
                $currentPage = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);
                $categoria = filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT);
                $termo = filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING);
                for ($i = 0; $i < $totalNumeracao; $i++) {
                    ?>
=======
    <?php
    $totalNumeracao = ceil($totalRegistros / $totalAnunciosPagina);
    $currentPage = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);
    $categoria = filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT);
    $termo = filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING);
    for ($i = 0; $i < $totalNumeracao; $i++) {
        ?>
>>>>>>> refs/remotes/origin/prod
                    <li><a href="?pagina=categoria&termo=<?= $termo; ?>&cat=<?= $categoria; ?>&pag=<?= ($i + 1); ?>"><?= ($i + 1); ?></a></li>
                    <?php
                }
                ?>

            </ul>
        </div>
<<<<<<< HEAD
        <?php
    } else {
        echo 'Desculpe, Não encontramos nenhum classificado com o termo especificado.';
    }
    ?>
=======
                <?php
            } else {
                echo 'Desculpe, Não encontramos nenhum anuncio com o termo especificado.';
            }
}
            ?>
>>>>>>> refs/remotes/origin/prod
    <br />
</div>