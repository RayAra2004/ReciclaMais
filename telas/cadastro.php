<?php 
    $css = '<link rel="stylesheet" href="../css/cadastro.css"> <script src="./../script/cadastro.js" defer></script>';
    include './componentes/header.php';
?>    
    
<section class="body_content">
    <div class="container mt-5">
        <div class="card px-4 py-3 bg-padrao">
            <form id="form_infos_geral" class="form-data">
                <div class="container-fluid row">
                    <div class="">
                        <div class="mb-3 d-flex flex-column verde">
                            <label for="nome_empresa">NOME DA EMPRESA</label>
                            <input type="text" name="nome_empresa" id="nome_empresa" placeholder="Digite seu nome empresarial" required>
                        </div>
                        <div class="mb-3 d-flex flex-column verde">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" name="cnpj" id="cnpj" placeholder="Ex. XX.XXX.XXX/000X-XX" required pattern="^\d{2}.\d{3}.\d{3}\/\d{4}-\d{2}$">
                        </div>
                        <div class="mb-3 d-flex flex-column verde">
                            <label for="telefone">TELEFONE</label>
                            <input type="text" name="telefone" id="telefone" placeholder="Ex. (XX)XXXX-XXXX" required pattern="([(][0-9]{2}[)])[0-9]{5}\-[0-9]{4}%">
                        </div>
                        <div class="mb-3 d-flex flex-column verde">
                            <label for="email">EMAIL</label>
                            <input type="email" name="email" id="email" placeholder="Digite seu email empresarial" required pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?">
                        </div>
                        <div class="mb-3 d-flex flex-column verde">
                            <label for="senha">SENHA</label>
                            <div>
                                <input class="" type="password" name="senha" id="senha" placeholder="Digite sua senha empresarial" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$">
                                <span class="lnr lnr-eye" type="senha"></span>
                            </div>
                        </div>
                        <div class="mb-3 d-flex flex-column verde">
                            <label for="confirmar_senha">CONFIRME SUA SENHA</label>
                            <div>
                                <input class="" type="password" name="confirmar_senha" id="confirmar_senha" placeholder="Confirme sua senha empresarial" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$">
                                <span class="lnr lnr-eye" type="confirmar_senha"></span>
                            </div>
                        </div>
                         
                        <!-- <div class="mb-3 d-flex flex-column verde">
                            <label for="cep">CEP</label>
                            <input type="number" name="cep" id="cep" placeholder="Digie seu CEP empresarial" required pattern="\b\d{5}[-.]\d{3}">
                        </div>              
                    </div>
                    <div class="col-lg-4">                      
                        <div class="mb-3 d-flex flex-column verde">
                            <label for="tp_logradouro">TIPO LOGRADOURO</label>
                            <select id="tp_logradouro" name="tp_logradouro">
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
                            <input type="text" name="logradouro" id="logradouro" placeholder="Digite seu logradouro empresarial" required>
                        </div>
                        <div class="mb-3 d-flex flex-column verde">
                            <label for="numero">NÚMERO</label>
                            <input type="number" name="numero" id="numero" placeholder="Digite o número" required>
                        </div>
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
                            <input type="text" name="cidade" id="cidade" placeholder="Digite a cidade" required>
                        </div>
                        <div class="mb-3 d-flex flex-column verde">
                            <label for="bairro">BAIRRO</label>
                            <input type="text" name="bairro" id="bairro" placeholder="Digite o bairro" required>
                        </div>
                        <div class="mb-3 d-flex flex-column verde">
                            <label for="complemento">COMPLEMENTO</label>
                            <input type="text" name="complemento" id="complemento" placeholder="Digite o complemento">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <span>MATERIAIS QUE VOCÊ IRÁ DESCARTAR</span>
                        <fieldset>
                            <input type="radio" name="select_vidro" id="select_vidro" required value="VIDRO"><span> VIDRO</span><br>
                            <input type="radio" name="select_plastico" id="select_plastico" required value="PLÁSTICO"><span> PLÁSTICO</span><br>
                            <input type="radio" name="select_madeira" id="select_madeira" required value="MADEIRA"><span> MADEIRA</span><br>
                            <input type="radio" name="select_eletronico" id="select_eletronico" required value="ELETRÔNICO"><span> ELETRÔNICO</span><br>
                            <input type="radio" name="select_metais" id="select_metais" required value="METAIS"><span> METAIS</span><br>
                            <input type="radio" name="select_papel" id="select_papel" required value="PAPEL"><span> PAPEL</span><br>
                            <input type="radio" name="select_organico" id="select_organico" required value="ORGÂNICO"><span> ORGÂNICO</span><br>
                            <input type="radio" name="select_hospitalar" id="select_hospitalar" required value="HOSPITALAR"><span> HOSPITALAR</span><br>
                        </fieldset>
                        <button type="submit" class="btn-cadastro" form="form_infos_geral">CADASTRAR-SE</button>
                    </div> -->
                </div>
            </form>
        </div>
    </div>
</section>
<?php
    include './componentes/footer.php'
?> 