<?php 
    require_once "./Usuario.php";

    class Pessoa_Juridica extends Usuario {
        protected static $table ="usuario_pessoa_juridica";
        private $cnpj;
        private $logo;
        private $data_cadastro;
        private $data_expiracao;

        private $id_endereco;
        private $id_tipo_assinatura;
        public function __construct($login, $senha, $nome, $telefone, $cnpj, $logo, $data_cadastro, $data_expiracao, $id_endereco, $id_tipo_assinatura) {
            
            parent::__construct($login, $senha, $nome, $telefone);
            $this->data_cadastro = $data_cadastro;
            $this->data_expiracao = $data_expiracao;
            $this->cnpj = $cnpj;
            $this->logo = $logo;
            $this->id_endereco = $id_endereco;
            $this->id_tipo_assinatura = $id_tipo_assinatura;
        }


        public static function findAllJuridicPeople(){
            return parent::findAll(self::$table);
        }

        public function insert(){
            try {
                // Inicia uma transação
                Database::getInstance()->beginTransaction();
    
                // Tenta inserir o usuário
                if (parent::insert()) {
                    // Tenta inserir os dados específicos de pessoa jurídica
                    $sql = "INSERT INTO $this->table
                        (fk_usuario_id, fk_endereco_id, fk_tipo_assinatura_id, cnpj, logo, 
                            data_cadastro, data_expiracao)
                        VALUES (:fk_usuario_id, :fk_endereco_id, :fk_tipo_assinatura_id, :cnpj, :logo, 
                            :data_cadastro, :data_expiracao);";
                    
                    $stmt = Database::prepare($sql);
                    $stmt->bindParam(':fk_usuario_id', $this->getId(), PDO::PARAM_INT); // Obtém o ID do usuário
                    $stmt->bindParam(':fk_endereco_id', $this->id_endereco, PDO::PARAM_INT);
                    $stmt->bindParam(':fk_tipo_assinatura_id', $this->id_tipo_assinatura, PDO::PARAM_INT);
                    $stmt->bindParam(':cnpj', $this->cnpj, PDO::PARAM_INT);
                    $stmt->bindParam(':logo', $this->logo, PDO::PARAM_STR);
                    $stmt->bindParam(':data_cadastro', $this->data_cadastro, PDO::PARAM_STR);
                    $stmt->bindParam(':data_expiracao', $this->data_expiracao, PDO::PARAM_STR);
    
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