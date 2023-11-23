<?php
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/mudarDadosEmpresariais.css"> <script src="/ReciclaMais/script/mudarDados.js" defer></script>';
    include './../../componentes/header.php';
    include './../../../sql/entidades/usuario/Pessoa_Juridica.php';
    
    $email = $_SESSION['email'];

    $usuario = Pessoa_Juridica::getDadosUpdate($email);

    $cep = $usuario['cep'];
    $logradouro = $usuario['logradouro'];
    $numero = $usuario['numero'];
    $complemento = $usuario['complemento'];
    $estado = $usuario['estado'];
    $cidade = $usuario['cidade'];
    $bairro = $usuario['bairro'];
    $tipo_logradouro = $usuario['tipo_logradouro'];

    
    if(!empty($_POST)){
        $novoCep = $_POST['cep'];
        $novoTipo_logradouro = $_POST['tpLogradouro'];
        $novoLogradouro = $_POST['logradouro'];
        $novoNumero = $_POST['numero'];
        $novoEstado = $_POST['uf'];
        $novoCidade = $_POST['cidade'];
        $novoBairro = $_POST['bairro'];
        $novoComplemnto = $_POST['complemento'];

        $novo_usuario = new Usuario();
        $novo_usuario->setValuesUpdate($novaSenha, $novoNome, $novoTelefone);

        if($novo_usuario->update($email)){
            
        }

        
    }
