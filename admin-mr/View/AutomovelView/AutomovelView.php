<?php
require_once("../Model/Automovel.php");
require_once("../Model/Categoria.php");
require_once("../Model/Usuario.php");
require_once("../Controller/CategoriaController.php");
require_once("../Controller/AutomovelController.php");
require_once("../Controller/UsuarioController.php");

$categoriaController = new CategoriaController();
$automovelController = new AutomovelController();
$usuarioController = new UsuarioController();


$ctg = 0;
$nome = "";
$descricao = "";
$placa = "";
$renavam = "";
$marca = "";
$modelo = "";
$ano = "";
$status = 1;

$usuario = ($_SESSION["cod"]);
$resultado = "";
$spResultadoBusca = "";
if (filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)) {
    $automovel = new Automovel();

    $automovel->setCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));
    $automovel->setNome(filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING));
    $automovel->setDescricao(filter_input(INPUT_POST, "txtDescricao", FILTER_SANITIZE_STRING));
    $automovel->setPlaca(filter_input(INPUT_POST, "txtPlaca", FILTER_SANITIZE_STRING));
    $automovel->setRenavam(filter_input(INPUT_POST, "txtRenavam", FILTER_SANITIZE_STRING));
    $automovel->setMarca(filter_input(INPUT_POST, "txtMarca", FILTER_SANITIZE_STRING));
    $automovel->setModelo(filter_input(INPUT_POST, "txtModelo", FILTER_SANITIZE_STRING));
    $automovel->setAno(filter_input(INPUT_POST, "txtAno", FILTER_SANITIZE_STRING));
    $automovel->setStatus($status);
    $automovel->getUsuario()->setCod($usuario);
    // $automovel->getUsuario()->setCod(filter_input(INPUT_POST, "txtUsuario", FILTER_SANITIZE_NUMBER_INT));;
    $automovel->getCategoria()->setCod(filter_input(INPUT_POST, "slCategoria", FILTER_SANITIZE_NUMBER_INT));


//    $automovel->setCategoria(9);

    if (!filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT)) {
        //Cadastrar

        if ($automovelController->Cadastrar($automovel)) {
            ?>
            <script>
                document.cookie = "msg=1";
                document.location.href = "?pagina=automovel";
                //Script para evitar que o banco seja cadastrado toda vez que recarregar a pagina. 
                //o Cookie redirecionara para a pagina de automovel.
            </script>
            <?php
        } else {

            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar cadastrar o automovel.</div>"
            ;
            // var_dump($automovel);       
        }
    } else {
        //Editar
        // $automovel->setCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));

        if ($automovelController->Alterar($automovel)) {
            ?>
            <script>
                document.cookie = "msg=2";
                document.location.href = "?pagina=automovel";
                //Script para evitar que o banco seja cadastrado toda vez que recarregar a pagina. 
                //o Cookie redirecionara para a pagina de automovel.
            </script>
            <?php
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar alterar o automóvel.</div>";
        }
    }
}
$listaBusca = [];

//Buscar automoveis

if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {

    $termo = filter_input(INPUT_POST, "txtTermo", FILTER_SANITIZE_STRING);
    $placa = filter_input(INPUT_POST, "txtPlacaBusca", FILTER_SANITIZE_STRING);
    $usuario = filter_input(INPUT_POST, "txtUsuario", FILTER_SANITIZE_NUMBER_INT);
    if ($termo != NULL && $placa != NULL && $usuario != NULL) {
        $listaBusca = $automovelController->RetornarTodosFiltro($termo, $placa, $usuario);
    } else {
        $Bresultado = "<div class=\"alert alert-danger\" role=\"alert\">Insira todos os campos.</div>";
    }
} else if (filter_input(INPUT_POST, "btnBuscarTodos", FILTER_SANITIZE_STRING)) {
    $listaBusca = $automovelController->RetornarTodosAutomoveis();
}

