<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Home - Kariri Multi Revendedoras</title>
        <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, maximum-scale=1" />
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/unsemantic-grid-responsive.css" rel="stylesheet" media="all" />
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.ico" />
        <script src="js/script.js" type="text/javascript"></script>

    </head>
    <body>
        <!--Topo do site-->
        <div id="dvTopo">
            <a href="index.php"><img src="img/logoKaririmr.png" alt="Logo Kariri MultiRevendedoras" /></a>
        </div>

        <!--Menu principal do site-->
        <div id="dvMenuTopo">
            <div class="grid-container">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="?pagina=anuncie.php">Anuncie</a></li>
                    <li><a href="?pagina=cadastro">Cadastre-se</a></li>
                    <li><a href="?pagina=categoria">Categorias</a></li>
                    <li><a href="?pagina=termodeuso">Termos de uso</a></li>
                    <li><a href="?pagina=quemsomos">Quem somos</a></li>
                    <li><a href="?pagina=contato">Contato</a></li>
                    <li><a href="login.php">Login</a></li>                     
                </ul> 
            </div>
        </div>
        <br />
        <!--Conteúdo centro do site-->
        <div id="dvConteudo" class="grid-container">
            <h3>Filtre sua busca:</h3>
            <div class="grid-60 mobile-grid-100 suffix-10" id="dvEsquerda">
                <!--Menu Pesquisa-->
                <div class="grid-parent grid-100" id="boxBusca">
                    <input type="text" id="txtBusca" placeholder="Buscar  anúncios:" />
                    <select id="slBusca"></select>
                    <button  id="btnBuscar">Buscar</button>
                </div>
                <?php
                require_once("Util/ResquestPageSite.php");
                ?>
            </div> 

            <div class="grid-30 mobile-grid-100" id="dvDireita">
                <!--Redes sociais-->
                <div class="boxDireita grid-parent grid-100" id="iconesSociais">
                    <a href=""><img src="img/social/facebook.png" alt=""/></a>
                    <a href=""><img src="img/social/twitter.png" alt=""/></a>
                    <a href=""><img src="img/social/youtube.png" alt=""/></a>
                    <a href=""><img src="img/social/instagram.png" alt=""/></a>
                </div>

                
                <a class="imgGridCategoria" href=""><img src="img/anuncieaqui.png" alt="Anuncie Aqui"/></a>

                <!---->
                <div class="boxDireita grid-parent grid-100">
                    <p>Patrocinado</p>
                    <p>Patrocinio</p>
                </div>
            </div>
        </div>
        <br>
        <!--Rodapé do site-->
        <div id="dvRodape">
            <div class="grid-container">
                <div class="grid-100">
                    <p>&copy; Kariri Multi Revendedoras - Todos os Direitos Reservados</p>
                    <p class="term">Os vendedores e revendedores que anunciam nesta página são os únicos responsáveis pelas transações comerciais que realizam com usuários do web site kariri Multirevendedoras. A comercialização do produto anunciado, bem como a garantia de sua legítima procedência, é de inteira responsabilidade do anunciante, não sendo o KaririMR responsável por quaisquer danos diretos e/ou indiretos causados a terceiros, advindos da exibição dos anúncios em desacordo com o Código de Defesa do Consumidor e outras legislações aplicáveis ao comércio e/ou prestação de serviços por parte do anunciante. Para oferecer uma melhor experiência de navegação,
                        o KaririMR utiliza cookies. Ao navegar pelo site você concorda com o uso dos mesmos.</p>
                </div>
            </div>
        </div>
    </body>
</html>