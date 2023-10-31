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
            $this->login = $login;
            $this->senha = $senha;
            $this->nome = $nome;
            $this->telefone = $telefone;
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function getTableName(){
            return $this->table;
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

        public function update($id){
            $sql = "UPDATE $this->table SET nome = :nome, senha = :senha, telefone = :telefone WHERE id = :id;";
            $stmt = Database::prepare($sql);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":telefone", $this->telefone);
            $stmt->bindParam(":senha", $this->senha);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    
            return $stmt->execute();
        }

        public static function findByLogin($login){
            $tempUser = new Usuario();
            $tableName = $tempUser->getTableName();
            
            $sql = "SELECT * FROM " . $tableName . " WHERE login = :login;";
            $stmt = Database::prepare($sql);
            $stmt->bindParam(":login", $login);
            $stmt->execute();
        
            return $stmt->fetch(PDO::FETCH_BOTH);
        }

        public static function login($login, $password){
            $tempUser = new Usuario();
            $tableName = $tempUser->getTableName();

            $sql = "SELECT * FROM " . $tableName . " WHERE login = :login;";
            $stmt = Database::prepare($sql);
            $stmt->bindParam(":login", $login);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user){
                return password_verify($password, $user["senha"]);
            }else{
                return false;
            }
            
        }
    }
?>