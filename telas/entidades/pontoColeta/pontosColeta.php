<?php
  $css = '<link rel="stylesheet" href="/ReciclaMais/css/mapa.css">
  <script src="/ReciclaMais/script/mapa2.js" defer></script>
  <script src="http://www.bing.com/api/maps/mapcontrol?callback=getMap" async></script>';

  include './../../componentes/header.php';
  include './../../../sql/entidades/pontoColeta/PontoColeta.php';
  
  $dicioPontos = PontoColeta::findAllPontosColetaMapa();
  //var_dump($dicioPontos);
  
  $dicioPontosMapa = [];

  foreach($dicioPontos as $ponto){
    $dicioPontosMapa[$ponto["latitude"] . "," . $ponto["longitude"]] = [
      "title" => $ponto["nome"],
      "icon" => "/ReciclaMais/imgs/silver_pin.svg",
      "img" => $ponto["imagem"],
      "cep" => $ponto["cep"],
      "logradouro" => $ponto["logradouro"],
      "numero" => $ponto["numero"],
      "estado" => $ponto["estado"],
      "cidade" => $ponto["cidade"],
      "bairro" => $ponto["bairro"],
      "tipo_logradouro" => $ponto["tipo_logradouro"],
      "media" => $ponto["media"]
    ];
  };

  var_dump($dicioPontosMapa);

  if (!(isset($_SESSION['comp_header']))){
    $_SESSION['comp_header'] = '<a class="btn temaGreen" href="/ReciclaMais/telas/entidades/login/login.php" role="button">Entrar</a>';
  }

  echo "<div id='listPntos'>";
  echo json_encode($dicioPontosMapa);
  echo "</div>";
  
  
?>
<section id="containerMapa">
  <!--<div id="divtot">-->
    <div id="divzada">
      <button id="btnClose">X</button>
      <img id="imgPonto" src="/ReciclaMais/imgs/arvores_home.jpg" alt="">
      <p id="ponto_title"></p>
      <a id="link_ponto" href="https://www.google.com/maps/place/" target="_blank">
          <button>TRAGETÓRIA ATÉ O PONTO</button>
      </a>
      <p id="ponto_endereco"></p>
    </div>
  <!--</div>-->
  <div class="options">
      <div id="closedFilter">Filtros</div>
      <div id="openedFilter">Filtros</div>
      <input class="search_input" placeholder="Search">
      <button class="search_btn">Search</button>
  </div>
  <div id="map"></div>
</section>
<?php
    include '../../componentes/footer.php'
?>    