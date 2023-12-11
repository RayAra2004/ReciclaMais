<?php 
    require_once __DIR__ . '/../../database/crud.php';

    class PontoColeta extends CRUD{

        protected $table = 'cadastro_ponto_coleta';
        private $id;
        private $nome;
        private $imagemURL;
        private $telefone;
        private $fk_usuario_instituicao_fk_usuario_id;
        private $fk_endereco_id;
        private $fk_usuario_id;
        private $materiais_reciclados;


        public function __construct(){
        }

        public function setValues($id =null, $nome, $imagemURL, $fk_usuario_instituicao_fk_usuario_id = null, 
            $fk_endereco_id, $fk_usuario_id, $materiais_reciclados, $telefone = null){

            $this->id = $id;
            $this->nome = $nome;
            $this->imagemURL = $imagemURL;
            $this->fk_usuario_instituicao_fk_usuario_id = $fk_usuario_instituicao_fk_usuario_id;
            $this->fk_endereco_id = $fk_endereco_id;
            $this->fk_usuario_id = $fk_usuario_id;
            $this->materiais_reciclados = $materiais_reciclados;
            $this->telefone = $telefone;
        }

        public function insert(){
            $sql = "INSERT INTO $this->table (nome, imagem, telefone, fk_usuario_instituicao_fk_usuario_id, fk_endereco_id, fk_usuario_id) 
                VALUES (:nome, :imagem, :telefone, :fk_usuario_instituicao_fk_usuario_id, :fk_endereco_id, :fk_usuario_id);";
            
            $stmt = Database::prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':imagem', $this->imagemURL);
            $stmt->bindParam(':telefone', $this->telefone);
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

        public static function findAllPontosColetaMapa(){
            $sql = "select cadastro_ponto_coleta.nome,avg(comentario.nota) as media, count(comentario.nota) as quantos, sum(comentario.nota) as soma, cadastro_ponto_coleta.id, cadastro_ponto_coleta.imagem,endereco.cep, endereco.latitude, endereco.longitude, endereco.logradouro, endereco.numero, endereco.complemento, estado.estado, cidade.cidade, bairro.bairro, tipo_logradouro.tipo_logradouro,   jsonb_agg(jsonb_build_object(
                'id', categoria_de_materiais_reciclados.descricao
              )) AS materiais_reciclados, cadastro_ponto_coleta.telefone
                            from comentario
                            left JOIN cadastro_ponto_coleta
                            ON cadastro_ponto_coleta.id = comentario.fk_ponto_coleta_id
                            left JOIN recicla
                            ON cadastro_ponto_coleta.id = recicla.fk_ponto_coleta_id
                            left join categoria_de_materiais_reciclados
                            on categoria_de_materiais_reciclados.id = recicla.fk_categoria_de_materiais_reciclados_id
                            left join endereco
                            on cadastro_ponto_coleta.fk_endereco_id = endereco.id
                            left JOIN estado
                            ON estado.id = endereco.fk_estado_id
                            left JOIN cidade
                            ON cidade.id = endereco.fk_cidade_id
                            left JOIN bairro
                            ON bairro.id = endereco.fk_bairro_id
                            left JOIN tipo_logradouro
                            ON tipo_logradouro.id = endereco.fk_tipo_logradouro_id
                            group by cadastro_ponto_coleta.nome, cadastro_ponto_coleta.id, cadastro_ponto_coleta.imagem,endereco.cep, endereco.latitude, endereco.longitude, endereco.logradouro, endereco.numero, endereco.complemento, estado.estado, cidade.cidade, bairro.bairro, tipo_logradouro.tipo_logradouro, recicla.fk_ponto_coleta_id
                            order by media DESC;";
            $stmt = Database::prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function findPontosColetaPaginado($limit, $offset, $latitude, $longitude){
            $sql = "WITH DistanceCTE AS (
                SELECT
                    cadastro_ponto_coleta.id,
                    cadastro_ponto_coleta.nome,
                    cadastro_ponto_coleta.imagem,
                    STRING_AGG(cmr.descricao, ', ') AS materiais_reciclados,
                    CAST((float8(point(:latitude, :longitude) <@> point(endereco.latitude, endereco.longitude)) * 1609 / 1000) AS DECIMAL(10,1)) AS distancia
                FROM
                    cadastro_ponto_coleta
                JOIN
                    recicla ON cadastro_ponto_coleta.id = recicla.fk_ponto_coleta_id
                JOIN
                    categoria_de_materiais_reciclados cmr ON recicla.fk_categoria_de_materiais_reciclados_id = cmr.id
                JOIN
                    endereco ON cadastro_ponto_coleta.fk_endereco_id = endereco.id
                GROUP BY
                    cadastro_ponto_coleta.nome, cadastro_ponto_coleta.id, distancia
                )
                SELECT *
                FROM DistanceCTE
                WHERE distancia < 5
                ORDER BY distancia
                LIMIT " . $limit . " OFFSET " . $offset;
            $stmt = Database::prepare($sql);
            $stmt->bindParam(":latitude", $latitude);
            $stmt->bindParam(":longitude", $longitude);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function findPontoColetaById($id){
            $sql = "SELECT
                cadastro_ponto_coleta.nome,
                cadastro_ponto_coleta.id,
                cadastro_ponto_coleta.imagem,
                cadastro_ponto_coleta.telefone,
                endereco.cep,
                endereco.latitude,
                endereco.longitude,
                endereco.logradouro,
                endereco.numero,
                endereco.complemento,
                estado.estado,
                cidade.cidade,
                bairro.bairro,
                tipo_logradouro.tipo_logradouro,
                ROUND(avg(comentario.nota)) as nota,
                STRING_AGG(cmr.descricao, ', ') AS materiais_reciclados
            FROM
                cadastro_ponto_coleta
            INNER JOIN endereco ON cadastro_ponto_coleta.fk_endereco_id = endereco.id
            INNER JOIN estado ON estado.id = endereco.fk_estado_id
            INNER JOIN cidade ON cidade.id = endereco.fk_cidade_id
            INNER JOIN bairro ON bairro.id = endereco.fk_bairro_id
            INNER JOIN tipo_logradouro ON tipo_logradouro.id = endereco.fk_tipo_logradouro_id
            LEFT JOIN comentario ON cadastro_ponto_coleta.id = comentario.fk_ponto_coleta_id
            LEFT JOIN usuario ON usuario.id = comentario.fk_usuario_pessoa_fisica_fk_usuario_id
            LEFT JOIN recicla ON cadastro_ponto_coleta.id = recicla.fk_ponto_coleta_id
            LEFT JOIN categoria_de_materiais_reciclados cmr ON recicla.fk_categoria_de_materiais_reciclados_id = cmr.id
            WHERE
                cadastro_ponto_coleta.id = :id
            GROUP BY
                cadastro_ponto_coleta.nome,
                cadastro_ponto_coleta.id,
                cadastro_ponto_coleta.imagem,
                endereco.cep,
                endereco.latitude,
                endereco.longitude,
                endereco.logradouro,
                endereco.numero,
                endereco.complemento,
                estado.estado,
                cidade.cidade,
                bairro.bairro,
                tipo_logradouro.tipo_logradouro;";
            
            $stmt = Database::prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
             
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public static function postComentario($idPontoColeta, $idUsuario, $conteudo, $nota){
            $sql = "INSERT INTO comentario (conteudo, nota, fk_usuario_pessoa_fisica_fk_usuario_id, fk_ponto_coleta_id)
                VALUES (:conteudo, :nota, :fk_usuario_pessoa_fisica_fk_usuario_id, :fk_ponto_coleta_id);";
            $stmt = Database::prepare($sql);
            $stmt->bindParam(":conteudo", $conteudo);
            $stmt->bindParam(":nota", $nota);
            $stmt->bindParam(":fk_usuario_pessoa_fisica_fk_usuario_id", $idUsuario);
            $stmt->bindParam(":fk_ponto_coleta_id", $idPontoColeta);
            
            return $stmt->execute();
        }

        public static function getComentarios($id, $limit, $offset){
            $sql = "SELECT comentario.conteudo, comentario.id, comentario.nota,
                usuario.nome
                FROM comentario
                INNER JOIN usuario ON usuario.id = comentario.fk_usuario_pessoa_fisica_fk_usuario_id
                INNER JOIN cadastro_ponto_coleta ON cadastro_ponto_coleta.id = comentario.fk_ponto_coleta_id
                WHERE cadastro_ponto_coleta.id = :id
                ORDER BY data_postagem desc
                LIMIT " . $limit . " OFFSET " . $offset;
            $stmt = Database::prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        public function findByUser($user_id){
            $sql="SELECT * FROM $this->table WHERE fk_usuario_instituicao_fk_usuario_id = :id";
			$stmt = Database::prepare($sql);	
			$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
			$stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getMateriaisReciclados($id){
            $sql="SELECT categoria_de_materiais_reciclados.descricao FROM $this->table
                INNER JOIN recicla
                ON cadastro_ponto_coleta.id = recicla.fk_ponto_coleta_id
                INNER JOIN categoria_de_materiais_reciclados
                ON recicla.fk_categoria_de_materiais_reciclados_id = categoria_de_materiais_reciclados.id
                WHERE cadastro_ponto_coleta.id = :id";
			$stmt = Database::prepare($sql);	
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>