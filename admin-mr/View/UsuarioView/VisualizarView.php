<?php
require_once ("../Controller/UsuarioController.php");
require_once ("../Model/Usuario.php");
require_once ("../Controller/EnderecoController.php");
require_once ("../Controller/TelefoneController.php");


$usuarioController = new UsuarioController();
$enderecoController = new EnderecoController();
$telefoneController = new TelefoneController();

$usuario = $usuarioController->RetornaCod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));
    $date = str_replace('/', '-', $usuario->getNascimento());
    $date = date('d-m-Y', strtotime($date));
?>
<div id="dvVisualizarView">
    <h1>Visualizar Usuário</h1>
    <br />
    <!--DIV CADASTRO -->
    <div class="panel panel-default maxPanelWidth">
        <div class="panel-heading">Dados Pessoais</div>
        <div class="panel-body">
            <p><span class="bold">Nome:</span> <?= $usuario->getNome(); ?> <span class="bold">Email:</span> <?= $usuario->getEmail(); ?> </p>
            <p><span class="bold">CPF:</span> <?=$usuario->getCpf();?> <span class="bold">Usuario:</span> <?=$usuario->getUsuario();?> </p>
            <p><span class="bold">Data de Nascimento:</span> <?=$date;?> <span class="bold">Sexo:</span> <?=($usuario->getSexo()=="m" ? "Masculino" : "Feminino");?> </p>
            <p><span class="bold">Status:</span> <?=($usuario->getStatus()==1 ? "Ativo" : "Bloqueado");?> <span class="bold">Permissão:</span> <?=($usuario->getPermissao()==1 ? "Administrador" : "Comum"); ?> </p>
            
        </div>
    </div>
</div>

