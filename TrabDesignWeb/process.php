<?php

define("DIR_PERSISTENCIA", 'arquivos/musicas.json');
function salvarDados(array $array){
    $json = json_encode($array);

    file_put_contents(DIR_PERSISTENCIA, $json);
}
function buscarDados(){
    $dados = array();
    if(file_exists(DIR_PERSISTENCIA)){
        $dadosArq = file_get_contents(DIR_PERSISTENCIA);

        if (!empty($dadosArq)) {
            $dados = json_decode($dadosArq, true);
            if ($dados === null) {
                $dados = array(); 
            }
        }
    }
    return $dados;
}
?>
