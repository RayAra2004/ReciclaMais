<?php
    session_start();
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/cadastro.css"> <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> <script src="./../script/cadastro.js" defer></script>';
    include './componentes/header.php';
?>

<?php
    $erros = array();

    if(isset($_POST["btn-cadastro"])){ 
        $nome_empresa = $_POST["nome-empresa"];
        $cnpj = $_POST["cnpj"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $cep = $_POST["cep"];
        $tp_logradouro = $_POST["tp-logradouro"];
        $logradouro = $_POST["logradouro"];
        $numero = $_POST["numero"];
        $uf = $_POST["uf"];
        $cidade = $_POST["cidade"];
        $bairro = $_POST["bairro"];
        $complemento = $_POST["complemento"];

        $formatName = array("options" => array("regexp" => "/([\wÀ-ÿ&-0-9])/"));
        //sanitização de string
        if(! filter_var($nome_empresa, FILTER_VALIDATE_REGEXP, $formatName)){
            $erros[] = "Nome inválido";
        }

        $formatCNPJ = array("options" => array("regexp" => "/^\d{2}.\d{3}.\d{3}\/\d{4}-\d{2}$/"));
        //sanitização de numeros only
        if(! filter_var($cnpj, FILTER_VALIDATE_REGEXP, $formatCNPJ)){
            $erros[] = "CNPJ inválido";
        }

        $formatTelemovel = array("options" => array("regexp" => "/([(][0-9]{2}[)])[0-9]{5}\-[0-9]{4}%/"));
        //sanitização de numeros only
        if(! filter_var($telefone, FILTER_VALIDATE_REGEXP, $formatTelemovel)){
            $erros[] = "Telefone inválido";
        }

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);// TODO: Não está funcionando
        if(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
            $erros[] = "Email inválido";
        }

        $formatPassword = array("options" => array("regexp" => "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/"));
        if(! filter_var($senha, FILTER_VALIDATE_REGEXP, $formatPassword)){
            $erros[] = "Senha inválida";
        }

        $formatCEP = array("options" => array("regexp" => "/([(][0-9]{2}[)])[0-9]{5}\-[0-9]{4}%/"));
        //sanitização de numeros only
        if(! filter_var($cep, FILTER_VALIDATE_REGEXP, $formatCEP)){
            $erros[] = "CEP inválido";
        }

        $formatLogradouro = array("options" => array("regexp" => "/([\wÀ-ÿ&-0-9])/"));
        if(! filter_var($logradouro, FILTER_VALIDATE_REGEXP, $formatLogradouro)){
            $erros[] = "Logradouro inválido";
        }

        $formatNumero = array("options" => array("regexp" => "/[0-9]/"));
        //sanitização de numeros only
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
        $formatComplemento = array("options" => array("regexp" => "/([\wÀ-ÿ&-0-9])/"));
        //sanitização sem caracteres especiais
        if(! filter_var($complemento, FILTER_VALIDATE_REGEXP, $formatComplemento)){
            $erros[] = "Complemento inválido";
        }
        
        if(empty($erros)){
            header('Location: /ReciclaMais/telas/login.php');
        }
    }
