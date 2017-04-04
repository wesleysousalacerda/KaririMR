<div id="dvCategoriaView">
    <h1>Gerenciar Categorias</h1>
    <br />

    <div class="panel panel-default maxPanelWidth">
        <div class="panel-heading">Cadastrar e editar</div>
        <div class="panel-body">
            <form method="post" id="frmGerenciarCategoria" name="frmGerenciarCategoria" novalidate enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <input type="hidden" id="txtCodCategoria" value="<?= $cod; ?>" />
                            <label for="txtNome">Nome completo</label>
                            <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome completo" value="<?= $nome; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="txtLink">Link</label>
                            <input type="text" class="form-control" id="txtLink" name="txtLink" placeholder="Veículos"  value="<?= $link; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="flImagem">Selecione uma imagem</label>
                            <input type="file" id="flImagem" name="flImagem" <?= ($thumb != "" ? "disabled='disabled'" : "") ?> accept="image/*" />
                        </div>
                    </div>

                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="slSubcategoria">Subcategoria</label>
                            <select class="form-control" id="slSubcategoria" name="slSubcategoria">
                                <option value="">Selecione</option>
                                <?php
                                foreach ($listaResumida as $cat) {
                                    ?>
                                    <option value="<?= $cat->getCod() ?>" <?= ($subcategoria == $cat->getCod() ? "selected='selected'" : "") ?> <?= ($cat->getSubcategoria() == null ? "style='font-weight: bold;'" : "") ?>><?= $cat->getNome() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="txtDescricao">Descrição</label>
                            <textarea class="form-control" rows="3" id="txtDescricao" name="txtDescricao"><?= $descricao; ?></textarea>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <p id="pResultado"><?= $resultado; ?></p>
                    </div>
                </div>
                <input class="btn btn-success" type="submit" name="btnGravar" value="Gravar">
                <a href="?pagina=categoria" class="btn btn-danger">Cancelar</a>

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
    <br />
    <div class="panel panel-default maxPanelWidth">
        <div class="panel-heading">Consultar</div>
        <div class="panel-body">
            <?php
            foreach ($listaCategoria as $categoria) {
                ?>
                <div class="row">
                    <div class="col-lg-4 col-xs-12">
                        <img src="../img/Categorias/<?= $categoria->getThumb(); ?>" alt="<?= $categoria->getNome(); ?>" title="<?= $categoria->getNome(); ?>"  class="img-responsive img-thumbnail" />
                        <br /> <br />
                        <a href="?pagina=categoria&cod=<?= $categoria->getCod(); ?>" class="btn btn-warning">Editar</a>
                        <a href="?pagina=categoriaimagem&cod=<?= $categoria->getCod(); ?>&img=<?= $categoria->getThumb(); ?>" class="btn btn-info">Alterar imagem</a>
                        <br /> <br />
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <p><span class="bold">Nome:</span> <?= $categoria->getNome(); ?></p>
                        <p><span class="bold">Link:</span> <?= $categoria->getLink(); ?></p>
                        <p><span class="bold">Descrição:</span> <?= $categoria->getDescricao(); ?></p>
                    </div>
                    <div class="clear borderBottom"></div>
                    <br />
                </div>
                <br />
            <?php } ?>
        </div>
    </div>
</div>
