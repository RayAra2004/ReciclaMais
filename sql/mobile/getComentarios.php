<?php
    require_once './../entidades/pontoColeta/PontoColeta.php';

    $resposta = array();

    if (isset($_GET['id']) && isset($_GET['limit']) && isset($_GET['offset'])) {
        $id = $_GET['id'];
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];

        $comentarios = PontoColeta::getComentarios($id, $limit, $offset);

        $resposta["comentarios"] = array();  // Inicializa como um array vazio
        $resposta["status"] = 1;

        foreach($comentarios as $comentarioBD){
            $comentario = array();
            $comentario["id"] = $comentarioBD["id"];
            $comentario["conteudo"] = $comentarioBD["conteudo"];
            $comentario["nota"] = $comentarioBD["nota"];
            $comentario["nomeUsuario"] = $comentarioBD["nome"];
         
            // Adiciona o ponto no array de pontos.
            $resposta["comentarios"][] = $comentario;
        }
    }else{
        $resposta["status"] = 0;
        $resposta["mensagem"] = "Faltam parâmetros";
    }

    // Converte a resposta para o formato JSON.

    echo json_encode($resposta);
?>