<?php
    /*1. Escreva um programa em PHP que exiba uma progressão 
    aritmética. Ele deve receber pelo
método GET os seguintes parâmetros:
inicio = número do início da progressão aritmética
razao = razão da progressão aritmética
quantidade = quantidade de números (termos) da progressão 
aritmética.
Caso os 3 parâmetros tenham sido enviados, exiba a progressão 
aritmética requisitada. Caso
contrário, exiba um mensagem informando qual ou quais parâmetros
não foram informados.
*/
if(isset($_GET['inicio']) && isset($_GET['razao']) && ($_GET['qntdtermos'])){
    $ini = $_GET['inicio'];
    $raz = $_GET['razao'];
    $qnt = $_GET['qntdtermos'];

    echo "Progressão aritmética iniciada em $ini, com razão $raz e quantidade $qnt:" . "<br>";
        for($i = 0; $i < $qnt; $i++){
            $termoAtual = $ini + ($i * $raz);
            echo $termoAtual;

            if($i < $qnt - 1){
                echo ", ";
            }
        }
    }
    elseif(!isset($_GET['inicio'])){
        echo "Insira os parâmetros de forma correta.";
    }

    elseif(!isset($_GET['razao'])){
        echo "Insira os parâmetros de forma correta.";
    }

    elseif(!isset($_GET['qntdtermos'])){
        echo "Insira os parâmetros de forma correta.";
    }
?>