?>
<section class="body_content">
    <div class="container h-fit-content d-flex justify-content-center">
        <div class="card px-4 py-3 bg-padrao w-90">
            <form action="./mudarDadosEmpresariais.php" method="post" class="form-data">
                <div class="container-fluid row">
                    <div id="div-cad-1" class="div-cad-1 d-flex justify-content-between flex-wrap">
                    <div class="">
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="cep">CEP</label>
                                <input value="<?php echo htmlspecialchars($cep);?>" type="number" name="cep" id="cep" placeholder="Digie seu CEP empresarial" required pattern="\b\d{5}[-.]\d{3}">
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="tpLogradouro">TIPO LOGRADOURO</label>
                                <select id="tp-logradouro" name="tpLogradouro">
                                    <option value="" <?php echo ($tipo_logradouro == '') ? 'selected' : ''; ?>></option>
                                    <option value="aeroporto" <?php echo ($tipo_logradouro == 'aeroporto') ? 'selected' : ''; ?>>aeroporto</option>
                                    <option value="alameda" <?php echo ($tipo_logradouro == 'alameda') ? 'selected' : ''; ?>>alameda</option>
                                    <option value="area" <?php echo ($tipo_logradouro == 'area') ? 'selected' : ''; ?>>área</option>
                                    <option value="avenida" <?php echo ($tipo_logradouro == 'avenida') ? 'selected' : ''; ?>>avenida</option>
                                    <option value="campo" <?php echo ($tipo_logradouro == 'campo') ? 'selected' : ''; ?>>campo</option>
                                    <option value="chacara" <?php echo ($tipo_logradouro == 'chacara') ? 'selected' : ''; ?>>chácara</option>
                                    <option value="colonia" <?php echo ($tipo_logradouro == 'colonia') ? 'selected' : ''; ?>>colônia</option>
                                    <option value="condominio" <?php echo ($tipo_logradouro == 'condominio') ? 'selected' : ''; ?>>condomínio</option>
                                    <option value="conjunto" <?php echo ($tipo_logradouro == 'conjunto') ? 'selected' : ''; ?>>conjunto</option>
                                    <option value="distrito" <?php echo ($tipo_logradouro == 'distrito') ? 'selected' : ''; ?>>distrito</option>
                                    <option value="esplanada" <?php echo ($tipo_logradouro == 'esplanada') ? 'selected' : ''; ?>>esplanada</option>
                                    <option value="estacao" <?php echo ($tipo_logradouro == 'estacao') ? 'selected' : ''; ?>>estação</option>
                                    <option value="estrada" <?php echo ($tipo_logradouro == 'estrada') ? 'selected' : ''; ?>>estrada</option>
                                    <option value="favela" <?php echo ($tipo_logradouro == 'favela') ? 'selected' : ''; ?>>favela</option>
                                    <option value="fazenda" <?php echo ($tipo_logradouro == 'fazenda') ? 'selected' : ''; ?>>fazenda</option>
                                    <option value="feira" <?php echo ($tipo_logradouro == 'feira') ? 'selected' : ''; ?>>feira</option>
                                    <option value="jardim" <?php echo ($tipo_logradouro == 'jardim') ? 'selected' : ''; ?>>jardim</option>
                                    <option value="ladeira" <?php echo ($tipo_logradouro == 'ladeira') ? 'selected' : ''; ?>>ladeira</option>
                                    <option value="lago" <?php echo ($tipo_logradouro == 'lago') ? 'selected' : ''; ?>>lago</option>
                                    <option value="lagoa" <?php echo ($tipo_logradouro == 'lagoa') ? 'selected' : ''; ?>>lagoa</option>
                                    <option value="largo" <?php echo ($tipo_logradouro == 'largo') ? 'selected' : ''; ?>>largo</option>
                                    <option value="loteamento" <?php echo ($tipo_logradouro == 'loteamento') ? 'selected' : ''; ?>>loteamento</option>
                                    <option value="morro" <?php echo ($tipo_logradouro == 'morro') ? 'selected' : ''; ?>>morro</option>
                                    <option value="nucleo" <?php echo ($tipo_logradouro == 'nucleo') ? 'selected' : ''; ?>>núcleo</option>
                                    <option value="parque" <?php echo ($tipo_logradouro == 'parque') ? 'selected' : ''; ?>>parque</option>
                                    <option value="passarela" <?php echo ($tipo_logradouro == 'passarela') ? 'selected' : ''; ?>>passarela</option>
                                    <option value="patio" <?php echo ($tipo_logradouro == 'patio') ? 'selected' : ''; ?>>pátio</option>
                                    <option value="praca" <?php echo ($tipo_logradouro == 'praca') ? 'selected' : ''; ?>>praça</option>
                                    <option value="quadra" <?php echo ($tipo_logradouro == 'quadra') ? 'selected' : ''; ?>>quadra</option>
                                    <option value="recanto" <?php echo ($tipo_logradouro == 'recanto') ? 'selected' : ''; ?>>recanto</option>
                                    <option value="residencial" <?php echo ($tipo_logradouro == 'residencial') ? 'selected' : ''; ?>>residencial</option>
                                    <option value="rodovia" <?php echo ($tipo_logradouro == 'rodovia') ? 'selected' : ''; ?>>rodovia</option>
                                    <option value="rua" <?php echo ($tipo_logradouro == 'rua') ? 'selected' : ''; ?>>rua</option>
                                    <option value="setor" <?php echo ($tipo_logradouro == 'setor') ? 'selected' : ''; ?>>setor</option>
                                    <option value="sitio" <?php echo ($tipo_logradouro == 'sitio') ? 'selected' : ''; ?>>sítio</option>
                                    <option value="travessa" <?php echo ($tipo_logradouro == 'travessa') ? 'selected' : ''; ?>>travessa</option>
                                    <option value="trecho" <?php echo ($tipo_logradouro == 'trecho') ? 'selected' : ''; ?>>trecho</option>
                                    <option value="trevo" <?php echo ($tipo_logradouro == 'trevo') ? 'selected' : ''; ?>>trevo</option>
                                    <option value="vale" <?php echo ($tipo_logradouro == 'vale') ? 'selected' : ''; ?>>vale</option>
                                    <option value="vereda" <?php echo ($tipo_logradouro == 'vereda') ? 'selected' : ''; ?>>vereda</option>
                                    <option value="via" <?php echo ($tipo_logradouro == 'via') ? 'selected' : ''; ?>>via</option>
                                    <option value="viaduto" <?php echo ($tipo_logradouro == 'viaduto') ? 'selected' : ''; ?>>viaduto</option>
                                    <option value="viela" <?php echo ($tipo_logradouro == 'viela') ? 'selected' : ''; ?>>viela</option>
                                    <option value="vila" <?php echo ($tipo_logradouro == 'vila') ? 'selected' : ''; ?>>vila</option>
                                </select>      
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="logradouro">LOGRADOURO</label>
                                <input type="text" name="logradouro" id="logradouro" value="<?php echo htmlspecialchars($logradouro);?>" placeholder="Digite seu logradouro empresarial" required readonly>
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="numero">NÚMERO</label>
                                <input value="225" type="number" name="numero" id="numero" value="<?php echo htmlspecialchars($numero);?>" placeholder="Digite o número" required>
                            </div>
                        </div>
                        <div class="">
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="uf">ESTADO</label>
                                <select id="uf" name="uf">
                                    <option value="" <?php echo ($estado == '') ? 'selected' : ''; ?>></option>
                                    <option value="AC" <?php echo ($estado == 'AC') ? 'selected' : ''; ?>>Acre</option>
                                    <option value="AL" <?php echo ($estado == 'AL') ? 'selected' : ''; ?>>Alagoas</option>
                                    <option value="AP" <?php echo ($estado == 'AP') ? 'selected' : ''; ?>>Amapá</option>
                                    <option value="AM" <?php echo ($estado == 'AM') ? 'selected' : ''; ?>>Amazonas</option>
                                    <option value="BA" <?php echo ($estado == 'BA') ? 'selected' : ''; ?>>Bahia</option>
                                    <option value="CE" <?php echo ($estado == 'CE') ? 'selected' : ''; ?>>Ceará</option>
                                    <option value="DF" <?php echo ($estado == 'DF') ? 'selected' : ''; ?>>Distrito Federal</option>
                                    <option value="ES" <?php echo ($estado == 'ES') ? 'selected' : ''; ?>>Espírito Santo</option>
                                    <option value="GO" <?php echo ($estado == 'GO') ? 'selected' : ''; ?>>Goiás</option>
                                    <option value="MA" <?php echo ($estado == 'MA') ? 'selected' : ''; ?>>Maranhão</option>
                                    <option value="MT" <?php echo ($estado == 'MT') ? 'selected' : ''; ?>>Mato Grosso</option>
                                    <option value="MS" <?php echo ($estado == 'MS') ? 'selected' : ''; ?>>Mato Grosso do Sul</option>
                                    <option value="MG" <?php echo ($estado == 'MG') ? 'selected' : ''; ?>>Minas Gerais</option>
                                    <option value="PA" <?php echo ($estado == 'PA') ? 'selected' : ''; ?>>Pará</option>
                                    <option value="PB" <?php echo ($estado == 'PB') ? 'selected' : ''; ?>>Paraíba</option>
                                    <option value="PR" <?php echo ($estado == 'PR') ? 'selected' : ''; ?>>Paraná</option>
                                    <option value="PE" <?php echo ($estado == 'PE') ? 'selected' : ''; ?>>Pernambuco</option>
                                    <option value="PI" <?php echo ($estado == 'PI') ? 'selected' : ''; ?>>Piauí</option>
                                    <option value="RJ" <?php echo ($estado == 'RJ') ? 'selected' : ''; ?>>Rio de Janeiro</option>
                                    <option value="RN" <?php echo ($estado == 'RN') ? 'selected' : ''; ?>>Rio Grande do Norte</option>
                                    <option value="RS" <?php echo ($estado == 'RS') ? 'selected' : ''; ?>>Rio Grande do Sul</option>
                                    <option value="RO" <?php echo ($estado == 'RO') ? 'selected' : ''; ?>>Rondônia</option>
                                    <option value="RR" <?php echo ($estado == 'RR') ? 'selected' : ''; ?>>Roraima</option>
                                    <option value="SC" <?php echo ($estado == 'SC') ? 'selected' : ''; ?>>Santa Catarina</option>
                                    <option value="SP" <?php echo ($estado == 'SP') ? 'selected' : ''; ?>>São Paulo</option>
                                    <option value="SE" <?php echo ($estado == 'SE') ? 'selected' : ''; ?>>Sergipe</option>
                                    <option value="TO" <?php echo ($estado == 'TO') ? 'selected' : ''; ?>>Tocantins</option>
                                </select>
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="cidade">CIDADE</label>
                                <input type="text" name="cidade" id="cidade" value="<?php echo htmlspecialchars($cidade);?>" placeholder="Digite a cidade" required readonly>
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="bairro">BAIRRO</label>
                                <input type="text" name="bairro" id="bairro" value="<?php echo htmlspecialchars($bairro);?>" placeholder="Digite o bairro" required readonly>
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="complemento">COMPLEMENTO</label>
                                <input type="text" name="complemento" id="complemento" value="<?php echo htmlspecialchars($complemento);?>" placeholder="Digite o complemento">
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-end">
                            <button name="btn-editar-dados" type="submit" class="btn-editar-dados" id="btn-editar-dados1">Editar Dados</button>
                        </div>                           
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php
    include './../../componentes/footer.php'
?> 