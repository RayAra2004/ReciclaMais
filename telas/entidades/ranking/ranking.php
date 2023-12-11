<?php 
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/ranking.css">';
    include './../../componentes/header.php';
    include './../../../sql/entidades/pontoColeta/PontoColeta.php';
  
    $dicioPontos = PontoColeta::findAllPontosColetaMapa();
    $dicioPontosMapa = [];
    foreach($dicioPontos as $ponto){
        switch (true) {
            case ((str_split($ponto["media"],3)[0])>3) and ((str_split($ponto["media"],3)[0])<4):
            $icon = "ponto_icone_prata";
            break;
            case (str_split($ponto["media"],3)[0])>=4:
            $icon = "ponto_icone_dourado";
            break;
            default:
                $icon = "ponto_icone_bronze";
            };
            
            $string = $ponto["materiais_reciclados"];

            $json = json_decode($string);

            $materiais = [];
            foreach ($json as $objeto) {
                $materiais[] = $objeto->id;
            }
            
            $materiais = array_unique($materiais);

        $dicioPontosMapa[$ponto["latitude"] . "," . $ponto["longitude"]] = [
            "title" => $ponto["nome"],
            "icon" => "/ReciclaMais/imgs/" . $icon . ".svg",
            "img" => $ponto["imagem"],
            "cep" => $ponto["cep"],
            "logradouro" => $ponto["logradouro"],
            "numero" => $ponto["numero"],
            "estado" => $ponto["estado"],
            "cidade" => $ponto["cidade"],
            "bairro" => $ponto["bairro"],
            "tipo_logradouro" => $ponto["tipo_logradouro"],
            "media" => str_split($ponto["media"],3)[0],
            "id" => $ponto["id"],
            "telefone" => $ponto["telefone"],
            "materiais_reciclados" => $materiais
        ];
    };
?>
<section class="body_content">
    <div class="container row mx-auto">
        <p class="text-center text-white my-4">RANKING</p>
        <div class="p-0 d-flex flex-desktop">
            <div id="ranking1" class="container d-flex flex-column flex-wrap align-content-center">
                <?php 
                    foreach ($dicioPontosMapa as $pontoColeta) {
                        echo '
                            <div class="card mb-3 ranking-empresa">
                                <div class="row g-0">
                                    <div class="col-md-4 img-empresa">
                                        <img src="' . $pontoColeta["img"] . '" class="img-empresa img-fluid rounded-start">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-header">
                                            <h5 class="card-title">' . $pontoColeta["title"] . '</h5>
                                        </div>
                                        <div class="card-body d-flex mt-3 infos-card">
                                            <p class="card-text d-flex">
                                                <ion-icon class="" name="pint-outline"></ion-icon>
                                                <ion-icon class="ms-3" name="star"></ion-icon>
                                                <span>' . $pontoColeta["media"] . '/5</span>
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