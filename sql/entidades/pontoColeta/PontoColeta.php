<?php 
    require_once __DIR__ . '/../../database/crud.php';

    class PontoColeta extends CRUD{

        protected $table = 'cadastro_ponto_coleta';
        private $id;
        private $nome;
        private $imagemURL;
        private $fk_usuario_instituicao_fk_usuario_id;
        private $fk_endereco_id;
        private $fk_usuario_id;
        private $materiais_reciclados;


        public function __construct(){
        }

        public function setValues($id =null, $nome, $imagemURL, $fk_usuario_instituicao_fk_usuario_id = null, 
            $fk_endereco_id, $fk_usuario_id, $materiais_reciclados){

            $this->id = $id;
            $this->nome = $nome;
            $this->imagemURL = $imagemURL;
            $this->fk_usuario_instituicao_fk_usuario_id = $fk_usuario_instituicao_fk_usuario_id;
            $this->fk_endereco_id = $fk_endereco_id;
            $this->fk_usuario_id = $fk_usuario_id;
            $this->materiais_reciclados = $materiais_reciclados;
        }

        public function insert(){
            $sql = "INSERT INTO $this->table (nome, imagem, fk_usuario_instituicao_fk_usuario_id, fk_endereco_id, fk_usuario_id) 
                VALUES (:nome, :imagem, :fk_usuario_instituicao_fk_usuario_id, :fk_endereco_id, :fk_usuario_id);";
            
            $stmt = Database::prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':imagem', $this->imagemURL);
            $stmt->bindParam(':fk_usuario_instituicao_fk_usuario_id', $this->fk_usuario_instituicao_fk_usuario_id, PDO::PARAM_INT);
            $stmt->bindParam(':fk_endereco_id', $this->fk_endereco_id, PDO::PARAM_INT);
            $stmt->bindParam(':fk_usuario_id', $this->fk_usuario_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Recupere o ID inserido
                $this->id = Database::getInstance()->lastInsertId();
                
                if(self::cadastrar_materiais_reciclados()){
                    return true;
                }else{
                    return false;
                }
                
            }
    
            return false;
        }

        public function getTableName(){
            return $this->table;
        }

        public static function findAllPontosColeta(){
            $tempUser = new PontoColeta();
            $tableName = $tempUser->getTableName();
            return parent::findAll($tableName);
        }

        public function update($id){
        
        }

        private function cadastrar_materiais_reciclados(){
            foreach ($this->materiais_reciclados as $material){
                $sql = "SELECT * FROM categoria_de_materiais_reciclados WHERE descricao = :material;";
                $stmt = Database::prepare($sql);
                $stmt->bindParam(":material", $material);
                $stmt->execute();
                $material = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $id_material = $material['id'];

                $sql = "INSERT INTO recicla (fk_categoria_de_materiais_reciclados_id, fk_ponto_coleta_id)
                    VALUES(:fk_categoria_de_materiais_reciclados_id, :fk_ponto_coleta_id);";
                $stmt = Database::prepare($sql);
                $stmt->bindParam(":fk_categoria_de_materiais_reciclados_id", $id_material);
                $stmt->bindParam(":fk_ponto_coleta_id", $this->id);
                if($stmt->execute() === false){
                    return false;
                }
            }

            return true;
        }

        public function delete($id){
            $sql="DELETE FROM $this->table WHERE fk_usuario_instituicao_fk_usuario_id = :id";
			$stmt = Database::prepare($sql);	
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			return $stmt->execute();
        }
    }

?>