<?php
    require_once './sql/database/crud.php';

    class Usuario extends CRUD{
        protected $table = 'usuario';
        
        private $login;
        private $senha;
        private $nome;
        private $telefone;
        private $id;

        public function __construct($login = null, $senha = null, $nome = null, $telefone = null, $id = null){
            $this->login = $login;
            $this->senha = $senha;
            $this->nome = $nome;
            $this->telefone = $telefone;
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }


        public function insert(){
            $sql = "INSERT INTO $this->table (login, senha, nome, telefone) VALUES (:login, :senha, :nome, :telefone);";
            $stmt = Database::prepare($sql);
            $stmt->bindParam(':login', $this->login);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':telefone', $this->telefone);

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
    }
?>