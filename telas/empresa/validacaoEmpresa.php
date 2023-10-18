<?php
function validacaoEmpresa($dadosEmpresa){
    $erros = array();

    if(isset($dadosEmpresa["btn-cadastro"])){ 
        $nome_empresa = $dadosEmpresa["nome-empresa"];
        $cnpj = $dadosEmpresa["cnpj"];
        $telefone = $dadosEmpresa["telefone"];
        $email = $dadosEmpresa["email"];
        $senha = $dadosEmpresa["senha"];
        $cep = $dadosEmpresa["cep"];
        $tp_logradouro = $dadosEmpresa["tp-logradouro"];
        $logradouro = $dadosEmpresa["logradouro"];
        $numero = $dadosEmpresa["numero"];
        $uf = $dadosEmpresa["uf"];
        $cidade = $dadosEmpresa["cidade"];
        $bairro = $dadosEmpresa["bairro"];
        $complemento = $dadosEmpresa["complemento"];
        
        $nome_empresa = filter_var($nome_empresa, FILTER_SANITIZE_SPECIAL_CHARS);
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        $telefone = preg_replace('/[^0-9]/', '', $telefone);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $senha = preg_replace('/[^A-Za-z0-9]/', '', $senha);
        $cep = preg_replace('/[^0-9]/', '', $cep);
        $logradouro = preg_replace('/[^A-Za-z0-9\s]/', '', $logradouro);
        $numero = preg_replace('/[^0-9]/', '', $numero);
        $cidade = preg_replace('/[^A-Za-z\s]/', '', $cidade);
        $bairro = preg_replace('/[^A-Za-z\s]/', '', $bairro);
        $tp_logradouro = preg_replace('/[^A-Za-z\s]/', '', $tp_logradouro);
        $uf = preg_replace('/[^A-Za-z\s]/', '', $uf);
        $complemento = preg_replace('/[^A-Za-z0-9\s]/', '', $complemento);
        $senha = filter_var($senha, FILTER_SANITIZE_SPECIAL_CHARS);


        $formatName = array("options" => array("regexp" => "/([\wÀ-ÿ&-0-9])/"));
        if(! filter_var($nome_empresa, FILTER_VALIDATE_REGEXP, $formatName)){
            $erros[] = "Nome inválido";
        }

        if(strlen($cnpj)!=14){
            $erros[] = "CNPJ inválido";
        }

        if((strlen($telefone) < 10 || strlen($telefone) >11)){
            $erros[] = "Telefone inválido";
        }
        
        if(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
            $erros[] = "Email inválido";
        }

        $formatPassword = array("options" => array("regexp" => "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/"));
        if(! filter_var($senha, FILTER_VALIDATE_REGEXP, $formatPassword)){
            $erros[] = "Senha inválida";
        }

        if(strlen($cep)!=8){
            $erros[] = "CEP inválido";
        }
        
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
    }

    $response = [];

    if(empty($erros)){
        $response = [
            'nome_empresa' => $nome_empresa,
            'cnpj' => $cnpj,
            'telefone' => $telefone,
            'email' => $email,
            'senha' => $senha,
            'cep' => $cep,
            'logradouro' => $logradouro,
            'numero' => $numero,
            'cidade' => $cidade,
            'bairro' => $bairro,
            'tp_logradouro' => $tp_logradouro,
            'uf' => $uf,
            'complemento' => $complemento
        ];
    }else{
        $response['erros'] = $erros;
    }

    return $response;
}
    
?>