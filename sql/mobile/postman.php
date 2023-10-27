<?php
    $teste = $_POST['teste'];
    $resposta = array();
    $resposta["sucesso"] = "0";
    $resposta["texto"] = $teste;
    echo json_encode($resposta);
?>