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

        public function getId(){
            return $this->id;
        }

        private function validarDados($cep, $logradouro, $tipo_logradouro, $estado, $cidade, 
            $bairro, $numero, $complemento = null){

            $cep = preg_replace('/[^0-9]/', '', $cep);
            $numero = preg_replace('/[^0-9]/', '', $numero);
            $tipo_logradouro = preg_replace('/[^A-Za-z\s]/', '', $tipo_logradouro);
            $estado = preg_replace('/[^A-Za-z\s]/', '', $estado);

            

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
            $sql = "SELECT * FROM " . $tableName . " WHERE " . $tableName . " = :value;";
            $stmt = Database::prepare($sql);
            $stmt->bindParam(':value', $value);
            $teste = $stmt->execute();

            if ($teste === false) {
                // Erro ao executar a consulta
                // Faça o tratamento apropriado para o erro aqui
            } else {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    // A cidade já existe, retorne o id
                    $id = $result['id'];
                    return $id;
                } else {
                    // A cidade não existe, faça a inserção
                    $sql = "INSERT INTO " . $tableName . "(" . $tableName . ") VALUES (:value) RETURNING id;";
                    $stmt = Database::prepare($sql);
                    $stmt->bindParam(':value', $value);

                    if ($stmt->execute()) {
                        // Usa fetchColumn para obter o valor retornado
                        $id = $stmt->fetchColumn();
                        return $id;
                    } else {
                        // Erro ao executar a inserção
                        // Faça o tratamento apropriado para o erro aqui
                    }
                }
            }

        }

        private function getGeolocationByAdress(){
            $endereco = $this->numero . "," . $this->bairro . "," . $this->cidade . ",brazil," . $this->cep;
            $api_key = "AIzaSyATenWPcH_IiPOpjK_3HHmUVfby-PVS1Ko";

            // Construa a URL da API com o endereço e a chave de API
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($endereco) . "&key=" . $api_key;

            // Faça a solicitação à API
            $response = file_get_contents($url);

            // Decodifique a resposta JSON
            $data = json_decode($response);

            // Verifique se a solicitação foi bem-sucedida e obtenha a latitude e a longitude
            if ($data->status === "OK") {
                $latitude = $data->results[0]->geometry->location->lat;
                $longitude = $data->results[0]->geometry->location->lng;

                $this->latitude = $latitude;
                $this->longitude = $longitude;
                
                return true;

            } else {
                // Trate os erros, por exemplo, se o endereço não pôde ser geocodificado
                return false;
            }
        }

        public static function getDados($id){
            $sql = "SELECT endereco.cep, endereco.latitude, endereco.longitude, 
                        endereco.logradouro, endereco.numero, 
                        endereco.complemento, estado.estado, cidade.cidade, bairro.bairro, 
                        tipo_logradouro.tipo_logradouro
                FROM endereco
                INNER JOIN estado
                ON estado.id = endereco.fk_estado_id
                INNER JOIN cidade
                ON cidade.id = endereco.fk_cidade_id
                INNER JOIN bairro
                ON bairro.id = endereco.fk_bairro_id
                INNER JOIN tipo_logradouro
                ON tipo_logradouro.id = endereco.fk_tipo_logradouro_id
                WHERE endereco.id = :id;";
            
            $stmt = Database::prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        

        public function insert(){

            $this->fk_tipo_logradouro = $this->insertAdjacent("tipo_logradouro", $this->tipo_logradouro);         
            $this->fk_estado_id = $this->insertAdjacent("estado", $this->estado);      
            $this->fk_cidade_id = $this->insertAdjacent("cidade", $this->cidade);        
            $this->fk_bairro_id = $this->insertAdjacent("bairro", $this->bairro);
            
            /*var_dump($this->fk_tipo_logradouro);
            var_dump($this->fk_estado_id);
            var_dump($this->fk_cidade_id);
            var_dump($this->fk_bairro_id);*/

            if($this->fk_tipo_logradouro === false || $this->fk_estado_id === false 
                || $this->fk_cidade_id === false || $this->fk_bairro_id === false){
                    return false;
            }

            if(!($this->getGeolocationByAdress())){
                return false;
            }

            $sql = "INSERT INTO $this->table (cep, fk_tipo_logradouro_id, logradouro, fk_estado_id,
                fk_cidade_id, fk_bairro_id, numero, complemento, longitude, latitude) 
                VALUES (:cep, :fk_tipo_logradouro_id, :logradouro, :fk_estado_id,
                    :fk_cidade_id, :fk_bairro_id, :numero, :complemento, :longitude, :latitude);";
            
            $stmt = Database::prepare($sql);
            $stmt->bindParam(':cep', $this->cep, PDO::PARAM_INT);
            $stmt->bindParam(':fk_tipo_logradouro_id', $this->fk_tipo_logradouro, PDO::PARAM_INT);
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

            $this->fk_tipo_logradouro = $this->insertAdjacent("tipo_logradouro", $this->tipo_logradouro);         
            $this->fk_estado_id = $this->insertAdjacent("estado", $this->estado);      
            $this->fk_cidade_id = $this->insertAdjacent("cidade", $this->cidade);        
            $this->fk_bairro_id = $this->insertAdjacent("bairro", $this->bairro);

            if($this->fk_tipo_logradouro === false || $this->fk_estado_id === false 
            || $this->fk_cidade_id === false || $this->fk_bairro_id === false){
                return false;
            }

            if(!($this->getGeolocationByAdress())){
                return false;
            }
            
            $sql = "UPDATE $this->table SET cep = :cep, fk_tipo_logradouro_id = :fk_tipo_logradouro_id,
                    logradouro = :logradouro, fk_estado_id = :fk_estado_id, fk_cidade_id = :fk_cidade_id,
                    fk_bairro_id = :fk_bairro_id, numero = :numero, complemento = :complemento, 
                    longitude = :longitude, latitude = :latitude WHERE id = :id;";
            
            $stmt = Database::prepare($sql);
            $stmt->bindParam(':cep', $this->cep, PDO::PARAM_INT);
            $stmt->bindParam(':fk_tipo_logradouro_id', $this->fk_tipo_logradouro, PDO::PARAM_INT);
            $stmt->bindParam(':logradouro', $this->logradouro);
            $stmt->bindParam(':fk_estado_id', $this->fk_estado_id);
            $stmt->bindParam(':fk_cidade_id', $this->fk_cidade_id, PDO::PARAM_INT);
            $stmt->bindParam(':fk_bairro_id', $this->fk_bairro_id, PDO::PARAM_INT);
            $stmt->bindParam(':numero', $this->numero, PDO::PARAM_INT);
            $stmt->bindParam(':complemento', $this->complemento);
            $stmt->bindParam(':longitude', $this->latitude, PDO::PARAM_INT);
            $stmt->bindParam(':latitude', $this->longitude, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        }

    }
?>