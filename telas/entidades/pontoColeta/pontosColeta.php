<?php
    $css = '<script src="/ReciclaMais/script/map.js" defer></script><link rel="stylesheet" href="/ReciclaMais/css/pontosColeta.css"><link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">';
    include './../../componentes/header.php';
?>
    <section class="body_content">
    <div class="container d-flex info">
        <ion-icon name="filter-outline"></ion-icon>
        <p class="ms-2">FILTRO DOS PONTOS</p>
    </div>
    <div class="row m-0 p-0">
        <div class="container ms-3 me-3 mt-3 checks col-4">
            <p>MATERIAIS QUE VOCÊ IRÁ DESCARTAR</p>
            <div class="container mt-2">
                <form action="">
                    <fieldset>
                        <input type="checkbox" name="" id="" value="VIDRO"><span>VIDRO</span><br>
                        <input type="checkbox" name="" id="" value="PLÁSTICO"><span>PLÁSTICO</span><br>
                        <input type="checkbox" name="" id="" value="MADEIRA"><span>MADEIRA</span><br>
                        <input type="checkbox" name="" id="" value="ELETRÔNICO"><span>ELETRÔNICO</span><br>
                        <input type="checkbox" name="" id="" value="METAIS"><span>METAIS</span><br>
                        <input type="checkbox" name="" id="" value="PAPEL"><span>PAPEL</span><br>
                        <input type="checkbox" name="" id="" value="ORGÂNICO"><span>ORGÂNICO</span><br>
                        <input type="checkbox" name="" id="" value="HOSPITALAR"><span>HOSPITALAR</span><br>
                    </fieldset>
                </form>
            </div>
            <p class="mt-3">DISTÂNCIA DO PONTO DE COLETA</p>
            <div class="container mt-2">
                <form action="">
                    <fieldset>
                        <input type="checkbox" name="" id="" value="3"><span>até 3KM</span><br>
                        <input type="checkbox" name="" id="" value="7"><span>até 7KM</span><br>
                        <input type="checkbox" name="" id="" value="12"><span>até 12KM</span><br>
                        <input type="checkbox" name="" id="" value="+12"><span>+12KM</span><br>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="container col-5 maps">
            <div id="map"></div>
        </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</section>
<?php
    include './../../componentes/footer.php'
?>