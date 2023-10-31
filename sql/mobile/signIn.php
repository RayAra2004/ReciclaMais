<?php 
    require_once './../database/database.php';
    require_once 'autenticacao.php';

    // array de resposta
    $resposta = array();
    
    // verifica se todos os campos necessários foram enviados ao servidor
    if (autenticar()) {
        $resposta["status"] = 1;
    } else {
        $resposta["status"] = 0;
        $resposta["message"] = "Usuário ou senha inválidos";
    }
    
    // converte o array de resposta em uma string no formato JSON e 
    // imprime na tela.
    echo json_encode($resposta);

?>