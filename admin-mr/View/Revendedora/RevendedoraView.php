<?php
require_once ("../Controller/RevendedoraController.php");
require_once ("../Model/Revendedora.php");
require_once("../Model/Usuario.php");
require_once("../Controller/UsuarioController.php");

$revendedoraController = new RevendedoraController();
$usuarioController = new UsuarioController();

$cod = 1;
$razaosocial = "";
$cnpj = "";
$fantasia = "";
$descricao = "";
$insc_estadual = "";
$usuario = "";
$resultado = "";
$spResultadoBusca = "";
$listaRevenda = [];
if (filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)) {
    $usuario = filter_input(INPUT_POST, "txtUsuario", FILTER_SANITIZE_STRING);
    $revendedora = new Revendedora();

    $revendedora->setRazaosocial(filter_input(INPUT_POST, "txtRazaosocial", FILTER_SANITIZE_STRING));
    $revendedora->setCnpj(filter_input(INPUT_POST, "txtCnpj", FILTER_SANITIZE_STRING));
    $revendedora->setFantasia(filter_input(INPUT_POST, "txtFantasia", FILTER_SANITIZE_STRING));
    $revendedora->setInsc_estadual(filter_input(INPUT_POST, "txtInscricao", FILTER_SANITIZE_STRING));
    $revendedora->setDescricao(filter_input(INPUT_POST, "txtDescricao", FILTER_SANITIZE_STRING));
    $usercod = $usuarioController->RetornarUser($usuario);
    if ($usercod != null){
        $revendedora->getUsuario()->setCod($usercod);
        if (!filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT)) {
        //Cadastrar

            if ($revendedoraController->Cadastrar($revendedora)) {
                ?>
                <script>
                    document.cookie = "msg=1";
                    document.location.href = "?pagina=revendedora";
                //Script para evitar que o banco seja cadastrado toda vez que recarregar a pagina. 
                //o Cookie redirecionara para a pagina de revendedora.
            </script>
            <?php
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar cadastrar a revendedora.</div>";
        }
    } else {
        //Editar
        $revendedora->setCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));

        if ($revendedoraController->Alterar($revendedora)) {
            ?>
            <script>
                document.cookie = "msg=2";
                document.location.href = "?pagina=revendedora";
                //Script para evitar que o banco seja cadastrado toda vez que recarregar a pagina. 
                //o Cookie redirecionara para a pagina de revendedora.
            </script>
            <?php
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar alterar a revendedora.</div>";
        }
    }
}else{
    $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Nome de usuario não cadastrado!.</div>";
}
}//FIm Cadastrar
//Buscar usuários
?>
<script>
</script>
<?php 
if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {
    $termo = filter_input(INPUT_POST, "txtTermo", FILTER_SANITIZE_STRING);
    if ($termo != ""){
        $listaRevenda = $revendedoraController->RetornarRevendedoras($termo);
    }else{
     $spResultadoBusca = "Insira termo de pesquisa.";
 }
 if ($listaRevenda != null) {
    $spResultadoBusca = "Exibindo dados";
} else {
    $spResultadoBusca = "Dados não encontrado";
}
}else if (filter_input(INPUT_POST, "btnBuscarTudo", FILTER_SANITIZE_STRING)) {
   $listaRevenda = $revendedoraController->RetornarTodasRevendedoras();
}