?>

    
<section class="body_content d-flex align-items-center">
    <div class="container h-fit-content d-flex justify-content-center">
        <div class="card px-4 py-3 bg-padrao w-90">
            <form id="form_infos_geral" action="cadastro.php" method="post" class="form-data">
                <div class="container-fluid row">
                    <div id="div-cad-1" class="div-cad-1 d-flex justify-content-between flex-wrap">
                        <div class="mb-3 d-flex flex-column w-100 verde">
                            <label for="nome-empresa">NOME (da empresa)</label>
                            <input type="text" class="nome-empresa" name="nome-empresa" id="nome-empresa" placeholder="Digite seu nome empresarial" required>
                        </div>
                        <div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="cnpj">CNPJ</label>
                                <input type="text" name="cnpj" id="cnpj" placeholder="Ex. XX.XXX.XXX/000X-XX" required maxlength="18">
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="telefone">TELEFONE</label>
                                <input type="text" name="telefone" id="telefone" placeholder="Ex. (XX)XXXX-XXXX" required maxlength=14>
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="email">EMAIL</label>
                                <input type="email" name="email" id="email" placeholder="Digite seu email empresarial" required>
                            </div>
                        </div>
                        <div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="senha">SENHA</label>
                                <div>
                                    <input class="" type="password" name="senha" id="senha" placeholder="Digite sua senha empresarial" required>
                                    <span class="lnr lnr-eye" type="senha"></span>
                                </div>
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="confirmar-senha">CONFIRME SUA SENHA</label>
                                <div>
                                    <input class="" type="password" name="confirmar-senha" id="confirmar_senha" placeholder="Confirme sua senha empresarial" required>
                                    <span class="lnr lnr-eye" type="confirmar_senha"></span>
                                </div>
                            </div>
                        </div> 
                        <div class="w-100 d-flex justify-content-end">
                            <button type="submit" class="btn-continuar" id="btn-continuar1">Próxima</button>
                        </div>                           
                    </div>
                    <div id="div-cad-2" class="div-cad-2 d-none flex-wrap justify-content-between">
                        <div class="">
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="cep">CEP</label>
                                <input type="number" name="cep" id="cep" placeholder="Digie seu CEP empresarial" required pattern="\b\d{5}[-.]\d{3}">
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="tp-logradouro">TIPO LOGRADOURO</label>
                                <select id="tp_logradouro" name="tp-logradouro" disabled>
                                    <option value=""></option>
                                    <option value="aeroporto">aeroporto</option>
                                    <option value="alameda">alameda</option>
                                    <option value="area">área</option>
                                    <option value="avenida">avenida</option>
                                    <option value="campo">campo</option>
                                    <option value="chacara">chácara</option>
                                    <option value="colonia">colônia</option>
                                    <option value="condominio">condomínio</option>
                                    <option value="conjunto">conjunto</option>
                                    <option value="distrito">distrito</option>
                                    <option value="esplanada">esplanada</option>
                                    <option value="estacao">estação</option>
                                    <option value="estrada">estrada</option>
                                    <option value="favela">favela</option>
                                    <option value="fazenda">fazenda</option>
                                    <option value="feira">feira</option>
                                    <option value="jardim">jardim</option>
                                    <option value="ladeira">ladeira</option>
                                    <option value="lago">lago</option>
                                    <option value="lagoa">lagoa</option>
                                    <option value="largo">largo</option>
                                    <option value="loteamento">loteamento</option>
                                    <option value="morro">morro</option>
                                    <option value="nucleo">núcleo</option>
                                    <option value="parque">parque</option>
                                    <option value="passarela">passarela</option>
                                    <option value="patio">pátio</option>
                                    <option value="praca">praça</option>
                                    <option value="quadra">quadra</option>
                                    <option value="recanto">recanto</option>
                                    <option value="residencial">residencial</option>
                                    <option value="rodovia">rodovia</option>
                                    <option value="rua">rua</option>
                                    <option value="setor">setor</option>
                                    <option value="sitio">sítio</option>
                                    <option value="travessa">travessa</option>
                                    <option value="trecho">trecho</option>
                                    <option value="trevo">trevo</option>
                                    <option value="vale">vale</option>
                                    <option value="vereda">vereda</option>
                                    <option value="via">via</option>
                                    <option value="viaduto">viaduto</option>
                                    <option value="viela">viela</option>
                                    <option value="vila">vila</option>
                                </select>                                    
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="logradouro">LOGRADOURO</label>
                                <input type="text" name="logradouro" id="logradouro" placeholder="Digite seu logradouro empresarial" required readonly>
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="numero">NÚMERO</label>
                                <input type="number" name="numero" id="numero" placeholder="Digite o número" required>
                            </div>
                        </div>
                        <div class="">
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="uf">ESTADO</label>
                                <select id="uf" name="uf" disabled>
                                    <option value=""></option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="cidade">CIDADE</label>
                                <input type="text" name="cidade" id="cidade" placeholder="Digite a cidade" required readonly>
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="bairro">BAIRRO</label>
                                <input type="text" name="bairro" id="bairro" placeholder="Digite o bairro" required readonly>
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="complemento">COMPLEMENTO</label>
                                <input type="text" name="complemento" id="complemento" placeholder="Digite o complemento">
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-end">
                            <button type="submit" class="btn-continuar" id="btn-continuar2">Próxima</button>
                        </div>
                    </div>               
                    <div id="div-cad-3" class="div-cad-3 d-none justify-content-center aling-items-center flex-wrap">
                        <div class="d-flex flex-column justify-content-center aling-items-center w-100">
                            <span class="">QUAIS MATERIAIS SUA EMPRESA RECICLA?</span>
                            <div class="w-100 d-flex mt-3">
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'eletronicos')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_eletronicos.svg" alt="">
                                </div>
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'hospitalar')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_hospitalar.svg" alt="">
                                </div>
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'madeira')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_madeira.svg" alt="">
                                </div>
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'metal')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_metal.svg" alt="">
                                </div>
                            </div>
                            <div class="w-100 d-flex mt-3">
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'organico')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_organico.svg" alt="">
                                </div>
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'papel')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_papel.svg" alt="">
                                </div>
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'plastico')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_plastico.svg" alt="">
                                </div>
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'vidro')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_vidro.svg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-end">
                            <button click="submit" name="btn-cadastro" class="btn-cadastro" form="form_infos_geral">CADASTRAR-SE</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="d-flex mt-3 div-error">
                <?php 
                    if(!empty($erros)){
                        foreach($erros as $erro){
                            echo "<li> $erro </li>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
    include './componentes/footer.php'
?> 