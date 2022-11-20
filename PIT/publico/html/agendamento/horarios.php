<?php
    require "../../../conexaoMysql.php";
    require "../../../auxFunctions.php";
    $pdo = mysqlConnect();
   
    $vetor = [];
    $i = 0;
    $data = $_POST["data"] ?? "";

    $sql = <<<SQL
            SELECT horario
            FROM agenda
            WHERE dataAgenda = ?
            SQL;
    try{

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$data]);

        while ($row = $stmt->fetch()) {
            $vetor[$i] = $row['horario'];
            $i++;
        }
    } 
    catch (Exception $e) {  
        //error_log($e->getMessage(), 3, 'log.php');
        if ($e->errorInfo[1] === 1062)
            exit('Dados duplicados: ' . $e->getMessage());
        else
            exit('Falha ao recuperar os dados: ' . $e->getMessage());
    }

    echo json_encode($vetor);
?>