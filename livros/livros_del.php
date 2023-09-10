<?php
include_once("persistencia.php");

    //Ao fazer um codigo de exclusao, verificar se o ID do livro foi enviado/recebido.
    
    $id = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    if(! $id){
        echo "ID do livro não informado!";
        echo "<br>";
        echo "<a href='livros.php'>Voltar</a>";
        exit;
    }
    //Verificar se o livro foi encontrado
    

    //Carregar o array de livros do arquivo
    $livros = buscarDados();
    
    //Encontrar o índice do livro
    $index = -1;
    for($i - 0; $i<count($livros); $i++){
        if ( $id == $livros[$i]['id']){
            $index = $id;
            break;
        }
    }
    //Excluir os livros
    array_splice($livros, $index, 1);

    //Persistir o array sem os livros que foram excluidos
    salvarDados($livros);

    //Redirecionar a página
    header("location: livros.php");


?>