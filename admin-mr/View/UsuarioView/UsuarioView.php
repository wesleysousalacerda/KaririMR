<?php
require_once ("../Controller/UsuarioController.php");
require_once ("../Model/Usuario.php");

$usuarioController = new UsuarioController();
$usuario = new Usuario();
$resultado = "";

         if(filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)){
            $usuario = new Usuario();
            $usuario->setNome(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING);
            $usuario->setEmail(INPUT_POST, "txtEmail", FILTER_SANITIZE_STRING);
            $usuario->setSenha(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING);
            $usuario->setStatus(INPUT_POST, "txtStatus", FILTER_SANITIZE_NUMBER_INT);
            $usuario->setCpf(INPUT_POST, "txtCPF", FILTER_SANITIZE_STRING);
            $usuario->setLogradouro_cod(INPUT_POST, "txtLogradouro_cod", FILTER_SANITIZE_NUMBER_INT);
            $usuario->setNascimento(INPUT_POST, "txtNascimento", FILTER_SANITIZE_STRING);
            $usuario->setPermissao_id(INPUT_POST, "txtPermissao", FILTER_SANITIZE_NUMBER_INT);
            $usuario->setPlano_id(INPUT_POST, "txtPlano_id", FILTER_SANITIZE_NUMBER_INT);
            $usuario->setSexo(INPUT_POST, "txtSexo", FILTER_SANITIZE_STRING);
            $usuario->setUsuario(INPUT_POST, "txtUsuario", FILTER_SANITIZE_STRING);
            
            
            
                if(!filter_input(INPUT_GET, "cod",FILTER_SANITIZE_NUMBER_INT)){
                    //CADASTRAR NOVO USUARIO
                    
                }else{
                    //EDITAR
                    
                }
         }
   
?>
<div id="dvUsuarioView">
    <h1> Gerenciar Usuários </h1> 
    <br />
    <div class="controlePaginas">
        <a href="#"><img src="img/icones/editar.png" alt=""/></a>
        <a href="#"><img src="img/icones/buscar.png" alt=""/></a>

    </div>

    <br />
    <div class="panel panel-default maxPanelWidth novalidate">
        <div class="panel-heading">Cadastrar e editar</div>
        <div class="panel-body">
            <form method="post" id="frmGerenciarUsuario" name="frmGerenciarUsuario">
                <div class="form-group">
                    <label for="txtNome">Nome completo</label>
                    <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome completo">
                </div>

                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="txtEmail">E-mail</label>
                            <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="email@dominio.com">
                        </div>
                    </div>

                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="txtCpf">CPF</label>
                            <input type="text" class="form-control" id="txtCpf" name="txtCpf" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="txtSenha">Senha <span class="vlSenha"></span></label>
                            <input type="password" class="form-control" id="txtSenha" name="txtSenha" placeholder="*******" />
                        </div>
                    </div>

                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="txtSenha2">Confirmar senha <span class="vlSenha"></span></label>
                            <input type="password" class="form-control" id="txtSenha2" name="txtSenha2" placeholder="*******" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="txtData">Data nascimento</label>
                            <input type="text" class="form-control" id="txtData" name="txtData" placeholder="21/08/1992" />
                        </div>
                    </div>

                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="slSexo">Sexo</label>
                            <select class="form-control" id="slSexo" name="slSexo">
                                <option value="m">Masculino</option>
                                <option value="f">Feminino</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="slStatus">Status</label>
                            <select class="form-control" id="slStatus" name="slStatus">
                                <option value="1">Ativo</option>
                                <option value="2">Bloqueado</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="slPermissao">Permissão</label>
                            <select class="form-control" id="slPermissao" name="slPermissao">
                                <option value="1">Administrador</option>
                                <option value="2">Comum</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <span id="spResultado"><?=$resultado;?></span>
                    </div>           
                </div>  

                <input class="btn btn-success" type="submit" name="btnGravar" value="Gravar">
                <a href="#" class="btn btn-danger">Cancelar</a>

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
        $('#txtCpf').mask('000.000.000-00');
        $('#txtData').mask('00/00/0000');
        var vlSenhas = document.getElementsByClassName("vlSenha");

        $("#txtSenha").keyup(function () {

            if (ValidarSenha()) {
                for (var i = 0; i < vlSenhas.length; i++) {
                    vlSenhas[i].style.color = "green";
                    vlSenhas[i].innerHTML = "válido";
                }
            } else {
                for (var i = 0; i < vlSenhas.length; i++) {
                    vlSenhas[i].style.color = "red";
                    vlSenhas[i].innerHTML = "inválido";
                }
            }
        });

        $("#txtSenha2").keyup(function () {

            if (ValidarSenha()) {
                for (var i = 0; i < vlSenhas.length; i++) {
                    vlSenhas[i].style.color = "green";
                    vlSenhas[i].innerHTML = "válido";
                }
            } else {
                for (var i = 0; i < vlSenhas.length; i++) {
                    vlSenhas[i].style.color = "red";
                    vlSenhas[i].innerHTML = "inválido";
                }
            }
        });

    });

    function ValidarSenha() {
        var senha1 = $("#txtSenha").val();
        var senha2 = $("#txtSenha2").val();

        if (senha1.length >= 7 && senha2.length >= 7) {
            if (senha1 == senha2) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

</script>