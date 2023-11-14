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
        private $fk_usuario_id;
        public function __construct() {}

        public function setValuesPJ($cnpj, $urlLogo, $id_endereco, $id_tipo_assinatura, $fk_usuario_id){
            
            $validatedData = $this->validarDados($cnpj, $urlLogo);
        
            if (isset($validatedData['erros'])) {
                // Lida com os erros, como retornar uma mensagem de erro ou lançar uma exceção
                return $validatedData['erros'];
            }

            $this->cnpj = $validatedData['cnpj'];
            $this->logo = $validatedData['logo'];
            $this->id_endereco = $id_endereco;
            $this->id_tipo_assinatura = $id_tipo_assinatura;
            $this->fk_usuario_id = $fk_usuario_id;
        }
        
        private function validarDados($cnpj, $url){
            $erros = array();

            $url = "https://reciclabrasilararaquara.com.br/wp-content/uploads/2021/04/Ilustracao-Recicla-Brasil-2.png";

            $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
            $urlIsValid = preg_match('/^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/', $url);

            if(strlen($cnpj)!=14){
                $erros[] = "CNPJ inválido";
            }

            if(!$urlIsValid){
                $erros[] = "URL inválida";
            }

            $response = [];

            if(empty($erros)){
                $response = [
                    'cnpj' => $cnpj,
                    'logo' => $url
                ];
            }else{
                $response['erros'] = $erros;
            }

            return $response;
        }

        public function getTableName(){
            return $this->table;
        }

        public function getId(){
            return $this->fk_usuario_id;
        }

        public static function findAllJuridicPeople(){
            $tempUser = new Pessoa_Juridica();
            $tableName = $tempUser->getTableName();
            return parent::findAll($tableName);
        }

        public function insert(){
            try {
                $sql = "INSERT INTO $this->table
                    (fk_usuario_id, fk_endereco_id, fk_tipo_assinatura_id, cnpj, logo)
                    VALUES (:fk_usuario_id, :fk_endereco_id, :fk_tipo_assinatura_id, :cnpj, :logo);";
                
                $stmt = Database::prepare($sql);
                $stmt->bindParam(':fk_usuario_id', $this->fk_usuario_id, PDO::PARAM_INT); // Obtém o ID do usuário
                $stmt->bindParam(':fk_endereco_id', $this->id_endereco, PDO::PARAM_INT);
                $stmt->bindParam(':fk_tipo_assinatura_id', $this->id_tipo_assinatura, PDO::PARAM_INT);
                $stmt->bindParam(':cnpj', $this->cnpj, PDO::PARAM_INT);
                $stmt->bindParam(':logo', $this->logo, PDO::PARAM_STR);
    
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