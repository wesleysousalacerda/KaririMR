<!DOCTYPE html>
<html lang="pt-br">
    <head>
            <meta charset="utf-8" />
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../img/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
        <div id="dvPainel" class="centralizada">
            <div class="row">
                <div class="col-lg-12" id="dvTopo">
                    <div id="dvlogoTopo" class="alignCenter">
                        <a href="painel.php"><img src="../img/logoKaririmr.jpg" alt="Logo Kariri Multi Revendedoras" /></a>
                    </div>
                    <div id="dvMenuTopo" class="alignCenter">
                        <ul id="ulMenu">
                            <li><a href="painel.php">Inicio</a></li>
                            <li><a href="?pagina=usuario">Usuário</a></li>
                            <li><a href="?pagina=classificado">Classificados</a></li>
                            <li><a href="?pagina=categoria">Categoria</a></li>
                            <li><a href="?pagina=contato">Contato</a></li>
                            <li><a href="?pagina=sair">Sair</a></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" id="dvConteudo">
                    <?php
                    require_once("../Util/RequestPage.php");
                    ?>
                    <div class="clear"></div>
                </div>

            </div>
        </div>
        <div id="dvRodape" class="col-lg-12">
            <div class="centralizada">
                <div class="col-lg-6 col-xs-12">
                    <br /><br />
                    <p>&copy; Kariri Multi Revendedoras - Todos os Direitos Reservados</p>  
                </div>

                <div class="col-lg-6 col-xs-12">
                    <a href="#">Facebook</a><br  />
                    <a href="#">Twitter</a><br  />
                    <a href="#">Instagram</a><br  />
                </div>
            </div>
        </div> 
    </body>
</html>