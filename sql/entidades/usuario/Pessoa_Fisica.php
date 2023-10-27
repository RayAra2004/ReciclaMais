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
            //chama o insert de Usuario
            if (parent::insert()) {
                // Agora, vamos inserir os dados específicos de pessoa física (data de nascimento).
                $sql = "INSERT INTO $this->table (id, data_nascimento) VALUES (:id, :dataNascimento);";
                $stmt = Database::prepare($sql);
                $stmt->bindParam(':id', $this->getId(), PDO::PARAM_INT); // Obtém o ID do usuário
                $stmt->bindParam(':dataNascimento', $this->dataNascimento);
                
                return $stmt->execute();
            }
            
            return false; // Retorna false em caso de falha na inserção dos dados comuns. 
        }

        public function update($id){
           
        }
    }
?>