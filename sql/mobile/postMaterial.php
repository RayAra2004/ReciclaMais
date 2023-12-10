<?php 
    require_once './../database/database.php';
    require_once 'autenticacao.php';
    require_once './../entidades/material/Material.php';
    require_once './../entidades/usuario/Usuario.php';

    // array de resposta
    $resposta = array();
    
    if (autenticar()) {
        if (isset($_POST['nome']) && isset($_POST['quilos']) && isset($_POST['descricao']) 
            && isset($_POST['materiais']) && isset($_FILES['img'])) {
                
            $nome = $_POST['nome'];
            $quilos = $_POST['quilos'];
            $descricao = $_POST['descricao'];
            $materiais_string = $_POST['materiais'];

            $materiais_string = str_replace("'", "\"", $materiais_string);

            $materiais_array = json_decode($materiais_string);

            $filename = $_FILES['img']['tmp_name'];
            $client_id="2bb96ce989a9f4b";
            $handle = fopen($filename, "r");
            $data = fread($handle, filesize($filename));
            $pvars   = array('image' => base64_encode($data));
            $timeout = 30;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
            curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
            $out = curl_exec($curl);
            curl_close ($curl);
            $pms = json_decode($out,true);
            $img_url=$pms['data']['link']; //uso este pra salvar no BD
            
            $user = Usuario::findByLogin($login);
            $user_id = $user['id'];

            $newMaterial = new Material();
            $newMaterial->setvalues($nome, $descricao, $quilos, $img_url, $user_id, $materiais_array);

            $isInserted = $newMaterial->insert();

            if($isInserted){
                $resposta["status"] = 1;
                $resposta["mensagem"] = "Material adicionado";
            }else{
                $resposta["status"] = 0;
                $resposta["mensagem"] = "Erro ao inserir material";
            }
        }else{
            // se não foram enviados todos os parâmetros para o servidor, 
            // indicamos que não houve sucesso
            // na operação e o motivo no campo de erro.
            $resposta["status"] = 0;
            $resposta["mensagem"] = "Faltam parâmetros";
        }
    }else {
        $resposta["status"] = 0;
        $resposta["mensagem"] = "Usuário ou senha inválidos";
    }

    // converte o array de resposta em uma string no formato JSON e 
    // imprime na tela.
    echo json_encode($resposta);
?>