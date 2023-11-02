<?php
    require_once "Usuario.php";

    class Pessoa_Fisica extends Usuario{
        protected $table = "usuario_pessoa_fisica";
        private $dataNascimento;
        private $fk_id_user;
        public function __construct($dataNascimento, $fk_id_user) {
            
            $this->dataNascimento = $dataNascimento;
            $this->fk_id_user = $fk_id_user;
        }

        public function insert(){
            try {
                // Tenta inserir os dados específicos de pessoa física (data de nascimento)
                $sql = "INSERT INTO $this->table (fk_usuario_id, data_nascimento) VALUES (:id, :dataNascimento);";
                $stmt = Database::prepare($sql);
                $stmt->bindParam(':id',$this->fk_id_user, PDO::PARAM_INT); // Obtém o ID do usuário
                $stmt->bindParam(':dataNascimento', $this->dataNascimento);
    
                return $stmt->execute();
                    
            } catch (PDOException $e) {
                // Lidar com exceções de banco de dados, se necessário
                return $e->getMessage();
            } 
        }

        public function update($id){
           
        }

    }
?>