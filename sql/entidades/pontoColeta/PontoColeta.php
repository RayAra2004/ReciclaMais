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


        public function __construct(){
        }

        public function setValues($id =null, $nome, $imagemURL, $fk_usuario_instituicao_fk_usuario_id = null, $fk_endereco_id, $fk_usuario_id){
            $this->id = $id;
            $this->nome = $nome;
            $this->imagemURL = $imagemURL;
            $this->fk_usuario_instituicao_fk_usuario_id = $fk_usuario_instituicao_fk_usuario_id;
            $this->fk_endereco_id = $fk_endereco_id;
            $this->fk_usuario_id = $fk_usuario_id;
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
    
                return true;
            }
    
            return false;
        }

        public function update($id){
        
        }
    }

?>