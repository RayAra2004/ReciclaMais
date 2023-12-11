<?php
  $css = '<link rel="stylesheet" href="/ReciclaMais/css/mapa.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <script src="/ReciclaMais/script/mapa2.js" defer></script>
  <script src="http://www.bing.com/api/maps/mapcontrol?callback=getMap" async></script>';

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
      //var_dump($materiais);

      //echo json_encode(["materiais" => $materiais]);
      


      
      

      /*ponto_icone_bronze
      ponto_icone_dourado
      ponto_icone_prata*/

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

  //var_dump($dicioPontosMapa);

  if (!(isset($_SESSION['comp_header']))){
    $_SESSION['comp_header'] = '<a class="btn temaGreen" href="/ReciclaMais/telas/entidades/login/login.php" role="button">Entrar</a>';
  }

  echo "<div id='listPntos'>";
  echo json_encode($dicioPontosMapa);
  echo "</div>";
  
  
?>
<section id="containerMapa">
  <!--<div id="divtot">-->
  
  <!--</div>-->
  
  <div id="map">
    <div id="divzada">
      <button id="btnClose">X</button>
      <img id="imgPonto" src="" alt="">
      <p id="ponto_title" class="ms-1"></p>
      <div class = "d-flex ms-1 my-2 text-center">
        <a id="link_rota" class="text-decoration-none text-dark ms-4 me-5" href="https://www.google.com/maps/place/" target="_blank">
          <button class="rounded-circle link_btn">
            <span class="material-symbols-outlined">
              fork_right
            </span>
          </button>
          <p>Rotas</p>
        </a>
        <a id="link_ponto" class="text-decoration-none text-dark" href="https://www.google.com/maps/place/" target="_blank">
          <button class="rounded-circle link_btn">
            <span class="material-symbols-outlined">
              info
            </span>
          </button>
          <p>Mais info</p>
        </a>
      </div>
      <p id="ponto_endereco" class="ms-1 mb-1"></p>
      <p id="ponto_telefone" class="ms-1 mb-1"></p>
    </div>
    <div class="options">
      <div id="closedFilter" class="rounded-circle">
        <span class="material-symbols-outlined">
          filter_alt
        </span>
      </div>
      <div id="openedFilter" class="">
        <p>Filtrar por:</p>
        <div><button class="filterClassButton">Plástico</button></div>
        <div><button class="filterClassButton">Papel</button></div>
        <div><button class="filterClassButton">Vidro</button></div>
        <div><button class="filterClassButton">Metal</button></div>
        <div><button class="filterClassButton">Orgânico</button></div>
        <div><button class="filterClassButton">Hospitalar</button></div>
        <div><button class="filterClassButton">Madeira</button></div>
        <div><button class="filterClassButton">Eletrônicos</button></div>
        <div><button class="filterClassButton">Nenhum</button></div>
      </div>
      <input class="search_input" placeholder="Search">
      <button class="search_btn">Search</button>
    </div>
  </div>
</section>
<?php
    include '../../componentes/footer.php'
?>    