<?php 
    require_once __DIR__ . '/../../database/crud.php';

    class Material extends CRUD{
        protected $table = "material_reciclavel";

        private $peso_estimado;
        private $id;
        private $descricao;
        private $materiais_reciclados;
        private $nome;
        private $imagem;
        private $fk_usuario_pessoa_fisica_fk_usuario_id; 
        private $fk_usuario_instituicao_fk_usuario_id;
        private $fk_coletado_id;

        public function __construct(){
        }

        public function setvalues($nome, $descricao, $peso_estimado, $imagem, $fk_usuario_pessoa_fisica_fk_usuario_id, $materiais_reciclados){
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->peso_estimado = $peso_estimado;
            $this->imagem = $imagem;
            $this->fk_usuario_pessoa_fisica_fk_usuario_id = $fk_usuario_pessoa_fisica_fk_usuario_id;
            $this->materiais_reciclados = $materiais_reciclados;
        }

        public function insert(){
            $coletado_id = 1;

            $sql = "INSERT INTO $this->table (nome, imagem, descricao, fk_usuario_pessoa_fisica_fk_usuario_id, peso_estimado, fk_coletado_id) 
                VALUES (:nome, :imagem, :descricao, :fk_usuario_pessoa_fisica_fk_usuario_id, :peso_estimado, :fk_coletado_id);";
            
            $stmt = Database::prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':imagem', $this->imagem);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':fk_usuario_pessoa_fisica_fk_usuario_id', $this->fk_usuario_pessoa_fisica_fk_usuario_id, PDO::PARAM_INT);
            $stmt->bindParam(':peso_estimado', $this->peso_estimado);
            $stmt->bindParam(':fk_coletado_id', $coletado_id, PDO::PARAM_INT);

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

        public static function findMateriaisPaginado($limit, $offset, $id_user){
            $sql = "SELECT material_reciclavel.id, material_reciclavel.imagem, coletado.descricao
                FROM material_reciclavel
                INNER JOIN coletado ON material_reciclavel.fk_coletado_id = coletado.id
                INNER JOIN usuario ON material_reciclavel.fk_usuario_pessoa_fisica_fk_usuario_id = usuario.id
                WHERE usuario.id = :id_user
                LIMIT " . $limit . " OFFSET " . $offset;
            $stmt = Database::prepare($sql);
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        private function cadastrar_materiais_reciclados(){
            foreach ($this->materiais_reciclados as $material){
                $sql = "SELECT * FROM categoria_de_materiais_reciclados WHERE descricao = :material;";
                $stmt = Database::prepare($sql);
                $stmt->bindParam(":material", $material);
                $stmt->execute();
                $material = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $id_material = $material['id'];

                $sql = "INSERT INTO pertence (fk_categoria_de_materiais_reciclados_id, fk_material_reciclavel_id)
                    VALUES(:fk_categoria_de_materiais_reciclados_id, :fk_material_reciclavel_id);";
                $stmt = Database::prepare($sql);
                $stmt->bindParam(":fk_categoria_de_materiais_reciclados_id", $id_material);
                $stmt->bindParam(":fk_material_reciclavel_id", $this->id);
                if($stmt->execute() === false){
                    return false;
                }
            }

            return true;
        }

        public function update($id){

        }
    }
?>