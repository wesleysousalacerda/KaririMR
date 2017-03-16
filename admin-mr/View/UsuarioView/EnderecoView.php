<?php
$cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);

$rua = "";
$numero = "";
$cep = "";
$cidade = "";
$complemento = "";
$bairro = "";

$resultado = "";
?>
<div id="dvUsuarioView">
    <h1>Gerenciar Enredeço</h1>
    <br />
    <!--DIV CADASTRO -->
    <div class="panel panel-default maxPanelWidth">
        <div class="panel-heading">Cadastrar e editar</div>
        <div class="panel-body">
            <form method="post" id="frmGerenciarEndereco" name="frmGerenciarEndereco" novalidate>

                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <input type="hidden" id="txtCodUsuario" value="<?= $cod; ?>" />
                            <label for="txtRua">Rua</label>
                            <input type="text" class="form-control" id="txtRua" name="txtRua" placeholder="" value="<?= $rua; ?>">
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-12">
                        <div class="form-group">
                            <label for="txtNumero">Número</label>
                            <input type="text" class="form-control" id="txtNumero" name="txtNumero" placeholder=""  value="<?= $numero; ?>">
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-12">
                        <div class="form-group">
                            <label for="txtBairro">Bairro</label>
                            <input type="text" class="form-control" id="txtBairro" name="txtBairro" placeholder=""  value="<?= $bairro; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="txtCidade">Cidade</label>
                            <input type="email" class="form-control" id="txtCidade" name="txtCidade" placeholder=""  value="<?= $cidade; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="txtComplemento">Complemento</label>
                            <input type="text" class="form-control" id="txtComplemento" name="txtComplemento" placeholder=""  value="<?= $complemento; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="txtCep">CEP </label>
                            <input type="text" class="form-control" id="txtCep" name="txtCep" value="<?= $cep; ?>" />
                        </div>
                    </div>

                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <!--http://satellasoft.com/?materia=select-com-os-estados-brasileiros-->
                            <label for="slEstado">Estado</label>
                            <select class="form-control" id="slEstado" name="slEstado">
                                <option value="ac">Acre</option> 
                                <option value="al">Alagoas</option> 
                                <option value="am">Amazonas</option> 
                                <option value="ap">Amapá</option> 
                                <option value="ba">Bahia</option> 
                                <option value="ce">Ceará</option> 
                                <option value="df">Distrito Federal</option> 
                                <option value="es">Espírito Santo</option> 
                                <option value="go">Goiás</option> 
                                <option value="ma">Maranhão</option> 
                                <option value="mt">Mato Grosso</option> 
                                <option value="ms">Mato Grosso do Sul</option> 
                                <option value="mg">Minas Gerais</option> 
                                <option value="pa">Pará</option> 
                                <option value="pb">Paraíba</option> 
                                <option value="pr">Paraná</option> 
                                <option value="pe">Pernambuco</option> 
                                <option value="pi">Piauí</option> 
                                <option value="rj">Rio de Janeiro</option> 
                                <option value="rn">Rio Grande do Norte</option> 
                                <option value="ro">Rondônia</option> 
                                <option value="rs">Rio Grande do Sul</option> 
                                <option value="rr">Roraima</option> 
                                <option value="sc">Santa Catarina</option> 
                                <option value="se">Sergipe</option> 
                                <option value="sp">São Paulo</option> 
                                <option value="to">Tocantins</option> 
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
                <a href="?pagina=endereco" class="btn btn-danger">Cancelar</a>

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
    $(document).ready(function () {
        $('#txtCep').mask('00000-000');
    });
    
    $("#txtCep").focusout(function(){
        var link = "http://api.postmon.com.br/v1/cep/" + $("txtCep").val();
        
        link = link.replace("-", "");
        
        $.ajax({
           url : link,
           dataType : "json",
           type : "get",
           data : {},
           success : function(ret){
               console.log(ret);
           },
           error : function(erro){
               console.log(erro);
           }
        });
    });
</script>