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
                                <label for="txtNome">Nome do automovel:</label>
                                <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome do autmovel" value="">
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-12">
                            <div class="form-group">
                                <label for="txtUsuario">Placa:</label>
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
            </div>
            <input class="btn btn-success" type="submit" name="btnGravar" value="Gravar">
            <a href="#" class="btn btn-danger">Cancelar</a>

            <br />
            <br />    
        </div>

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
            <form method="post" name="frmBuscarUsuario" id="frmBuscarUsuario">
                <div class="row">
                    <div class="col-lg-8 col-xs-12">
                        <div class="form-group">
                            <label for="txtTermo">Termo de busca</label>
                            <input type="text" class="form-control" id="txtTermo" name="txtTermo" placeholder="Ex: fulano de tal" />
                        </div>
                    </div>

                    <div class="col-lg-4 col-xs-12">
                        <div class="form-group">
                            <label for="slTipoBusca">Tipo</label>
                            <select class="form-control" id="slTipoBusca" name="slTipoBusca">
                                <option value="1">Nome</option>
                                <option value="2">E-mail</option>
                                <option value="3">CPF </option>
                                <option value="4">Usuário </option>
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
                        <th>Usuário</th>
                        <th>Status</th>
                        <th>Permissão</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($listaUsuariosBusca != null) {
                        foreach ($listaUsuariosBusca as $user) {
                            ?>
                            <tr>
                                <td><?= $user->getNome(); ?></td>
                                <td><?= $user->getUsuario(); ?></td>
                                <td><?= ($user->getStatus() == 1 ? "Ativo" : "Bloqueado") ?></td>
                                <td><?= ($user->getPermissao() == 1 ? "Administrador." : "Comum") ?></td>
                                <td>
                                    <a href="?pagina=visualizarusuario&cod=<?= $user->getCod(); ?>" class="btn btn-success">Visualizar</a>
                                    <a href="?pagina=usuario&cod=<?= $user->getCod(); ?>" class="btn btn-warning">Editar</a>                                                
                                    <a href="?pagina=alterarsenha&cod=<?= $user->getCod(); ?>" class="btn btn-danger">Senha</a>
                                    <a href="?pagina=endereco&cod=<?= $user->getCod(); ?>" class="btn btn-info">Endereço</a>
                                    <a href="?pagina=telefone&cod=<?= $user->getCod(); ?>" class="btn btn-primary">Telefone</a>
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


<script>
    $(document).ready(function () {
    CKEDITOR.replace('txtDescricao');

</script>
