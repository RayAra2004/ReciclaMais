<?php
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/mudarDadosEmpresariais.css"> <script src="/ReciclaMais/script/mudarDados.js" defer></script>';
    include './../../componentes/header.php';
    include './../../../sql/entidades/usuario/Usuario.php';
    include './../../../sql/entidades/pontoColeta/PontoColeta.php';
    
    $erros = "";
    $email = $_SESSION['email'];

    $usuario = Usuario::findByLogin($email);

    $usuario_id = $usuario["id"];

    $newPontoColeta = new PontoColeta();
    $pontoColeta = $newPontoColeta->findByUser($usuario_id);

    $materiais = $newPontoColeta->getMateriaisReciclados($pontoColeta["id"]);
    
    $materiaisSelecionados = "";

    foreach($materiais as $material){
        $materiaisSelecionados .= $material["descricao"] . ";";
    }

    $materiaisSelecionados = rtrim($materiaisSelecionados, ';');

    if(!empty($_POST)){
        $newMateriais = explode(';', $_POST['novos_materiais_selecionados']);
        array_pop($newMateriais);

        var_dump($newMateriais);
    }
    
?>

<section class="body_content">
    <div class="container h-fit-content d-flex justify-content-center">
        <div class="card px-4 py-3 bg-padrao w-90">
            <form action="./mudarMateriaisReciclados.php" method="post" class="form-data">
                <div class="container-fluid row">
                    <div id="div-cad-1" class="div-cad-1 d-flex justify-content-between flex-wrap">
                    <div class="d-flex flex-column justify-content-center aling-items-center w-100">
                            <span class="">QUAIS MATERIAIS SUA EMPRESA RECICLA?</span>
                            <div class="w-100 d-flex flex-wrap mt-3">
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'Eletrônicos')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_eletronicos.svg" alt="Eletrônicos">
                                </div>
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'Hospitalar')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_hospitalar.svg" alt="Hospitalar">
                                </div>
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'Madeira')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_madeira.svg" alt="Madeira">
                                </div>
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'Metal')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_metal.svg" alt="Metal">
                                </div>
                            </div>
                            <div class="w-100 d-flex flex-wrap mt-3">
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'Orgânico')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_organico.svg" alt="Orgânico">
                                </div>
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'Papel')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_papel.svg" alt="Papel">
                                </div>
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'Plástico')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_plastico.svg" alt="Plástico">
                                </div>
                                <div class="div-trash">
                                    <img onclick="selecionar(this, 'Vidro')" class="img-fluid" src="/ReciclaMais/imgs/lixeira_vidro.svg" alt="Vidro">
                                </div>
                            </div>
                        </div>
                        <div id="materiaisSelecionados">
                            <input type="text" id="materiaisInput" name="materiais_selecionados" value="<?php echo htmlspecialchars($materiaisSelecionados)?>">
                            <input type="text" id="newMateriaisInput" name="novos_materiais_selecionados">
                        </div>
                        <div class="w-100 d-flex justify-content-end">
                            <button name="btn-editar-dados" type="submit" class="btn-editar-dados" id="btn-editar-dados3">Editar Dados</button>
                        </div> 
                    </div>
                </div>
            </form>
            <?php if (!empty($erros)) : ?>
                <div id="modalErro" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Erro no Login</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><?= $erros ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Exibe o modal automaticamente quando há um erro
        <?php if (!empty($erros)) : ?>
            $(document).ready(function () {
                $('#modalErro').modal('show');
            });
        <?php endif; ?>
    </script>
</section>
<?php
    include './../../componentes/footer.php'
?> 