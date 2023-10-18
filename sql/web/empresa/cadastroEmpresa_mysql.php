<?php 
    
    function cadastrarEmpresa($connect, $dados) {
        $nome_empresa = mysqli_real_escape_string($connect, $dados['nome_empresa']);
        $cnpj = mysqli_real_escape_string($connect, $dados['cnpj']);
        $telefone = mysqli_real_escape_string($connect, $dados['telefone']);
        $email = mysqli_real_escape_string($connect, $dados['email']);
        $senha = mysqli_real_escape_string($connect, $dados['senha']);
        $cep = mysqli_real_escape_string($connect, $dados['cep']);
        $logradouro = mysqli_real_escape_string($connect, $dados['logradouro']);
        $numero = mysqli_real_escape_string($connect, $dados['numero']);
        $cidade = mysqli_real_escape_string($connect, $dados['cidade']);
        $bairro = mysqli_real_escape_string($connect, $dados['bairro']);
        $tp_logradouro = mysqli_real_escape_string($connect, $dados['tp_logradouro']);
        $uf = mysqli_real_escape_string($connect, $dados['uf']);
        $complemento = mysqli_real_escape_string($connect, $dados['complemento']);

        
        $idCidade = cadEndereco($connect, 'CIDADE', $cidade);
        $idBairro = cadEndereco($connect, 'BAIRRO', $bairro);
        $idtp_logradouro = cadEndereco($connect, 'TIPO_LOGRADOURO', $tp_logradouro);
        $idUf = cadEndereco($connect, 'ESTADO', $uf);
        
    }

    function cadEndereco($connect, $table, $value) {
        $table = mysqli_real_escape_string($connect, $table); // Evita SQL injection
        $value = mysqli_real_escape_string($connect, $value); // Evita SQL injection
    
        $sql = "SELECT * FROM $table WHERE $table = '$value';";
        $resultado = mysqli_query($connect, $sql);
    
        if ($resultado) {
            if (mysqli_num_rows($resultado) > 0) {
                $linha = mysqli_fetch_assoc($resultado);
                return $linha[$table . '_PK'];
            } else {
                $sql = "INSERT INTO $table ($table) VALUES ('$value');";
                $resultado = mysqli_query($connect, $sql);
    
                if ($resultado) {
                    $id = mysqli_insert_id($connect);
                    return $id;
                } else {
                    // TODO: Tratar erros na inserção de uma nova informação
                }
            }
        } else {
            // TODO: Tratar erros na consulta SQL
        }
    }
    
?>