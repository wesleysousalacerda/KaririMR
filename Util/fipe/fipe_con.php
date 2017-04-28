<?php

function conectar() {

    $servidor = "localhost";
    $usuario = "root";
    $senha = "brasilux@D7";
    $baseDados = "fipe";
    try {
        $pdo = new PDO("mysql:host=" . $servidor . ";dbname=" . $baseDados, $usuario, $senha);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $pdo;
}

function gravarMarcas($codigoMarca, $nomeMarca, $tipo) {

    try {

        $sql = "SELECT codigo_marca FROM 
							   fp_marca 
							   WHERE 
							   codigo_marca = :codigo_marca";

        $procurarRegistro = conectar()->prepare($sql);
        $procurarRegistro->bindValue(":codigo_marca", $codigoMarca);
        $procurarRegistro->execute();

        if ($procurarRegistro->rowCount() == 0) {

            $sql = "INSERT INTO fp_marca (codigo_marca,marca,tipo) VALUES 
								   (:codigo_marca,:marca,:tipo)";
            $cadastrarMarca = conectar()->prepare($sql);
            $cadastrarMarca->bindValue(":codigo_marca", $codigoMarca, PDO::PARAM_INT);
            $cadastrarMarca->bindValue(":marca", $nomeMarca);
            $cadastrarMarca->bindValue(":tipo", $tipo);
            $cadastrarMarca->execute();
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function gravarModelos($codigoModelo, $codigoMarca, $codigoFipe, $nomeModelo) {
    try {

        $sql = "SELECT codigo_modelo FROM 
							   fp_modelo 
							   WHERE 
							   codigo_modelo = :codigo_modelo";

        $procurarRegistro = conectar()->prepare($sql);
        $procurarRegistro->bindValue(":codigo_modelo", $codigoModelo);
        $procurarRegistro->execute();

        if ($procurarRegistro->rowCount() == 0) {

            $sql = "INSERT INTO fp_modelo (codigo_modelo,codigo_marca,codigo_fipe,modelo) VALUES 
							      (:codigo_modelo,:codigo_marca,:codigo_fipe,:modelo)";
            $cadastrarModelo = conectar()->prepare($sql);
            $cadastrarModelo->bindValue(":codigo_modelo", $codigoModelo, PDO::PARAM_INT);
            $cadastrarModelo->bindValue(":codigo_marca", $codigoMarca, PDO::PARAM_INT);
            $cadastrarModelo->bindValue(":codigo_fipe", $codigoFipe);
            $cadastrarModelo->bindValue(":modelo", $nomeModelo);
            $cadastrarModelo->execute();
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function gravarAno($codigoModelo, $codigoFipe, $anoModeloFipe, $combustivelFipe, $valorFipe) {
    try {
        $sql = "SELECT * FROM 
								   fp_ano 
								   WHERE 
								   codigo_modelo = :codigo_modelo
								   AND
								   ano = :ano 
								   AND 
								   combustivel = :combustivel";

        $procurarRegistro = conectar()->prepare($sql);
        $procurarRegistro->bindValue(":codigo_modelo", $codigoModelo);
        $procurarRegistro->bindValue(":ano", $anoModeloFipe);
        $procurarRegistro->bindValue(":combustivel", $combustivelFipe);
        $procurarRegistro->execute();

        if ($procurarRegistro->rowCount() == 0) {
            $sql = "INSERT INTO fp_ano (codigo_modelo,codigo_fipe,ano,combustivel,valor) VALUES 
									  (:codigo_modelo,:codigo_fipe,:ano_modelo_fipe,:combustivel_fipe,:valor_fipe)";
            $cadastrarAno = conectar()->prepare($sql);
            $cadastrarAno->bindValue(":codigo_modelo", $codigoModelo, PDO::PARAM_INT);
            $cadastrarAno->bindValue(":codigo_fipe", $codigoFipe);
            $cadastrarAno->bindValue(":ano_modelo_fipe", $anoModeloFipe);
            $cadastrarAno->bindValue(":combustivel_fipe", $combustivelFipe);
            $cadastrarAno->bindValue(":valor_fipe", $valorFipe);
            $cadastrarAno->execute();
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

?>