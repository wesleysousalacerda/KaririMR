<?php

/*
 * RAFAEL PIZA
 * rafael.piza@yahoo.com.br

  ATUALIZADO em 09/03/2016
  - Mês de referência
 */

$inicio = date('H:i:s');
set_time_limit(0);

require_once('fipe_con.php');
require_once('funcoes.php');

//Atualizado - 09/03/2016
$urlMesReferencia = 'http://veiculos.fipe.org.br/api/veiculos/ConsultarTabelaDeReferencia';
$dados = http_build_query(
        array('')
);
$p = array('http' =>
    array(
        'method' => 'POST',
        'header' => 'Content-type: application/json',
        'content' => $dados
    )
);

$context = stream_context_create($p);
$html = file_get_contents($urlMesReferencia, false, $context);
$mesReferencia = json_decode($html);
/*
 *
 * Mudar aqui o tipo do veículo
 *
 */
$tipo = 1; //1 - carro | 2 - moto | 3 - Caminhão, outros
$urlMarcas = 'http://veiculos.fipe.org.br/api/veiculos/ConsultarMarcas';
$urlModelos = 'http://veiculos.fipe.org.br/api/veiculos/ConsultarModelos';
$urlAno = 'http://veiculos.fipe.org.br/api/veiculos/ConsultarAnoModelo';
$urlValor = 'http://veiculos.fipe.org.br/api/veiculos/ConsultarValorComTodosParametros';

while ($tipo <= 1) {

    $mesReferenciaCodigo = $mesReferencia[0]->Codigo;
    $marcas = array(
        'codigoTabelaReferencia' => $mesReferenciaCodigo,
        'codigoTipoVeiculo' => $tipo
    );
    echo '<pre>';
    //marcas
    $retornoMarcas = curl($urlMarcas, $marcas);

    $fipeMarcas = json_decode($retornoMarcas);
    $totalMarcas = count($fipeMarcas);

    for ($x = 0; $x <= $totalMarcas - 1; $x++) {

        $codigoMarca = $fipeMarcas[$x]->Value;
        $nomeMarca = $fipeMarcas[$x]->Label;
        echo '<b>Codigo Marca: </b>' . $codigoMarca . ' <b>Marca: </b>' . $nomeMarca . '<br />';
        //gravarMarcas($codigoMarca,$nomeMarca,$tipo);
        //modelos
        echo $tipo . ' - Referencia: ' . $mesReferenciaCodigo . '/' . utf8_decode($mesReferencia[0]->Mes) . ' - ' . $codigoMarca . '<br />';
        $modelos = array(
            'codigoTipoVeiculo' => $tipo,
            'codigoTabelaReferencia' => $mesReferenciaCodigo,
            'codigoModelo' => '',
            'codigoMarca' => $codigoMarca,
            'ano' => '',
            'codigoTipoCombustivel' => '',
            'anoModelo' => '',
            'modeloCodigoExterno' => ''
        );
        $retornoModelos = curl($urlModelos, $modelos);

        $fipeModelos = json_decode($retornoModelos);
        $totalModelos = count($fipeModelos->Modelos);
        for ($y = 0; $y <= $totalModelos - 1; $y++) {

            $codigoModelo = $fipeModelos->Modelos[$y]->Value;
            $nomeModelo = $fipeModelos->Modelos[$y]->Label;
            echo '<b>Codigo Modelo: </b>' . $codigoModelo . ' <b>Modelo: </b>' . utf8_decode($nomeModelo) . '<br />';
            //gravarModelos($codigoModelo,$codigoMarca,$nomeModelo);
            //ano modelo
            $ano = array(
                'codigoTipoVeiculo' => $tipo,
                'codigoTabelaReferencia' => $mesReferenciaCodigo,
                'codigoMarca' => $codigoMarca,
                'codigoModelo' => $codigoModelo,
                'ano' => '',
                'codigoTipoCombustivel' => '',
                'anoModelo' => '',
                'modeloCodigoExterno' => '',
            );
            $retornoAnos = curl($urlAno, $ano);
            $fipeAnos = json_decode($retornoAnos);
            $totalAnos = count($fipeAnos);

            for ($z = 0; $z <= $totalAnos - 1; $z++) {

                //tipo combustivel
                $codigoTipoCombustivel = explode('-', $fipeAnos[$z]->Value);
                //ano modelo
                $anoModelo = explode('-', $fipeAnos[$z]->Value);


                //valor do modelo
                $valor = array(
                    'codigoTipoVeiculo' => $tipo,
                    'codigoTabelaReferencia' => $mesReferenciaCodigo,
                    'codigoModelo' => $codigoModelo,
                    'codigoMarca' => $codigoMarca,
                    'ano' => $fipeAnos[$z]->Value,
                    'codigoTipoCombustivel' => $codigoTipoCombustivel[1],
                    'anoModelo' => $anoModelo[0],
                    'tipoConsulta' => 'Tradicional'
                );


                $retornoValor = curl($urlValor, $valor);

                $fipeValor = json_decode($retornoValor);
                $totalValor = count($fipeValor);


                for ($k = 0; $k <= $totalValor - 1; $k++) {
                    $valorFipe = $fipeValor->Valor;
                    $valorFipe = str_replace('R$', '', $valorFipe);
                    $valorFipe = str_replace('.', '', $valorFipe);
                    $valorFipe = trim(str_replace(',', '.', $valorFipe));
                    $marcaFipe = trim($fipeValor->Marca);
                    $modeloFipe = trim($fipeValor->Modelo);
                    $anoModeloFipe = trim($fipeValor->AnoModelo);
                    $combustivelFipe = trim($fipeValor->Combustivel);
                    $codigoFipe = trim($fipeValor->CodigoFipe);
                    $mesReferenciafipe = trim($fipeValor->MesReferencia);
                    $tipoVeiculoFipe = trim($fipeValor->TipoVeiculo);

                    echo '<b>Ano: </b>' . $anoModeloFipe . ' <b>Compustivel: </b>' . $combustivelFipe . ' <b>Fipe: </b>' . $codigoFipe . ' <b>Valor: </b>' . $valorFipe . '<br />';
                    gravarMarcas($codigoMarca, utf8_decode($nomeMarca), $tipoVeiculoFipe);
                    gravarModelos($codigoModelo, $codigoMarca, $codigoFipe, utf8_decode($nomeModelo));
                    gravarAno($codigoModelo, $codigoFipe, $anoModeloFipe, utf8_decode($combustivelFipe), $valorFipe);
                }
            }
            echo '<br />';
        }
        echo '<hr />';
    }
    $tipo = $tipo + 1;
}
$fim = date("H:i:s");
$inicio = DateTime::createFromFormat('H:i:s', $inicio);
$fim = DateTime::createFromFormat('H:i:s', $fim);
$intervalo = $inicio->diff($fim);
echo 'Levou: ' . $intervalo->format('%H:%I:%S') . ' para baixar';
