<?php
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/cadastro.css"> <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> <script src="/ReciclaMais/script/cadastro.js" defer></script>';
    include './../../componentes/header.php';

    include './../../../sql/entidades/usuario/Usuario.php';
    include './../../../sql/entidades/usuario/Pessoa_Juridica.php';
    include './../../../sql/entidades/endereco/Endereco.php';
    
    $erros = array();
    $nome = '';
    $cnpj = '';
    $telefone = '';
    $email = '';
    $senha= '';
    $cep = '';
    $tipo_logradouro = '';
    $logradouro = '';
    $numero = '';
    $estado = '';
    $cidade = '';
    $bairro = '';
    $complemento = '';
    if(!empty($_POST)){
        var_dump($_POST);
        if(isset($_POST['btn-parte-1'])){
            $nome = $_POST['nome-empresa'];
            $cnpj = $_POST['cnpj'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
        }
        if(isset($_POST['btn-parte-2'])){
            $cep = $_POST['cep'];
            $tipo_logradouro = $_POST['tpLogradouro'];
            $logradouro = $_POST['$logradouro'];
            $numero = $_POST['numero'];
            $estado = $_POST['uf'];
            $cidade = $_POST['cidade'];
            $bairro = $_POST['bairro'];
            $complemnto = $_POST['complemento'];
        }

        $usuario_existe = Usuario::findByLogin($email);

        if ($usuario_existe == false) { // se não existe
        
            $newEndereco = new Endereco();

            $isValid = $newEndereco->setValues($cep, $logradouro, $tipo_logradouro, $estado, 
                $cidade, $bairro, $numero, $complemento);
         
            /*
            if(isset($isValid['erros'])){
                $erros = $isValid['erros'];
                return;
            }
            
            $isInserted = $newEndereco->insert();

            if($isInserted){
                $endereco_id = $newEndereco->getId();

                $newUsuario = new Usuario();
                $isValid = $newUsuario->setValues($email, $senha, $nome, $telefone);
                if($isValid['erros']){
                    $erros = $isValid['erros'];
                    return;
                }
                $isInserted = $newUsuario->insert();

                if($isInserted){

                    $usuario_id = $newUsuario->getId();
                   
                    $newEmpresa = new Pessoa_Juridica();

                    $newEmpresa->setValuesPJ($cnpj, '', $endereco_id, 1, $usuario_id);
                    $newEmpresa->insert();
                }
            }
            */
        
        }else{
            $erros['erro'] = 'Este usuário já existe!!';
        }
    }
?>
 
<section class="body_content d-flex align-items-center">
    <div class="container h-fit-content d-flex justify-content-center">
        <div class="card px-4 py-3 bg-padrao w-90">
            <form id="form_infos_geral" action="./cadastroEmpresa.php" method="post" class="form-data">
                <div class="container-fluid row">
                    <div id="div-cad-1" class="div-cad-1 d-flex justify-content-between flex-wrap">
                        <div class="mb-3 d-flex flex-column w-100 verde">
                            <label for="nome-empresa">NOME (da empresa)</label>
                            <input value ="recicla"  type="text" class="nome-empresa" name="nome-empresa" id="nome-empresa" placeholder="Digite seu nome empresarial" required>
                        </div>
                        <div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="cnpj">CNPJ</label>
                                <input value ="00000000000191" type="text" name="cnpj" id="cnpj" placeholder="Ex. XX.XXX.XXX/000X-XX" required maxlength="18">
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="telefone">TELEFONE</label>
                                <input value="27995273201" type="text" name="telefone" id="telefone" placeholder="Ex. (XX)XXXX-XXXX" required maxlength=14>
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="email">EMAIL</label>
                                <input value="recicla@gmail.com" type="email" name="email" id="email" placeholder="Digite seu email empresarial" required>
                            </div>
                        </div>
                        <div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="senha">SENHA</label>
                                <div>
                                    <input value="Recicla2023+" class="" type="password" name="senha" id="senha" placeholder="Digite sua senha empresarial" required>
                                    <span class="lnr lnr-eye" type="senha"></span>
                                </div>
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="confirmar-senha">CONFIRME SUA SENHA</label>
                                <div>
                                    <input value="Recicla2023+" class="" type="password" name="confirmar-senha" id="confirmar_senha" placeholder="Confirme sua senha empresarial" required>
                                    <span class="lnr lnr-eye" type="confirmar_senha"></span>
                                </div>
                            </div>
                        </div> 
                        <div class="w-100 d-flex justify-content-end">
                            <button name="btn-parte-1"  class="btn-continuar" id="btn-continuar1">Próxima</button>
                        </div>                           
                    </div>
                    <div id="div-cad-2" class="div-cad-2 d-none flex-wrap justify-content-between">
                        <div class="">
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="cep">CEP</label>
                                <input value="29116150" type="number" name="cep" id="cep" placeholder="Digie seu CEP empresarial" required pattern="\b\d{5}[-.]\d{3}">
                            </div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="tpLogradouro">TIPO LOGRADOURO</label>
                                <select id="tp-logradouro" name="tpLogradouro">
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
                                <input value="225" type="number" name="numero" id="numero" placeholder="Digite o número" required>
                            </div>
                        </div>
                        <div class="">
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="uf">ESTADO</label>
                                <select id="uf" name="uf">
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
                            <button name="btn-parte-2" class="btn-continuar" id="btn-continuar2">Próxima</button>
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
                            <button type="submit" name="btn-cadastro" class="btn-cadastro" form="form_infos_geral">CADASTRAR-SE</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="d-flex mt-3 div-error">
                <ul>
                    <?php 
                        if(!empty($erros)){
                            foreach($erros as $erro){
                                echo "<li> $erro </li>";
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php
    include './../../componentes/footer.php'
?> 