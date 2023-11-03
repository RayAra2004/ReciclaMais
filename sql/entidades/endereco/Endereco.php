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

        public function insert(){
            
        }

        public function update($id){
        }
    }
?>