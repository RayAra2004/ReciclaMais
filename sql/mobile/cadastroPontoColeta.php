<?php 
    require_once './../database/database.php';
    require_once 'autenticacao.php';

    // array de resposta
    $resposta = array();
    
    if (autenticar()) {
        if (isset($_POST['nome']) && isset($_POST['cep']) && isset($_POST['tp_logradouro']) && isset($_POST['logradouro'])
            && isset($_POST['numero']) && isset($_POST['estado']) && isset($_POST['cidade']) && isset($_POST['bairro']) && isset($_FILES['img'])) {
                
            $nome = $_POST['nome'];
            $cep = $_POST['cep'];
            $tipo_logradouro = $_POST['tp_logradouro'];
            $logradouro = $_POST['logradouro'];
            $numero = $_POST['numero'];
            $estado = $_POST['estado'];
            $cidade = $_POST['cidade'];
            $bairro = $_POST['bairro'];

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
            
            

        }else{
            // se não foram enviados todos os parâmetros para o servidor, 
            // indicamos que não houve sucesso
            // na operação e o motivo no campo de erro.
            $resposta["status"] = 0;
            $resposta["message"] = "Faltam parâmetros";
        }
    } else {
        $resposta["status"] = 0;
        $resposta["message"] = "Usuário ou senha inválidos";
    }
        
       
    

    // converte o array de resposta em uma string no formato JSON e 
    // imprime na tela.
    echo json_encode($resposta);
?>