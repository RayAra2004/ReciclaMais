<?php
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/mudarDadosEmpresariais.css"> <script src="/ReciclaMais/script/mudarDados.js" defer></script>';
    include './../../componentes/header.php';
    include './../../../sql/entidades/usuario/Usuario.php';
    
    $email = $_SESSION['email'];

    $usuario = Usuario::findByLogin($email);

    $nome = $usuario["nome"];
    $telefone = $usuario["telefone"];

    
    if(!empty($_POST)){
        $novoNome = $_POST["nome-empresa"];
        $novoTelefone = $_POST["telefone"];
        $novaSenha = $_POST["senha"];

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
                        <div class="mb-3 d-flex flex-column w-100 verde">
                            <label for="nome-empresa">NOME (da empresa)</label>
                            <input value ="<?php echo htmlspecialchars($nome);?>" type="text" class="nome-empresa" name="nome-empresa" id="nome-empresa" placeholder="Digite seu nome empresarial" required>
                        </div>
                        <div>
                            <div class="mb-3 d-flex flex-column verde">
                                <label for="telefone">TELEFONE</label>
                                <input value="<?php echo htmlspecialchars($telefone);?>" type="text" name="telefone" id="telefone" placeholder="Ex. (XX)XXXX-XXXX" required maxlength=14>
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