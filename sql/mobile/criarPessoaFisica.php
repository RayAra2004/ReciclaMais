<?php 

    require_once('./sql/entidades/usuario/Pessoa_Fisica.php');
    require_once('./sql/entidades/usuario/Usuario.php');

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
                $PessoaFisica = new Pessoa_Fisica($login, $senha_hash, $nome, $telefone, $data);
                $PessoaFisica->insert();
                $resposta["status"] = "1";
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