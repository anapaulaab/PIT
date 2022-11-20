<?php
    require "../../../conexaoMysql.php";
    require "../../../auxFunctions.php";
    $pdo = mysqlConnect();

    $cep = $_POST["cep"] ?? "";
    $logradouro = $_POST["logradouro"] ?? "";
    $cidade = $_POST["cidade"] ?? "";
    $estado = $_POST["estado"] ?? "";

    $cep = cadastraCep($cep);
    $logradouro = format(strtolower($logradouro));
    $cidade = format(strtolower($cidade));

    $sql = <<<SQL
        INSERT INTO baseEnderecosAjax(cep, logradouro, cidade, estado)
        VALUES (?, ?, ?, ?)
        SQL;

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $cep, $logradouro, $cidade, $estado
        ]);

        header("location: ../cadastro");
        exit();
    } 
    catch (Exception $e) {  
        //error_log($e->getMessage(), 3, 'log.php');
        if ($e->errorInfo[1] === 1062)
            exit('Dados duplicados: ' . $e->getMessage());
        else
            exit('Falha ao cadastrar os dados: ' . $e->getMessage());
    }
?>