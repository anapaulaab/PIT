<?php
  require "conexaoMysql.php";
  require "auxFunctions.php";
  $pdo = mysqlConnect();

  class Endereco
  {
    public $logradouro;
    public $cidade;
    public $estado;

    function __construct($logradouro, $cidade, $estado)
    {
      $this->logradouro = $logradouro;
      $this->cidade = $cidade;
      $this->estado = $estado; 
    }
  }

  $cep = $_GET['cep'] ?? '';
  $endereco = '';
  $cep = cadastraCep($cep);

  $sql = <<<SQL
        SELECT logradouro, cidade, estado
        FROM baseEnderecosAjax
        WHERE cep = ?
        SQL;

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $cep
        ]);

        $nroLinhas = $stmt->rowCount();

        if($nroLinhas == 0){
          $endereco = new Endereco("", "", "");
        }
        else{
          while ($row = $stmt->fetch()){
            $endereco = new Endereco($row['logradouro'], $row['cidade'], $row['estado']);
          }
        }
    } 
    catch (Exception $e) {  
        //error_log($e->getMessage(), 3, 'log.php');
        if ($e->errorInfo[1] === 1062)
            exit('Dados duplicados: ' . $e->getMessage());
        else
            exit('Falha ao recuperar os dados: ' . $e->getMessage());
    }
    
  echo json_encode($endereco);
?>