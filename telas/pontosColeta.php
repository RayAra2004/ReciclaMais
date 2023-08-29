<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/pontosColeta.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

 
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js" defer></script>
    
    
    <script src="./../script/map.js" defer></script>

    <title>Pontos Coleta</title>
</head>
<body onload="header()">
    <header id="cabecalho"></header>
    <div class="container d-flex info">
        <ion-icon name="filter-outline"></ion-icon>
        <p class="ms-2">FILTRO DOS PONTOS</p>
    </div>
    <div class=" row m-0 p-0">
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
        <div class="col-5 maps">
            
        </div>
    </div>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</body>
</html>