<?php

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include_once("persistencia.php");

    $livros = buscarDados();

    $msgErro = '';

    if(isset($_POST['submetido'])){
        $titulo = $_POST['titulo'];
        $genero = $_POST['genero'];
        $qtd_pag = $_POST['qtd_pag'];
        $autor = $_POST['autor'];

            $id = vsprintf( '%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));

            if($qtd_pag > 0 && strlen($titulo) >= 3 && strlen($titulo) <= 50){
            $livro = array (
            'id' => $id,
            'titulo' => $titulo,
            'genero' => $genero,
            'qtd_pag' => $qtd_pag,
            'autor' => $autor
        );

        array_push($livros, $livro);

        salvarDados($livros);
    }
    else if( $qtd_pag <= 0){
        $msgErro= 'Erro! A quantidade de páginas deve ser maior que 0.';
    }
    else if(strlen($titulo) <= 3 || strlen($titulo) > 50){
        $msgErro = 'Erro! O título deve ter de 3 á 50 letras.';
    }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de livros</title>
</head>
<body>
    <h1>Cadastro de livros</h1>

    <h3>Formulário de livros</h3>
        <form action="" method="POST">
    
            <input type="text" name="titulo" placeholder="Informe o título">
    
            <br></br>
    
            <select name="genero">
                <option value="">---Selecione o gênero---</option>
                <option value="D">Drama</option>
                <option value="F">Ficção</option>
                <option value="R">Romance</option>
                <option value="O">Outro</option>
            </select>
    
            <br></br>
    
            <input type="number" name="qtd_pag" placeholder="Informe a quantidade de páginas">

            <br></br>

            <input type="text" name="autor" placeholder="Informe o autor">
    
            <br></br>
    
            <input type="hidden" name="submetido" value="1">
    
            <button type="submit">Gravar</button>
            <button type="reset">Reset</button>
        </form>
    <br></br>

        <div style="color: red;"><?= $msgErro ?></div>

    <h3>Listagem de livros</h3>

    <table border='1'>
        <tr>
            <td>Título</td>
            <td>Gênero</td>
            <td>Páginas</td>
            <td>Autor</td>
            <td></td>
        </tr>
        <?php foreach($livros as $l): ?>
            <tr>
                <td><?= $l['titulo']?></td>
                <td><?php
                switch($l['genero']){
                    case 'D' :
                        echo 'Drama';
                        break;
                    
                    case 'F':
                        echo 'Ficção';
                        break;
                    
                    case 'R':
                        echo 'Romance';
                        break;
   
                    default:
                        echo $l['genero'];
                }    
                ?></td>
                <td><?= $l['qtd_pag']?>Páginas</td>
                <td><?= $l['autor']?></td>
                <td><a href="livros_del.php?id=<?= $l['id'] ?>" 
                onclick="return confirm('Confirma a exclusão do livro?')">
                        Excluir</a></td>
            </tr>
        <?php endforeach;?>
    </table>
</body>
</html>