<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" defer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/ranking.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./../css/geral.css">
    <script src="../script/cabecalho/geral.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js" defer></script>
    <script src="./../script/componentes/CardRanking.js" defer></script>
    
    <title>Aprender a reciclar</title>
</head>
<body onload="header(); footer()">
    <header id="cabecalho"></header>
    <div class="container row m-auto">
        <p class="text-center text-white my-4">RANKING</p>
        <div class="p-0 d-flex flex-desktop">
            <div id="ranking1" class="container col-6 d-flex flex-column flex-wrap align-content-center"></div>
            <div id="ranking2" class="container col-6 d-flex flex-column flex-wrap align-content-center"></div>
        </div>
        
    </div>
    <div id="rodape" class="p-0 container-fluid"></div>
</body>
</html>