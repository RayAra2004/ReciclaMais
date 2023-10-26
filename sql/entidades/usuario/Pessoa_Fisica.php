<?php
    require_once(dirname(__FILE__) ."./Usuario.php");

    class Pessoa_Fisica extends Usuario{
        protected $table = "usuario_pessoa_fisica";
        private $dataNascimento;
        public function __construct($login = null, $senha = null, $nome = null, $telefone = null, $dataNascimento = null) {
            parent::__construct($login, $senha, $nome, $telefone);

            $this->dataNascimento = $dataNascimento;
        }

        public function insert(){

            
        }

        public function update($id){
           
        }
    }
?>