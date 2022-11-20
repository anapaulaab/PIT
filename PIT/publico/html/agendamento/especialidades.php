<?php
    require "../../../conexaoMysql.php";
    require "../../../auxFunctions.php";
    $pdo = mysqlConnect();
   
    $vetor = [];
    $i = 0;

    $sql = <<<SQL
            SELECT DISTINCT especialidade
            FROM medico
            SQL;
    try{

        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch()) {
            $vetor[$i] = $row['especialidade'];
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