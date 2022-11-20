<?php
    require "../../../conexaoMysql.php";
    require "../../../auxFunctions.php";
    $pdo = mysqlConnect();

    class medico
    {
        public $nome;
        public $codigo;
        function __construct($nome, $codigo)
            {
                $this->nome = $nome;
                $this->codigo = $codigo;
            }
    }
   
    $vetor = [];
    $i = 0;
    $especialidade = $_POST["especialidade"] ?? "";

    $sql = <<<SQL
            SELECT nome, ME.codigo as codigo
            FROM medico ME INNER JOIN pessoa PE ON
                PE.codigo = ME.codigo
            WHERE especialidade = ?
            SQL;
    try{

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$especialidade]);

        while ($row = $stmt->fetch()) {
            $medico = new medico($row['nome'], $row['codigo']);
            $vetor[$i] = $medico;
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