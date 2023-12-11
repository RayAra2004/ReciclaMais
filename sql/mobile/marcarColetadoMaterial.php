<?php
    require_once './../entidades/material/Material.php';
    require_once 'autenticacao.php';

    $resposta = array();

    if (autenticar()) {
        if (isset($_POST['id'])) {
            
            $id = $_POST['id'];

            $materiais = Material::marcarMaterialColetado($id);

            if($materiais != false){

                $resposta["mensagem"] = "OK";
                $resposta["status"] = 1;

            } else {
                $resposta["status"] = 0;
                $resposta["mensagem"] = "Erro no BD: Não foi possível marcar como coletado";
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
