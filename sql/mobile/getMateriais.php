<?php
    require_once './../entidades/material/Material.php';

    $resposta = array();

    if (autenticar()) {
        if (isset($_GET['limit']) && isset($_GET['offset'])) {
            
            $limit = $_GET['limit'];
            $offset = $_GET['offset'];

            $user = Usuario::findByLogin($login);
            $user_id = $user['id'];

            $materiais = Material::findMateriaisPaginado($limit, $offset, $user_id);

            if($materiais != false){

                $resposta["materiais"] = array();  // Inicializa como um array vazio
                $resposta["status"] = 1;

                foreach($materiais as $materialBD){
                    $material = array();
                    $material["id"] = $materialBD["id"];
                    $material["imagem"] = $materialBD["imagem"];
                    $material["descricao"] = $materialBD["descricao"];
                                   
                    $resposta["materiais"][] = $material;
                }
            } else {
                $resposta["status"] = 0;
                $resposta["mensagem"] = "Erro no BD: Não foi possível selecionar os materiais";
            }
        } else {
            $resposta["status"] = 0;
            $resposta["mensagem"] = "Faltam parâmetros";
        }
    }else{
        $resposta["status"] = 0;
        $resposta["mensagem"] = "Usuário ou senha inválidos";
    }
    // Converte a resposta para o formato JSON.
    echo json_encode($resposta);
?>
