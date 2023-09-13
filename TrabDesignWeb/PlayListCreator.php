<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once("process.php");

$musicas = buscarDados();

$msgErro = '';

$titulo = "";
$compositor = "";
$genero = "";
$link = "";


if(isset($_POST['sended'])){
    $titulo = $_POST['titulo'];
    $compositor = $_POST['compositor'];
    $genero = $_POST['genero'];
    $link = $_POST['link'];
    
    $erros = array();

    if(! trim($titulo))
    array_push($erros, "Informe o título!");

    if(! trim($compositor))
    array_push($erros, "Informe o compositor(a)!");

    if(! trim($genero))
    array_push($erros, "Informe o gênero!");

    if(! trim($link))
    array_push($erros, "Informe o link!");

    if(!$erros){
       if(strlen($titulo) < 1 || strlen($titulo) > 120)
            array_push($erros, "O titulo deve ter entre 1 e 120 caracteres.");

        $tituloExiste = false;
        foreach($musicas as $m){
            if($titulo == $m['titulo'])
            $tituloExiste = true;
        break;
        }
    }
    if($tituloExiste)
    array_push($erros, "Música já cadastrada");

    if(!$erros){
    $id = vsprintf( '%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
    $musica = array(
        'titulo' => $titulo,
        'compositor' => $compositor,
        'genero' => $genero,
        'link' => $link,
        'id' => $id
    );
    array_push($musicas, $musica);

    salvarDados($musicas);

    header("location: PlayListCreator.php");
    } else{
        $msgErro= implode("<br>", $erros);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário com PHP Atividade</title>
    <link rel="stylesheet" href="plaYlistStyle.css">
</head>
<body>
        <h1>PlaYlist Creator</h1>

    <form action="" method="POST">

        <label>Título da música:</label><br>
        <input type="text" name="titulo" placeholder="Informe o título da música">
        <br></br>

        <label>Compositor(a) da música:</label><br>
        <input type="text" name="compositor" placeholder="Informe o compositor(a) da música">
        <br></br>

        <label>Gênero musical:</label><br>
        <select id="genero" name="genero">
            <option value="">----Selecione o gênero da música----</option>
            <option value="a">Pop</option>
            <option value="b">Rock</option>
            <option value="c">Hip Hop</option>
            <option value="d">Eletrônica</option>
            <option value="e">R&B</option>
            <option value="f">Reggae</option>
            <option value="g">Jazz</option>
            <option value="h">Blues</option>
            <option value="i">Clássica</option>
            <option value="j">Sertanejo</option>
            <option value="k">Funk</option>
            <option value="l">Country</option>
            <option value="m">Indie</option>
            <option value="n">Metal</option>
            <option value="o">Rap</option>
            <option value="p">Samba</option>
            <option value="q">Disco</option>
            <option value="r">Folk</option>
            <option value="s">Alternativo</option>
            <option value="t">Gospel</option>
            <option value="u">Outro</option>
        </select>

        <br>
        
        <label>URL da música</label>
        <br>
        <input type="url" name="link" id="link" placeholder="A URL deve ser um link do YouTube">
        <br><br>
        
        <input type="hidden" name="sended" value="1">

        
        <button type="submit"><img src="—Pngtree—vector play button icon_4184109.png" alt="Icone YT" width="20" height="20"></button><br>
        <button type="reset">Resetar PlaYlist</button><br>
    </form>

    <div style="color: red;"><?= $msgErro ?></div>

    <h2>PlaYlist<h2>
        <table class="playlist-table">
            <tr>
                <td>Título</td>
                <td>Artista</td>
                <td>Gênero</td>
                <td>Link</td>
                <td></td>
            </tr>
            <?php foreach($musicas as $m): ?>
                <tr>
                    <td><?= $m['titulo']?></td>
                    <td><?= $m['compositor']?></td>
                    <td><?php
                    switch($m['genero']){
                        case 'a':
                            echo "Pop";
                            break;
                        case 'b':
                            echo "Rock";
                            break;
                        case 'c':
                            echo "Hip-Hop";
                            break;
                        case 'd':
                            echo "Eletrônica";
                            break;
                        case 'e':
                            echo "R&B";
                            break;
                        case 'f':
                            echo "Reggae";
                            break;
                        case 'g':
                            echo "Jazz";
                            break;
                        case 'h':
                            echo "Blues";
                            break;
                        case 'i':
                            echo "Clássica";
                            break;
                        case 'j':
                            echo "Sertanejo";
                            break;
                        case 'k':
                            echo "Funk";
                            break;
                        case 'l':
                            echo "Country";
                            break;
                        case 'm':
                            echo "Indie";
                            break;
                        case 'n':
                            echo "Metal";
                            break;
                        case 'o':
                            echo "Rap";
                            break;
                        case 'p':
                            echo "Samba";
                            break;
                        case 'q':
                            echo "Disco";
                            break;
                        case 'r':
                            echo "Folk";
                            break;
                        case 's':
                            echo "Alternativo";
                            break;
                        case 't':
                            echo "Gospel";
                            break;
                        case 'u':
                            echo "Outro";
                            break;
                        default:
                            echo "Gênero não especificado";
                    }
                    ?></td>
                    <td><a href="<?= $m['link'] ?>" target="_blank">Link</a></td>
                    <td><a href="musicas_del.php?id=<?= $m['id'] ?>" 
    onclick="return confirm('Confirma a exclusão da música?')">
    Excluir</a></td>
                </tr>
                <?php endforeach; ?>
        </table>
</body>
</html>