if (filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT)) {
    $retornoRevenda = $revendedoraController->RetornaCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));
    $cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
    $razaosocial = $retornoRevenda->getRazaosocial();
    $fantasia = $retornoRevenda->getFantasia();
    $usuario = $retornoRevenda->getUsuario();
    $insc_estadual = $retornoRevenda->getInsc_estadual();
    $descricao = $retornoRevenda->getDescricao();
    $cnpj = $retornoRevenda->getCnpj();
}
?>
<!DOCTYPE html>
<div id="dvRevendedoraView">
    <h1>Gerenciar Revendedoras</h1>
    <br />
    <div class="controlePaginas">
        <a href="?pagina=revendedora"><img src="img/icones/editar.png" alt=""/></a>
        <a href="?pagina=revendedora&consulta=s"><img src="img/icones/buscar.png" alt=""/></a>
    </div>

    <br />
    <!--DIV CADASTRO -->
    <?php
    if (!filter_input(INPUT_GET, "consulta", FILTER_SANITIZE_STRING)) {
        ?>
        <div class="panel panel-default maxPanelWidth">
            <div class="panel-heading">Cadastrar e editar</div>
            <div class="panel-body">
                <form method="post" id="frmGerenciarRevendedora" name="frmGerenciarRevendedora" novalidate>

                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <input type="hidden" id="txtUsuario" value=1 />
                                <label for="txtRazaosocial">Razão Social</label>
                                <input type="text" class="form-control" id="txtRazaosocial" name="txtRazaosocial" placeholder="Razão Social" value="<?= $razaosocial; ?>">
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="txtCnpj">CNPJ</label>
                                <input type="text" class="form-control" id="txtCnpj" name="txtCnpj" placeholder="cnpj"  value="<?= $cnpj; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="txtFantasia">Nome Fantasia</label>
                                <input type="text" class="form-control" id="txtFantasia" name="txtFantasia" placeholder="Nome Fantasia"  value="<?= $fantasia; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="txtInscricao">Incrição Estadual</label>
                                <input type="text" class="form-control" id="txtInscricao" name="txtInscricao" placeholder="Incrição Estadual"  value="<?= $insc_estadual; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="txtDescricao">Descrição</label>
                                <input type="text" class="form-control" id="txtDescricao" name="txtDescricao" placeholder="" value="<?= $descricao; ?>"/>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <label for="txtUsuario">Usuário <span id="spValidaUsuario"></span></label>
                                <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" placeholder="Usuario"  value="<?= $usuario; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p id="pResultado"><?= $resultado; ?></p>
                        </div>
                    </div>
                    <input class="btn btn-success" type="submit" name="btnGravar" value="Gravar">
                    <a href="#" class="btn btn-danger">Cancelar</a>

                    <br />
                    <br />
                    <div class="row">
                        <div class="col-lg-12">
                            <ul id="ulErros"></ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {
        ?>
        <br />
        <!--DIV CONSULTA -->
        <div class="panel panel-default maxPanelWidth">
            <div class="panel-heading">Consultar</div>
            <div class="panel-body">
                <form method="post" name="frmBuscarRevendedora" id="frmBuscarRevendedora">
                    <div class="row">
                        <div class="col-lg-8 col-xs-12">
                           <!--  <div class="form-group">
                                <label for="txtTermo">Termo de busca</label>
                                <input type="text" class="form-control" id="txtTermo" name="txtTermo" placeholder="Ex: Hilton Veiculos" />
                            </div> -->
                            <div class="input-group">
                              <input type="text" class="form-control" id="txtTermo" name="txtTermo" placeholder="Revendedora...">
                              <span class="input-group-btn">
                                  <input class="btn btn-primary" type="submit" name="btnBuscar" value="Buscar"> 
                                  <input class="btn btn-success" type="submit" name="btnBuscarTudo" value="Buscar Todas">
                              </span>
                          </div><!-- /input-group -->
                          <span><?= $spResultadoBusca; ?></span>

                      </div>
                  </div>
              </form>

              <hr />
              <br />

              <table class="table table-responsive table-hover table-striped">
                <thead>
                    <tr>
                        <th>Razão Social</th>
                        <th>Fantasia</th>
                        <th>Usuario</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($listaRevenda != null) {
                        foreach ($listaRevenda as $revenda) {
                            ?>
                            <tr>
                                <td><?= $revenda->getRazaosocial(); ?></td>
                                <td><?= $revenda->getFantasia(); ?></td>
                                <td><?= $revenda->getUsuario(); ?></td>
                                <td>
                                    <a href="?pagina=visualizarrevenda&cod=<?= $revenda->getCod(); ?>" class="btn btn-success">Visualizar</a>
                                    <a href="?pagina=revendedora&cod=<?= $revenda->getCod(); ?>" class="btn btn-warning">Editar</a>                                                
                                    <a href="?pagina=usuario&cod=<?= $revenda->getCod(); ?>" class="btn btn-danger">Usuario</a>
                                    <a href="?pagina=endereco&cod=<?= $revenda->getCod(); ?>" class="btn btn-info">Endereço</a>
                                    <a href="?pagina=telefone&cod=<?= $revenda->getCod(); ?>" class="btn btn-primary">Imagem</a>
                                </tr>

                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<script src="../js/mask.js" type="text/javascript">
</script>
<script>
    $(document).ready(function () {
        if (getCookie("msg") == 1) {
            document.getElementById("pResultado").innerHTML = "<div class=\"alert alert-success\" role=\"alert\">Revendedora cadastrada com sucesso.</div>";
            document.cookie = "msg=d";
        } else if (getCookie("msg") == 2) {
            document.getElementById("pResultado").innerHTML = "<div class=\"alert alert-success\" role=\"alert\">Revendedora alterada com sucesso.</div>";
            document.cookie = "msg=d";
        }
        $("#frmGerenciarRevendedora").submit(function (e) {
            if (!ValidarFormulario()) {
                e.preventDefault();
            }
        });
    });
    function ValidarFormulario() {
        var erros = 0;
        var ulErros = document.getElementById("ulErros");
        ulErros.style.color = "red";
        ulErros.innerHTML = "";
        //Javascript nativo
        if (document.getElementById("txtRazaosocial").value.length < 5) {
            var li = document.createElement("li");
            li.innerHTML = "- Informe uma Razao Social válida";
            ulErros.appendChild(li);
            erros++;
        }

        if (document.getElementById("txtCnpj").value.length != 14) {
            var li = document.createElement("li");
            li.innerHTML = "- Informe um cnpj válido";
            ulErros.appendChild(li);
            erros++;
        }
        if (document.getElementById("txtFantasia").value.length < 2) {
            var li = document.createElement("li");
            li.innerHTML = "- Informe um Nome Fantasia válido";
            ulErros.appendChild(li);
            erros++;
        }


        if (erros === 0) {
            return true;
        } else {
            return false;
        }
    }
    function ValidaUsuario() {
        var usuario = $("#txtUsuario").val();
        if (usuario.length >= 3) {
            $.ajax({
                url: "../Action/UsuarioAction.php?req=1",
                data: {txtUsuario: $("#txtUsuario").val()},
                type: "POST",
                dataType: "text",
                success: function (retorno) {
                    if (retorno == - 1) {
                        $("#spValidaUsuario").text("Usuário Não Cadastrado");
                        $("#spValidaUsuario").css("color", "#39C462");
                        alert('Nao cadastrado');
                    } else if (retorno == 1){
                        $("#spValidaUsuario").text("Usuário Válido");
                        $("#spValidaUsuario").css("color", "#FF4500");
                        alert('Cadastrado');
                    } else{
                        $("#spValidaUsuario").text("Erro ao válidar");
                        $("#spValidaUsuario").css("color", "#FF3730");
                    }
                },
                error: function (erro) {
                    console.log(erro);
                }
            });
        } else {
            return - 10;
        }
    }

</script>
