<?php
session_start();

if (isset($_SESSION["logado"])) {
    if (!$_SESSION["logado"]) {
        header("Location: index.php?msg=1");
    }
} else {
    header("Location: index.php?msg=1");
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <title>Kariri Multi Revendedoras - Painel</title>
    <meta charset="utf-8" />
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="../img/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="js/script.js" type="text/javascript"></script>
</head>
<body>
    <div id="dvConteudoPrincipal">
        <div class="row" id="dvTopo">
            <div class="col-xs-12 hidden-lg text-center">
                <div class="dvlogoTopo">
                    <span class="glyphicon glyphicon-menu-hamburger btn btn-default btn-lg" aria-hidden="true" id="btnMenuResponsive"></span>
                    <a href="painel.php"><img src="../img/logoKaririmr.png" style="width: 550px;" alt="Kariri Multi Revendedoras" /></a>
                </div>
            </div>
            <div class="col-xs-12 hidden-xs">
                <div class="dvlogoTopo">
                    <a href="painel.php"><img src="../img/logoKaririmr.png" style="width: 550px;" alt="Kariri Multi Revendedoras" /></a>
                </div>
            </div>
        </div>
        <?php
        if ($_SESSION["admin"]) {
            include("MenuAdmin.php");
        } else {
             include("MenuComum.php");
        }
        ?>

        <div class="col-xs-12 col-lg-10" id="dvDireita">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    require_once("../Util/RequestPage.php");
                    ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="row" id="dvRodape">
                <div class="col-lg-6 col-xs-12 alignCenter">
                    <p style="margin-top: 25px">&copy; Kariri Multi Revendedoras- Todos os Direitos Reservados</p>  
                </div>
                <div class="col-lg-3 col-xs-12 alignCenter">
                    <div id="iconesSociais">
                        <a href=""><img src="http://<?php echo $_SERVER['HTTP_HOST']?>/img/social/facebook.png" alt=""/></a>
                        <a href=""><img src="http://<?php echo $_SERVER['HTTP_HOST']?>/img/social/twitter.png" alt=""/></a>
                        <a href=""><img src="http://<?php echo $_SERVER['HTTP_HOST']?>/img/social/youtube.png" alt=""/></a>
                        <a href=""><img src="http://<?php echo $_SERVER['HTTP_HOST']?>/img/social/instagram.png" alt=""/></a>
                    </div>
                </div>
            </div>   
        </div>

        <!--Aqui termina o conteúdo da direita-->

    </div>


</div>

<script>
    $(document).ready(function () {
        $("#btnMenuResponsive").click(function () {
            $("#dvMenuResponsive").slideToggle("slow");
        });
    });
</script>
</body>
</html>