<?php
    require_once './../entidades/pontoColeta/PontoColeta.php';

    $resposta = array();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $pontoColeta = PontoColeta::findPontoColetaById($id);

        $resposta["id"] = $pontoColeta["id"];
        $resposta["nome"] = $pontoColeta["nome"];
        $resposta["imagem"] = $pontoColeta["imagem"];
        $resposta["cep"] = $pontoColeta["cep"];
        $resposta["latitude"] = $pontoColeta["latitude"];
        $resposta["longitude"] = $pontoColeta["longitude"];
        $resposta["logradouro"] = $pontoColeta["logradouro"];
        $resposta["numero"] = $pontoColeta["numero"];
        $resposta["complemento"] = $pontoColeta["complemento"];
        $resposta["estado"] = $pontoColeta["estado"];
        $resposta["cidade"] = $pontoColeta["cidade"];
        $resposta["bairro"] = $pontoColeta["bairro"];
        $resposta["tipo_logradouro"] = $pontoColeta["tipo_logradouro"];
        $resposta["telefone"] = $pontoColeta["telefone"];
        $resposta["nota"] = $pontoColeta["nota"];
        
        $resposta["comentarios"] = array();
        $comentarios = json_decode($pontoColeta["comentarios"], true);

        foreach($comentarios as $comentarioBD){
            $cometario = array();
            $cometario["id"] = $comentarioBD["id"];
            $cometario["nomeUsuario"] = $comentarioBD["nomeUsuario"];
            $cometario["nota"] = $comentarioBD["nota"];
            $cometario["conteudo"] = $comentarioBD["conteudo"];

            $resposta["comentario"][] = $cometario;
        }
        $resposta["status"] = 1;
    }else{
        $resposta["status"] = 0;
        $resposta["mensagem"] = "Faltam parâmetros";
    }

    // Converte a resposta para o formato JSON.

    echo json_encode($resposta);

?>