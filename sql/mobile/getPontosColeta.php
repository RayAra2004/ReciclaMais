<?php
    require_once './../entidades/pontoColeta/PontoColeta.php';

    $resposta = array();

    if (isset($_GET['limit']) && isset($_GET['offset'])) {
        
        $limit = $_GET['limit'];
        $offset = $_GET['offset'];

        $pontosColeta = PontoColeta::findPontosColetaPaginado($limit, $offset);

        if($pontosColeta != false){

            $resposta["pontos"] = array();  // Inicializa como um array vazio
            $resposta["status"] = 1;

            foreach($pontosColeta as $pontoColeta){
                $ponto = array();
                $ponto["id"] = $pontoColeta["id"];
                $ponto["nome"] = $pontoColeta["nome"];
                $ponto["imagem"] = $pontoColeta["imagem"];
                $ponto["materiais_reciclados"] = $pontoColeta["materiais_reciclados"];
                $ponto["distancia"] = 1;
             
                // Adiciona o ponto no array de pontos.
                $resposta["pontos"][] = $ponto;
            }
        } else {
            $resposta["status"] = 0;
            $resposta["mensagem"] = "Erro no BD: Não foi possível selecionar os pontos";
        }
    } else {
        $resposta["status"] = 0;
        $resposta["mensagem"] = "Faltam parâmetros";
    }
    // Converte a resposta para o formato JSON.
    echo json_encode($resposta);
?>
