<?php 
    require_once './../database/database.php';
    require_once 'autenticacao.php';
    require_once './../entidades/endereco/Endereco.php';
    require_once './../entidades/usuario/Usuario.php';
    require_once './../entidades/pontoColeta/PontoColeta.php';

    // array de resposta
    $resposta = array();
    
    if (autenticar()) {
        if (isset($_POST['nome']) && isset($_POST['cep']) && isset($_POST['tp_logradouro']) 
            && isset($_POST['logradouro']) && isset($_POST['numero']) && isset($_POST['estado']) 
            && isset($_POST['cidade']) && isset($_POST['bairro']) && isset($_POST['materiais']) 
            && isset($_FILES['img'])) {
                
            $nome = $_POST['nome'];
            $cep = $_POST['cep'];
            $tipo_logradouro = $_POST['tp_logradouro'];
            $logradouro = $_POST['logradouro'];
            $numero = $_POST['numero'];
            $estado = $_POST['estado'];
            $cidade = $_POST['cidade'];
            $bairro = $_POST['bairro'];
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
            
            Database::getInstance()->beginTransaction();

            $newEndereco = new Endereco();

            $isValid = $newEndereco->setValues($cep, $logradouro, $tipo_logradouro, $estado, 
                $cidade, $bairro, $numero);
         
            
            if(isset($isValid['erros'])){
                $erros = $isValid['erros'];
                Database::getInstance()->rollBack();
                return;
            }
            
            $isInserted = $newEndereco->insert();

            if($isInserted){
                $endereco_id = $newEndereco->getId();
                $user = Usuario::findByLogin($login);
                $user_id = $user['id'];

                $newPontoColeta = new PontoColeta();

                $newPontoColeta->setValues(null, $nome, $img_url, null, $endereco_id, $user_id, $materiais_array);
                $isInserted = $newPontoColeta->insert();

                if($isInserted){
                    Database::getInstance()->commit();
                    $resposta["status"] = 1;
                    $resposta["mensagem"] = "OK";
                }else{
                    Database::getInstance()->rollBack();
                    $resposta["status"] = 0;
                    $resposta["mensagem"] = "ERROR";
                }
            }

        }else{
            // se não foram enviados todos os parâmetros para o servidor, 
            // indicamos que não houve sucesso
            // na operação e o motivo no campo de erro.
            $resposta["status"] = 0;
            $resposta["mensagem"] = "Faltam parâmetros";
        }
    } else {
        $resposta["status"] = 0;
        $resposta["mensagem"] = "Usuário ou senha inválidos";
    }
        
       
    

    // converte o array de resposta em uma string no formato JSON e 
    // imprime na tela.
    echo json_encode($resposta);
?>