<?php 
    $css = '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="/ReciclaMais/css/descricaoPonto.css"> <script src="/ReciclaMais/script/componentes/Comentario.js" defer></script>';
    include './../../componentes/header.php';
    include './../../../sql/entidades/pontoColeta/PontoColeta.php';
    include './../../../sql/entidades/endereco/Endereco.php';
    include './../../../sql/entidades/usuario/Usuario.php';

    //coletando dados do ponto de coleta selecionado
    $id_pontoColeta = $_GET['id'];
    $newPontoColeta = new PontoColeta();
    $pontoColeta = $newPontoColeta->find($id_pontoColeta);
    $quero = PontoColeta::findByIdPontosColetaMapa($id_pontoColeta);
    $newUsuario = new Usuario();
    $usuario = $newUsuario->find($pontoColeta["fk_usuario_id"]);
    $endereco = Endereco::getDados($pontoColeta["fk_endereco_id"]);
    $tipo_logradouro = ucfirst($endereco["tipo_logradouro"]);
    $cep = substr_replace($endereco["cep"], '-', -3, 0);
    $telefone = substr_replace($pontoColeta["telefone"], '(', 0, 0);
    $telefone = substr_replace($telefone, ') ', 3, 0);
    if(strlen($pontoColeta["telefone"]) == 11){
        $telefone = substr_replace($telefone, '-', 10, 0);
    }else{
        $telefone = substr_replace($telefone, '-', 9, 0);
    }
    //dados do ponto de coleta coletados e devidamente tratados
    //echo '<ion-icon name="star" class"display-1"></ion-icon>';
?>
<section class="body_content">
    <div class="container d-flex flex-wrap flex-column align-content-center pt-4">
        <div class="container d-flex justify-content-center">
            <p>INFORMAÇÕES DO PONTO SELECIONADO</p>
        </div>
        <div class="divPontuacao">
            <div class="pontuacao d-flex justify-content-start pt-1">
                <ion-icon class="estrela" name="star"></ion-icon>
                <p class="mt-1"><?php echo (str_split($quero[0]["media"],3)[0]); ?>/5.0</p>
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <img class="img-fluid w-25" src="<?php echo $pontoColeta["imagem"];?>" alt="">
        </div>
        <div class="container text-center mt-3 pt-5 infos-gerais">
            <p>NOME: <?php echo $pontoColeta["nome"];?></p>
            <p>ENDEREÇO:</p>
            <p><?php echo $tipo_logradouro;?> <?php echo $endereco["logradouro"];?>, 
                <?php echo $endereco["numero"];?> - <?php echo $endereco["bairro"];?>, 
                <?php echo $endereco["cidade"];?> - <?php echo $endereco["estado"];?>,
                <br> <?php echo $cep;?>
            </p>
            <br> <br>
            <p>TELEFONE: <?php echo $telefone;?></p>
        </div>
        <div class="container mt-4 comentarios">
            <?php
                $listaComentarios = PontoColeta::getComentarios("1", "10", "0");
                foreach($listaComentarios as $comentario){
                    echo '<div class="comentario-user row mt-3">
                            <div class="perfil-comentario ms-3 col-3 d-flex justify-content-center align-items-center">
                                <p>' . $comentario["nome"] . '</p>
                            </div>
                            <div class="container col-8 mt-5">
                                <div class="avaliacao-user">
                                    <div class="d-flex justify-content-center">
                                        <ion-icon class="estrela" name="star-outline"></ion-icon>
                                        <ion-icon class="estrela" name="star-outline"></ion-icon>
                                        <ion-icon class="estrela" name="star-outline"></ion-icon>
                                        <ion-icon class="estrela" name="star-outline"></ion-icon>
                                    </div>
                                </div>
                                <span>' . $comentario["conteudo"] . '</span>
                            </div>
                        </div>';
                };
            ?>
        </div>
        <div class="container mt-5 mb-5 abrir-maps d-flex justify-content-center">
            <a href="https://www.google.com/maps/place/<?php echo $endereco["latitude"];?>, <?php echo $endereco["longitude"];?>" target="_blank">
                <button>TRAGETÓRIA ATÉ O PONTO</button>
            </a>
        </div>
    </div>
</section>
<?php
    include './../../componentes/footer.php'
?> 