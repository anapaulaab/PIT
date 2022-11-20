<?php
    function format($string){
        $k = "";
        $aux = 1;
        for($k = 0; $k < strlen($string); $k++){
            if($string[$k] == " "){
                $aux = 1;
            }
            else if($aux == 1){
            $string[$k] = strtoupper($string[$k]);
            $aux = 0;
            }
            else{
                $string[$k] = strtolower($string[$k]);
            }
        }
        return $string;
    }

    function cadastraCep($cep){
        $cep2 = "";
        $i = $j = 0;
        for($i = 0; $i < strlen($cep); $i++){
            if($j == 2 && $cep[$i] != '.'){
            $cep2[$j] = '.';
            $j++;
            }
            if($j == 6 && $cep[$i] != '-'){
            $cep2[$j] = '-';
            $j++;
            }
            $cep2[$j] = $cep[$i];
            $j++;
        }
        return $cep2;
    }
?>