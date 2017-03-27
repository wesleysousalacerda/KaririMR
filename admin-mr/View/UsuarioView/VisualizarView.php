<?php
require_once ("../Controller/UsuarioController.php");
require_once ("../Model/Usuario.php");
require_once ("../Controller/EnderecoController.php");
require_once ("../Controller/TelefoneController.php");


$usuarioController = new UsuarioController();
$enderecoController = new EnderecoController();
$telefoneController = new TelefoneController();

$usuario = $usuarioController->RetornaCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));

?>
<div id="dvVisualizarView">
    <h1>Visualizar Usuário</h1>
    <br />
    <!--DIV CADASTRO -->
    <div class="panel panel-default maxPanelWidth">
        <div class="panel-heading">Dados Pessoais</div>
        <div class="panel-body">
            <p><span class="bold">Nome:</span> bla bla <span class="bold">Email:</span> bla bla </p>

        </div>
    </div>
</div>

