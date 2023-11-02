<?php 

    require_once './../entidades/usuario/Pessoa_Fisica.php';
    require_once './../entidades/usuario/Usuario.php';

    // array de resposta
    $resposta = array();
     
    // verifica se todos os campos necessários foram enviados ao servidor
    if (isset($_POST['novo_login']) && isset($_POST['nova_senha']) && isset($_POST['data']) && isset($_POST['nome']) && isset($_POST['telefone'])) {
     
        // o método trim elimina caracteres especiais/ocultos da string
        $login = trim($_POST['novo_login']);
        $senha = trim($_POST['nova_senha']);
        $data = trim($_POST['data']);
        $nome = trim($_POST['nome']);
        $telefone = trim($_POST['telefone']);
        
        // o bd não armazena diretamente a senha do usuário, mas sim 
        // um código hash que é gerado a partir da senha.
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        
        // antes de registrar o novo usuário, verificamos se ele já
        // não existe.
        $usuario_existe = Usuario::findByLogin($login);
        if ($usuario_existe == false) { // se não existe
            try{
                Database::getInstance()->beginTransaction();

                $usuario = new Usuario();
                $erro = $usuario->setValues($login, $senha_hash, $nome, $telefone);
                if($erro !== null){ //se entrar é pq houve algum erro

                    $mensagemErro = "Erro:<br>";
                    foreach ($erro as $erroItem) {
                        $mensagemErro .= $erroItem . "<br>";
                    }
                    $resposta["status"] = "0";
                    $resposta["message"] = $mensagemErro ;
                }else{
                    if($usuario->insert()){
                        $user_id = $usuario->getId();
                        $pessoaFisica = new Pessoa_Fisica($data, $user_id);
                
                        if($pessoaFisica->insert()){
                            Database::getInstance()->commit();  
                            $resposta["status"] = "1";
                        }else{
                            Database::getInstance()->rollBack();
                            $resposta["status"] = "0";
                            $resposta["message"] = "Erro ao cadastrar usuário";
                        }
                        
                    }else{
                        Database::getInstance()->rollBack();
                        $resposta["status"] = "0";
                        $resposta["message"] = "Erro ao cadastrar usuário";
                    }
                }       
            }catch(Exception $e){
                $resposta["status"] = "0";
                $resposta["message"] = $e->getMessage();
            }
            
        }else{
            $resposta["status"] = "0";
            $resposta["message"] = "Usuário já cadastrado";
        }
        
    } else {
        // se não foram enviados todos os parâmetros para o servidor, 
        // indicamos que não houve sucesso
        // na operação e o motivo no campo de erro.
        $resposta["status"] = 0;
        $resposta["message"] = "Faltam parâmetros";
    }
    
    // converte o array de resposta em uma string no formato JSON e 
    // imprime na tela.
    echo json_encode($resposta);
?>