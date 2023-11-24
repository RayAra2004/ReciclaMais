<?php 
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/ranking.css">';
    include './../../componentes/header.php';
    include './../../../sql/entidades/pontoColeta/PontoColeta.php';

    $pontosColeta = PontoColeta::findAllPontosColeta();
?>
<section class="body_content">
    <div class="container row mx-auto">
        <p class="text-center text-white my-4">RANKING</p>
        <div class="p-0 d-flex flex-desktop">
            <div id="ranking1" class="container d-flex flex-column flex-wrap align-content-center">
                <?php 
                    foreach ($pontosColeta as $pontoColeta) {
                        echo '
                            <div class="card mb-3 ranking-empresa">
                                <div class="row g-0">
                                    <div class="col-md-4 img-empresa">
                                        <img src="' . $pontoColeta["imagem"] . '" class="img-empresa img-fluid rounded-start">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-header">
                                            <h5 class="card-title">' . $pontoColeta["nome"] . '</h5>
                                        </div>
                                        <div class="card-body d-flex mt-3 infos-card">
                                            <p class="card-text d-flex">
                                                <ion-icon class="" name="pint-outline"></ion-icon>
                                                <ion-icon class="ms-3" name="star"></ion-icon>
                                                <span>4.8/5</span>
                                                <a href="./../pontoColeta/descricaoPonto.php?id=' . $pontoColeta["id"] . '">
                                                    <button class="btn-infos ms-3">Ver mais</button>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>
        
    </div>
</section>
<?php
    include './../../componentes/footer.php';
?>