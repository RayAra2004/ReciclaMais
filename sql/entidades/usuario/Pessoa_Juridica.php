<?php 
    require_once "Usuario.php";

    class Pessoa_Juridica extends Usuario {
        protected $table ="usuario_instituicao";
        private $cnpj;
        private $logo;
        private $data_cadastro;
        private $data_expiracao;

        private $id_endereco;
        private $id_tipo_assinatura;
        public function __construct() {}

        public function setValuesPJ($cnpj, $logo, $data_cadastro, $data_expiracao, $id_endereco, $id_tipo_assinatura){
            
            $this->cnpj = $cnpj;
            $this->logo = $logo;
            $this->data_cadastro = $data_cadastro;
            $this->data_expiracao = $data_expiracao;
            $this->id_endereco = $id_endereco;
            $this->id_tipo_assinatura = $id_tipo_assinatura;
        }
        


        public function getTableName(){
            return $this->table;
        }

        public static function findAllJuridicPeople(){
            $tempUser = new Pessoa_Juridica();
            $tableName = $tempUser->getTableName();
            return parent::findAll($tableName);
        }

        public function insert(){
            try {
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
    
                return $stmt->execute();
                 
            } catch (PDOException $e) {
                // Lidar com exceções de banco de dados, se necessário
                return false;
            } 
        }

        public function update($id){
           
        }
    }
?>