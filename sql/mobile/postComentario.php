<?php
    require_once './../entidades/pontoColeta/PontoColeta.php';
    require_once 'autenticacao.php';
    require_once './../entidades/usuario/Usuario.php';

    if (autenticar()) {
        if(isset($_POST['comentario']) && isset($_POST['nota']) && isset($_POST['idPontoColeta'])){
            $user = Usuario::findByLogin($login);
            $user_id = $user['id'];

            $comentario = $_POST['comentario'];
            $nota = $_POST['nota'];
            $idPontoColeta = $_POST['idPontoColeta'];

            $isInserted = PontoColeta::postComentario($idPontoColeta, $user_id, $comentario, $nota);

            if($isInserted){
                $resposta["status"] = 1;
                $resposta["mensagem"] = "Comentário inserido com sucesso";
            }else{
                $resposta["status"] = 0;
                $resposta["mensagem"] = "Erro ao inserir comentário";
            }
        }
    }else{
        $resposta["status"] = 0;
        $resposta["mensagem"] = "Usuário ou senha inválidos";
    }

    echo json_encode($resposta);
?>