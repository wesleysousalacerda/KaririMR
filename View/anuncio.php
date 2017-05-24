<?php
$cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
$anuncio = null;
if ($cod > 0) {
    require_once("Controller/AnuncioController.php");
    require_once("Model/Anuncio.php");
    $anuncioController = new AnuncioController();

    $anuncio = $anuncioController->RetornarAnuncioCod($cod);
}
?>

<div id="dvAnuncio">
    <?php
    if ($anuncio->getCod() > 0) {

        $tipoAnucio = "";
        if ($anuncio->getTipo() == 1) {
            $tipoAnucio = "Venda";
        } else if ($anuncio->getTipo() == 2) {
            $tipoAnucio = "Troca";
        } else {
            $tipoAnucio = "Venda ou Troca";
        }
        ?>
        <h1><?= $anuncio->getNome(); ?></h1>
        <br />
        <div id="sliderImagemAnuncio">
            <img src="img/Anuncios/0123b9a2f5ad25d54d3de9891603cbd10.jpg" alt=""/>
        </div>
        <br />
        <p><span class="bold">Proprietário:</span> <?= $anuncio->getUsuario()->getNome(); ?></p>
        <p><span class="bold">E-mail:</span> <?= $anuncio->getUsuario()->getEmail(); ?></p> <!--Verificar se é necessário o envio de e-mail-->
        <div class="line"></div>

        <p><span class="bold">Categoria:</span> <?= $anuncio->getCategoria()->getNome(); ?></p>
        <br/>
        <p><span class="bold">Tipo de anúncio:</span> <?= $tipoAnucio; ?></p>
        <br/>
        <p><span class="bold">Valor:</span> <?= number_format($anuncio->getValor(), 2, ",", " "); ?></p>
        <br/>
        <p><span class="bold">Descrição:</span> <?= $anuncio->getDescricao(); ?></p>
        <!-- <div class="row"> -->

<button onclick="renavam()">Concultar Renavam</button> 
<iframe  style="" id="iframe-servicos" name="iframe" src="http://erenavam.detran.ce.gov.br/getran/consultaInternet.do?method=consultaCompleta" width="300px" height="200" </iframe>
    <?php
} else {
    ?>
    <h1>Conteúdo não encontrado</h1>
    <br />
    <div>
        <p>Desculpe, o anuncio que você procura não existe ou não foi encontrado.</p>
        <p>Por favor, faça uma busca através do menu acima.</p>
    </div>
    <?php
}
?>

</div>
<br />
<script>
    $(document).ready(function () {
        function renavam() {
            console.log('Passei aqui')
            document.getElementById("iframe-servicos").style.display = "";
        }
    };
</script>