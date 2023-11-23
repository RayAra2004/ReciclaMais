<?php
    require_once __DIR__ . '/../../database/crud.php';

    class Usuario extends CRUD{
        
        protected $table = 'usuario';
        private $login;
        private $senha;
        private $nome;
        private $telefone;
        private $id;

        public function __construct(){}
        
        public function setValues($login, $senha, $nome, $telefone, $id = null){
            $validatedData = $this->validarDados($login, $senha, $nome, $telefone);
        
            if (isset($validatedData['erros'])) {
                // Lida com os erros, como retornar uma mensagem de erro ou lançar uma exceção
                return $validatedData['erros'];
            }
        
            // Configure as propriedades do usuário com os dados validados
            $this->login = $validatedData['email'];
            $this->senha = $validatedData['senha'];
            $this->nome = $validatedData['nome'];
            $this->telefone = $validatedData['telefone'];
            $this->id = $id;
        }

        public function setValuesUpdate($senha, $nome, $telefone){
            $telefone = preg_replace('/[^0-9]/', '', $telefone);
            $this->senha = $senha;
            $this->nome = $nome;
            $this->telefone = $telefone;
        }
        

        public function getId(){
            return $this->id;
        }

        public function getTableName(){
            return $this->table;
        }

        private function validarDados($login, $senha, $nome, $telefone){
            $erros = array();

            $nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone = preg_replace('/[^0-9]/', '', $telefone);
            $email = filter_var($login, FILTER_SANITIZE_EMAIL);
            //$senha = preg_replace('/[^A-Za-z0-9]/', '', $senha);
            //$senha = filter_var($senha, FILTER_SANITIZE_SPECIAL_CHARS);

            $formatName = array("options" => array("regexp" => "/([\wÀ-ÿ&-0-9])/"));
            if(! filter_var($nome, FILTER_VALIDATE_REGEXP, $formatName)){
                $erros[] = "Nome inválido\n";
            }

            if((strlen($telefone) < 10 || strlen($telefone) >11)){
                $erros[] = "Telefone inválido\n";
            }
            
            if(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
                $erros[] = "Email inválido\n";
            }

            $formatPassword = array("options" => array("regexp" => "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/"));
            if(! filter_var($senha, FILTER_VALIDATE_REGEXP, $formatPassword)){
                $erros[] = "Senha inválida\n";
            }

            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            $response = [];

            if(empty($erros)){
                $response = [
                    'nome' => $nome,
                    'telefone' => $telefone,
                    'email' => $email,
                    'senha' => $senha_hash
                ];
            }else{
                $response['erros'] = $erros;
            }

            return $response;
        }

        public function insert(){
            $tipo_usuario = 1; // TODO: User está como adm
            $sql = "INSERT INTO $this->table (login, senha, nome, telefone, fk_tipo_usuario_id) VALUES 
                (:login, :senha, :nome, :telefone, :fk_tipo_usuario_id);";
            $stmt = Database::prepare($sql);
            $stmt->bindParam(':login', $this->login);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':telefone', $this->telefone);
            $stmt->bindParam(':fk_tipo_usuario_id', $tipo_usuario, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Recupere o ID inserido
                $this->id = Database::getInstance()->lastInsertId();
    
                return true;
            }
    
            return false;
        }

        public function update($email){
            $sql = "UPDATE $this->table SET nome = :nome, senha = :senha, telefone = :telefone WHERE login = :email;";
            $stmt = Database::prepare($sql);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":telefone", $this->telefone);
            $stmt->bindParam(":senha", $this->senha);
            $stmt->bindParam(":email", $email);
    
            return $stmt->execute();
        }

        public static function findByLogin($login){
            $tempUser = new Usuario();
            $tableName = $tempUser->getTableName();
            
            $sql = "SELECT * FROM " . $tableName . " WHERE login = :login;";
            $stmt = Database::prepare($sql);
            $stmt->bindParam(":login", $login);
            $stmt->execute();
        
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public static function login($login, $password){
            $tempUser = new Usuario();
            $tableName = $tempUser->getTableName();

            $sql = "SELECT * FROM " . $tableName . " WHERE login = :login;";
            $stmt = Database::prepare($sql);
            $stmt->bindParam(":login", $login);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user !== false){
                return password_verify($password, $user["senha"]);
            }else{
                return false;
            }
            
        }
    }
?>