if (filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT)) {
    $retornoAutomovel = $automovelController->RetornaCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));

    $cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
    $nome = $retornoAutomovel->getNome();
    $descricao = $retornoAutomovel->getDescricao();
    $placa = $retornoAutomovel->getPlaca();
    $renavam = $retornoAutomovel->getRenavam();
    $marca = $retornoAutomovel->getMarca();
    $modelo = $retornoAutomovel->getModelo();
    $status = $retornoAutomovel->getStatus();
    $ano = $retornoAutomovel->getAno();
    $usuario = $retornoAutomovel->getUsuario();
    $categoria = $retornoAutomovel->getCategoria();
}
$listaCategoria = $categoriaController->RetornarCategorias();
?>

<!DOCTYPE html>
<div id="dvAutomovelView">
    <h1>Gerenciar Automoveis</h1>
    <br />
    <div class="controlePaginas">
        <a href="?pagina=automovel"><img src="img/icones/editar.png" alt=""/></a>
        <a href="?pagina=automovel&consulta=s"><img src="img/icones/buscar.png" alt=""/></a>
    </div>

    <br />
    <!--DIV CADASTRO -->
    <?php
    if (!filter_input(INPUT_GET, "consulta", FILTER_SANITIZE_STRING)) {
        ?>
        <div class="panel panel-default maxPanelWidth">
            <div class="panel-heading">Cadastrar e editar</div>
            <div class="panel-body">
                <form method="post" id="frmGerenciarAutomovel" name="frmGerenciarAutomovel" novalidate>

                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="form-group">
                                <input type="hidden" id="txtCodAutomovel" value="<?= $cod; ?>" />
                                <input type="hidden" id="txtUsuario" value="<?= $usuario; ?>" />
                                <input type="hidden" id="txtStatus" value=1 />
                                <label for="txtNome">Nome do automovel:</label>
                                <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome do autmovel" value="">
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
                                <label for="txtPlaca">Placa:</label>
                                <input type="text" class="form-control" id="txtPlaca" name="txtPlaca" placeholder="placa"  value="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
                                <label for="txtMarca">Marca:</label>
                                <input type="text" class="form-control" id="txtMarca" name="txtMarca" placeholder="marca"  value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
                                <label for="txtModelo">Modelo:</label>
                                <input type="text" class="form-control" id="txtModelo" name="txtModelo" placeholder=""  value="">
                            </div>
                        </div>
                        <div class="col-lg-2 col-xs-12">
                            <div class="form-group">
                                <label for="txtAno">Ano:</label>
                                <input type="text" class="form-control" id="txtAno" name="txtAno" placeholder="" />
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-12">
                            <div class="form-group">
                                <label for="txtRenavam">Renavam:</label>
                                <input type="text" class="form-control" id="txtRenavam" name="txtRenavam" placeholder=""/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
                                <label for="slCategoria">Categoria</label>
                                <select class="form-control" id="slCategoria" name="slCategoria">
                                    <option value="">Selecione</option>
                                    <?php
                                    foreach ($listaCategoria as $cat) {
                                        ?>
                                        <option value="<?= $cat->getCod() ?>" <?= ($ctg == $cat->getCod() ? "selected='selected'" : "") ?> <?= ($cat->getSubcategoria() == null ? "style='font-weight: bold;'" : "") ?>><?= $cat->getNome() ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <p style="font-weight: 700;">Descrição</p>
                            <textarea class="form-control" id="txtDescricao" name="txtDescricao"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <p id="pResultado"><?= $resultado; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input class="btn btn-success" type="submit" name="btnGravar" value="Gravar">
                        <a href="#" class="btn btn-danger">Cancelar</a>
                    </div>
                    <br />
                    <br />    
                    <div class="row">
                        <div class="col-lg-12">
                            <ul id="ulErros">

                            </ul>
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
                <form method="post" name="frmBuscarAutomovel" id="frmBuscarAutomovel">
                    <div class="row">
                        <div class="col-lg-8 col-xs-12">
                            <div class="form-group">
                                <label for="txtTermo">Termo de busca</label>
                                <input type="text" class="form-control" id="txtTermo" name="txtTermo" placeholder="Ex: camaro amarelo" />
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-12">
                            <div class="form-group">
                                <label for="slTipoBusca">Tipo</label>
                                <select class="form-control" id="slTipoBusca" name="slTipoBusca">
                                    <option value="1">Nome</option>
                                    <option value="2">Marca</option>
                                    <option value="3">Modelo</option>
                                    <option value="4">Placa</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <input class="btn btn-info" type="submit" name="btnBuscar" value="Buscar"> 
                            <span><?= $spResultadoBusca; ?></span>
                            <input class="btn btn-success" type="submit" name="btnBuscarTudo" value="Buscar Todos"> 

                        </div>

                    </div>
                </form>

                <hr />
                <br />

                <table class="table table-responsive table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Placa</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Ano</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($listaBusca != null) {
                            foreach ($listaBusca as $auto) {
                                ?>
                                <tr>
                                    <td><?= $auto->getNome(); ?></td>
                                    <td><?= $auto->getPlaca(); ?></td>
                                    <td><?= $auto->getMarca(); ?></td>
                                    <td><?= $auto->getModelo(); ?></td>
                                    <td><?= $auto->getAno(); ?></td>
                                    <td>
                                        <a href="?pagina=visualizarautomovel&cod=<?= $auto->getCod(); ?>" class="btn btn-success">Visualizar</a>
                                        <a href="?pagina=automovel&cod=<?= $auto->getCod(); ?>" class="btn btn-warning">Editar</a>                                                
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
<script src="../js/mask.js" type="text/javascript"></script>
<script src="../Util/ckeditor/ckeditor.js"></script>


<script>
        $(document).ready(function () {
            CKEDITOR.replace('txtDescricao');
            if (getCookie("msg") == 1) {
                document.getElementById("pResultado").innerHTML = "<div class=\"alert alert-success\" role=\"alert\">Automovel cadastrado com sucesso.</div>";
                document.cookie = "msg=d";
            } else if (getCookie("msg") == 2) {
                document.getElementById("pResultado").innerHTML = "<div class=\"alert alert-success\" role=\"alert\">Automovel alterado com sucesso.</div>";
                document.cookie = "msg=d";
            }
            $("#frmGerenciarAutomovel").submit(function (e) {
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
            if (document.getElementById("txtNome").value.length < 1) {
                var li = document.createElement("li");
                li.innerHTML = "- Informe um nome válido";
                ulErros.appendChild(li);
                erros++;
            }

            if (document.getElementById("txtMarca").value.length < 1) {
                var li = document.createElement("li");
                li.innerHTML = "- Informe um nome de marca válido";
                ulErros.appendChild(li);
                erros++;
            }

            if (document.getElementById("txtRenavam").value.length != 11) {
                var li = document.createElement("li");
                li.innerHTML = "- Informe um renavam válido (11 digitos)";
                ulErros.appendChild(li);
                erros++;
            }
            if (document.getElementById("txtPlaca").value.length != 7) {
                var li = document.createElement("li");
                li.innerHTML = "- Informe uma placa válida (7 digitos)";
                ulErros.appendChild(li);
                erros++;
            }
            if (document.getElementById("txtAno").value.length != 4) {
                var li = document.createElement("li");
                li.innerHTML = "- Informe um ano válido";
                ulErros.appendChild(li);
                erros++;
            }
            if (document.getElementById("txtModelo").value.length < 1) {
                var li = document.createElement("li");
                li.innerHTML = "- Informe um modelo válido";
                ulErros.appendChild(li);
                erros++;
            }
            var value = CKEDITOR.instances['txtDescricao'].getData();
            if (value.length < 10) {
                var li = document.createElement("li");
                li.innerHTML = "- Informe uma descrição";
                ulErros.appendChild(li);
                erros++;
            }
            if (document.getElementById("slCategoria").value == "") {
                var li = document.createElement("li");
                li.innerHTML = "- Selecione uma categoria";
                ulErros.appendChild(li);
                erros++;
            }

            if (erros === 0) {
                return true;
            } else {
                return false;
            }
        }
</script>
