<?php
  if (!(isset($_SESSION['comp_header']))){
    $_SESSION['comp_header'] = '<a class="btn temaGreen" href="/ReciclaMais/telas/entidades/login/login.php" role="button">Entrar</a>';
  }
  
  $css = '<link rel="stylesheet" href="/ReciclaMais/css/mapa.css">
    <script src="/ReciclaMais/script/mapa2.js" defer></script>
    <script src="http://www.bing.com/api/maps/mapcontrol?callback=getMap" async></script>';
  include '../componentes/header.php';
?>
<section id="containerMapa">
  <div class="options">
      <input class="search_input" placeholder="Search">
      <button class="search_btn">Search</button>
  </div>
  <div id="map"></div>
</section>
<?php
    include '../componentes/footer.php'
?>    