<?php
include_once("process.php");
// excluir arquivo
$id = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    if(! $id){
        echo "ID da musica não informado!";
        echo "<br>";
        echo "<a href='PlayListCreator.php'>Voltar</a>";
        exit;
    }
    //Verificar se o musica foi encontrado
    

    //Carregar o array de musicas do arquivo
    $musicas = buscarDados();
    
    //Encontrar o índice do musica
    $index = -1;
    for($i - 0; $i<count($musicas); $i++){
        if ( $id == $musicas[$i]['id']){
            $index = $id;
            break;
        }
    }
    //Excluir os musicas
    array_splice($musicas, $index, 1);

    //Persistir o array sem os musicas que foram excluidos
    salvarDados($musicas);

    //Redirecionar a página
    header("location: PlayListCreator.php");
?>