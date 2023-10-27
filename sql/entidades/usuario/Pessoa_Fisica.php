<?php
    require_once(dirname(__FILE__) ."./Usuario.php");

    class Pessoa_Fisica extends Usuario{
        protected $table = "usuario_pessoa_fisica";
        private $dataNascimento;
        public function __construct($login = null, $senha = null, $nome = null, $telefone = null, $dataNascimento = null) {
            parent::__construct($login, $senha, $nome, $telefone);

            $this->dataNascimento = $dataNascimento;
        }

        public function insert(){
            try {
                // Inicia uma transação
                Database::getInstance()->beginTransaction();
    
                // Tenta inserir o usuário
                if (parent::insert()) {
    
                    // Tenta inserir os dados específicos de pessoa física (data de nascimento)
                    $sql = "INSERT INTO $this->table (fk_usuario_id, data_nascimento) VALUES (:id, :dataNascimento);";
                    $stmt = Database::prepare($sql);
                    $stmt->bindParam(':id', $this->getId(), PDO::PARAM_INT); // Obtém o ID do usuário
                    $stmt->bindParam(':dataNascimento', $this->dataNascimento);
    
                    if ($stmt->execute()) {
                        // Confirma a transação
                        Database::getInstance()->commit();
                        return true;
                    }
                }
                // Reverte a transação em caso de falha
                Database::getInstance()->rollBack();
                return false;
            } catch (PDOException $e) {
                // Lidar com exceções de banco de dados, se necessário
                return false;
            } 
        }

        public function update($id){
           
        }
    }
?>