<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mapa</title>

  <!--importando style da página-->

  <!--importando style do icones do bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

  <!--importando style do fontawesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--importando script da página-->

  <!--importando script dos mapas do bing-->
  <script type='text/javascript'
    src='https://www.bing.com/api/maps/mapcontrol?callback=loadMapScenario&key=Agz-GsinzRU8zLEoIGspfeW14MkrCmOv1RXL5foc3GtKtQWkGHydai2rkhG_ZwQu&libs=Microsoft.Maps.Search'></script>

  <!--importando style do bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <!--importando script do bootstrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"
    defer></script> 
</head>

<body>
  <?php
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/mapa.css"> <script src="/ReciclaMais/script/mapa2.js" defer></script>';
    include './componentes/header.php';
  ?>

  <!--section onde o mapa e o menu de pesquisa lateral ficara posicionado-->
  <section id="containerMapa">
    <!--div onde o mapa sera renderizado-->
    <div id="mapa" style="height: 50vh; width:80vh"></div>
    <!--Fim da section-->
  </section>





</body>

</html>