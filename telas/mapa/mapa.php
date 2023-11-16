<?php
  if (!(isset($_SESSION['comp_header']))){
    $_SESSION['comp_header'] = '<a class="btn temaGreen" href="/ReciclaMais/telas/entidades/login/login.php" role="button">Entrar</a>';
  }

  $dicionario = [];

  // Adicionando o primeiro item ao dicionário
  $dicionario["-20.197329691804068, -40.2170160437478"] = [
      "title" => "Ifes Campus Serra",
      "icon" => "/ReciclaMais/imgs/silver_pin.svg"
  ];

  // Adicionando o segundo item ao dicionário
  $dicionario["-20.199232504534884, -40.227077110956316"] = [
      "title" => "Hospital Jayme dos Santos Neves",
      "icon" => "/ReciclaMais/imgs/silver_pin.svg"
  ];

  // Adicionando o terceiro item ao dicionário
  $dicionario["-20.19826402415827, -40.224856532079116"] = [
      "title" => "Café Arrumado",
      "icon" => "/ReciclaMais/imgs/silver_pin.svg"
  ];
  echo json_encode($dicionario);
  
  $css = '<link rel="stylesheet" href="/ReciclaMais/css/mapa.css">
    <script src="/ReciclaMais/script/mapa2.js" defer></script>
    <script src="http://www.bing.com/api/maps/mapcontrol?callback=getMap" async></script>';
  include '../componentes/header.php';
?>
<section id="containerMapa">
  <p id="listPontos"></p>
  <!--<div id="divtot">-->
    <div id="divzada">
      <button id="btnClose">X</button>
      <img id="imgPonto" src="/ReciclaMais/imgs/arvores_home.jpg" alt="">
      <p id="text1"></p>
    </div>
  <!--</div>-->
  <div class="options">
      <input class="search_input" placeholder="Search">
      <button class="search_btn">Search</button>
  </div>
  <div id="map"></div>
</section>
<?php
    include '../componentes/footer.php'
?>    