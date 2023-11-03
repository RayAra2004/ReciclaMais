<?php 
    require_once __DIR__ . '/../../database/crud.php';

    class Endereco extends CRUD{
        protected $table = 'endereco';
        private $id;
        private $cep;
        private $logradouro;
        private $fk_tipo_logradouro;
        private $tipo_logradouro;
        private $fk_estado_id;
        private $estado;
        private $fk_cidade_id;
        private $cidade;
        private $fk_bairro_id;
        private $bairro;
        private $numero;
        private $complemento;
        private $longitude;
        private $latitude;

        public function __construct(){
        }

        public function setValues($cep, $logradouro, $tipo_logradouro, $estado, $cidade, $bairro, 
            $numero, $complemento = null){

                $validatedData = $this->validarDados($cep, $logradouro, $tipo_logradouro, $estado, 
                    $cidade, $bairro, $numero, $complemento);

                if (isset($validatedData['erros'])) {
                    // Lida com os erros, como retornar uma mensagem de erro ou lançar uma exceção
                    return $validatedData['erros'];
                }

                $this->cep = $validatedData['cep'];
                $this->logradouro = $validatedData['logradouro'];
                $this->tipo_logradouro = $validatedData['tipo_logradouro'];
                $this->estado = $validatedData['estado'];
                $this->cidade = $validatedData['cidade'];
                $this->bairro = $validatedData['bairro'];
                $this->numero = $validatedData['numero'];
                $this->complemento = $validatedData['complemento'];
        }

        private function validarDados($cep, $logradouro, $tipo_logradouro, $estado, $cidade, 
            $bairro, $numero, $complemento = null){

            $cep = preg_replace('/[^0-9]/', '', $cep);
            $logradouro = preg_replace('/[^A-Za-z0-9\s]/', '', $logradouro);
            $numero = preg_replace('/[^0-9]/', '', $numero);
            $cidade = preg_replace('/[^A-Za-z\s]/', '', $cidade);
            $bairro = preg_replace('/[^A-Za-z\s]/', '', $bairro);
            $tipo_logradouro = preg_replace('/[^A-Za-z\s]/', '', $tipo_logradouro);
            $estado = preg_replace('/[^A-Za-z\s]/', '', $estado);
            $complemento = preg_replace('/[^A-Za-z0-9\s]/', '', $complemento);

            $formatLogradouro = array("options" => array("regexp" => "/([\wÀ-ÿ&-0-9])/"));
            if(! filter_var($logradouro, FILTER_VALIDATE_REGEXP, $formatLogradouro)){
                $erros[] = "Logradouro inválido";
            }

            $formatNumero = array("options" => array("regexp" => "/[0-9]/"));
            if(! filter_var($numero, FILTER_VALIDATE_REGEXP, $formatNumero)){
                $erros[] = "Número inválido";
            }

            $formatCidade = array("options" => array("regexp" => "/([\wÀ-ÿ&-0-9])/"));
            if(! filter_var($cidade, FILTER_VALIDATE_REGEXP, $formatCidade)){
                $erros[] = "Cidade inválida";
            }

            $formatBairro = array("options" => array("regexp" => "/([\wÀ-ÿ&-0-9])/"));
            if(! filter_var($bairro, FILTER_VALIDATE_REGEXP, $formatBairro)){
                $erros[] = "Bairro inválido";
            }

            $response = [];

            if(empty($erros)){
                $response = [
                    'cep' => $cep,
                    'logradouro' => $logradouro,
                    'numero' => $numero,
                    'cidade' => $cidade,
                    'bairro' => $bairro,
                    'tipo_logradouro' => $tipo_logradouro,
                    'estado' => $estado,
                    'complemento' => $complemento
                ];
            }else{
                $response['erros'] = $erros;
            }

            return $response;
        }

        private function insertAdjacent($tableName, $value){
            $sql = "INSERT INTO " . $tableName . "(" . $tableName . ") VALUES (:value) ON CONFLICT (" . $tableName . ") DO NOTHING RETURNING id;";
            $stmt = Database::prepare($sql);
            $stmt->bindParam(':value', $value);
        
            if ($stmt->execute()) {
                // Usa fetchColumn para obter o valor retornado
                $id = $stmt->fetchColumn();
                return $id;
            }
        
            return false;
        }
        

        public function insert(){

            $this->fk_tipo_logradouro = $this->insertAdjacent("tipo_logradouro", $this->tipo_logradouro);         
            $this->fk_estado_id = $this->insertAdjacent("estado", $this->estado);      
            $this->fk_cidade_id = $this->insertAdjacent("cidade", $this->cidade);        
            $this->fk_bairro_id = $this->insertAdjacent("bairro", $this->bairro);
      
            if($this->fk_tipo_logradouro === false || $this->fk_estado_id === false 
                || $this->fk_cidade_id === false || $this->fk_bairro_id === false){
                    return false;
            }

            $sql = "INSERT INTO $this->table (cep, fk_tipo_logradouro, logradouro, fk_estado_id,
                fk_cidade_id, fk_bairro_id, numero, complemento, longitude, latitude) 
                VALUES (:cep, :fk_tipo_logradouro, :logradouro, :fk_estado_id,
                    :fk_cidade_id, :fk_bairro_id, :numero, :complemento, :longitude, :latitude);";
            
            $stmt = Database::prepare($sql);
            $stmt->bindParam(':cep', $this->cep, PDO::PARAM_INT);
            $stmt->bindParam(':fk_tipo_logradouro', $this->fk_tipo_logradouro, PDO::PARAM_INT);
            $stmt->bindParam(':logradouro', $this->logradouro);
            $stmt->bindParam(':fk_estado_id', $this->fk_estado_id);
            $stmt->bindParam(':fk_cidade_id', $this->fk_cidade_id, PDO::PARAM_INT);
            $stmt->bindParam(':fk_bairro_id', $this->fk_bairro_id, PDO::PARAM_INT);
            $stmt->bindParam(':numero', $this->numero, PDO::PARAM_INT);
            $stmt->bindParam(':complemento', $this->complemento);
            $stmt->bindParam(':longitude', $this->latitude, PDO::PARAM_INT);
            $stmt->bindParam(':latitude', $this->longitude, PDO::PARAM_INT);

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