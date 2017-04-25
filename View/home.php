<?php
require_once ("Controller/AnuncioController.php");
require_once ("Model/ViewModel/AnuncioConsulta.php");
$anuncioController = new AnuncioController();
$totalRegistros = $anuncioController->RetornarQuantidadeRegistrosTotal(); // Retorna todos os registros ativos

$totalAnunciosPagina = 5; //Alterar para mais
$paginaAtual = 1;

if (filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT)) {
    $paginaAtual = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);
}
$fim = ($paginaAtual * $totalAnunciosPagina);
$inicio = ($fim - $totalAnunciosPagina);
$listaConsulta = $anuncioController->RetornarPesquisaTotal($inicio, $totalAnunciosPagina);
?>   
<div id="dvHome">
    <h1>Bem-vindo</h1>
    <h2>Ao maior site de revendas de automóveis do Cariri.</h2>
    <br />
    <?php
    if (isset($listaConsulta)) {
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
                    for ($i = 0; $i < $totalNumeracao; $i++) {
                        ?>
                        <li><a href="?pagina=home&pag=<?= ($i + 1); ?>"><?= ($i + 1); ?></a></li>
                        <?php
                    }
                    ?>

                </ul>
                <br>
            </div>

            <?php
        } else {
            echo 'Desculpe, Não encontramos nenhum anuncio com o termo ou categoria especificados.';
        }
    }
    ?>
</div>