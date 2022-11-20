<?php
    require "../../../conexaoMysql.php";
    require "../../../auxFunctions.php";
    $pdo = mysqlConnect();
    
    $nome = $_POST["nome"] ?? "";
    $sexo = $_POST["sexo"] ?? "";
    $email = $_POST["email"] ?? "";
    $medico = $_POST["medico"] ?? "";
    $date = $_POST["data"] ?? "";
    $hora = $_POST["hora"] ?? "";

    $nome = format($nome);

    $sql = <<<SQL
            INSERT INTO agenda (nome, sexo, email, codigoMedico, 
                                horario, dataAgenda)
            VALUES (?, ?, ?, ?, ?, ?)
            SQL;

    try{

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $nome, $sexo, $email, $medico, $hora, $date
        ]);

        header("location: ../agendamento");
        exit();

    }
    catch (Exception $e) {
        $pdo->rollBack();
        if ($e->errorInfo[1] === 1062)
          exit('Dados duplicados: ' . $e->getMessage());
        else
          exit('Falha ao cadastrar os dados: ' . $e->getMessage());
    }
?>