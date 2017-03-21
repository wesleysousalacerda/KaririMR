<?php
$endCod = 0;
$numero = "";
$resultado = "";
$tipo = 1;
?>
<div id="dvTelefoneView">
    <h1>Gerenciar Telefone</h1>
    <br />
    <!--DIV CADASTRO -->
    <div class="panel panel-default maxPanelWidth">
        <div class="panel-heading">Cadastrar e editar</div>
        <div class="panel-body">
            <form method="post" id="frmGerenciarTelefone" name="frmGerenciarTelefone" novalidate>

                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <input type="hidden" id="txtCodTelefone" name="txtCodTelefone" value="<?= $endCod; ?>"/>

                            <label for="txtNumero">Número </label>
                            <input type="text" class="form-control" id="txtNumero" name="txtNumero" value="<?= $numero; ?>" />
                        </div>

                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="slTipo">Tipo</label>
                            <select class="form-control" id="slEstado" name="slEstado">
                                <option value="1" <?= ($tipo == 1 ? "selected=' selected'" : ""); ?>>Celular</option>
                                <option value="2" <?= ($tipo == 2 ? "selected=' selected'" : ""); ?>>Telefone</option>
                                <option value="3" <?= ($tipo == 3 ? "selected=' selected'" : ""); ?>>Fax</option>

                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <p id="pResultado"><?= $resultado; ?></p>
                    </div>
                </div>
                <input class="btn btn-success" type="submit" name="btnGravar" value="Gravar">
                <a href="?pagina=telefone&cod=<?= filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT) ?>" class="btn btn-danger">Cancelar</a>

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
</div>
<script src="../js/mask.js" type="text/javascript"></script>

<script>
$(document).ready(function(){
     $('#txtNumero').mask('(00) 00000 -0000');
});
</script>