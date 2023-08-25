<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recicla +</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/geral.css">
    <link rel="stylesheet" href="./css/index.css">
    <!-- <link rel="stylesheet" href="./css/index_mobile.css"> -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
</head>
<body>
    <header id="cabecalho">
        <nav class="navbar navbar-expand-sm bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid border-bottom">
                <a class="navbar-brand" href="./index.php"><img src="./imgs/logo_recicla_mais.svg" class="logo-top" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-md-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a href="./index.php" class="nav-link temaGreen">Home</a>
                        <a href="./telas/sobreNos.php" class="nav-link temaGreen">Sobre Nós</a>
                        <a href="./telas/ajuda.php" class="nav-link temaGreen">Ajuda</a>
                        <a class="btn" href="./telas/login.php" role="button">Entrar</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div  id="navCards" class="container d-flex text-center justify-content-around pt-3">
        <div class="card m-3">
            <span class="material-icons">
                forest
            </span>
            <div class="card-body">
              <p class="card-text">Nosso grupo RECICLA+ é empenhado em melhorar o meio ambiente a cada dia!</p>
            </div>
        </div>
        <div class="card m-3">
            <span class="material-icons">
                recycling
            </span>
            <div class="card-body">
              <p>Aprenda a reciclar o material que você tem em casa de maneira rápida, não descarte o seu lixo de maneira incorreta.</p>
            </div>
        </div>
        <div class="card m-3">
            <span class="material-icons">
                delete_forever
            </span>
            <div class="card-body">
              <p>10,5 milhões de toneladas de resíduos sólidos urbanos foram destinados de forma inadequada no Brasil em 2019.</p>
            </div>
        </div>
    </div>
    <div class="card container">
        <div class="row no-gutters card-conteudo">
          <div class="col-md-5">
            <img src="./imgs/foto-site-sem-login.svg" class="card-img" alt="...">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <h5 class="card-title">Por que Reciclar?</h5>
              <p class="card-text">Quanto mais reciclar, mais diminuirá os custos com limpeza urbana, além de evitar a poluição reduzindo as emissões de gases de efeito estufa que provocam a mudança climática global, mantendo o Meio Ambiente sustentável para as gerações futuras.</p>
            </div> 
          </div>
        </div>
      </div>

      <div  id="navCards" class="container d-flex text-center justify-content-around pt-3">
        <a href="./telas/pontosColeta.php">
            <div class="card m-3">
                <span class="material-icons">
                    place
                </span>
                <div class="card-body">
                    <p class="card-text">Pontos de<br> Coleta</p>
                </div>
            </div>
        </a>
        <a href="./telas/comoReciclar.php">
            <div class="card m-3">
                <span class="material-icons">
                    recycling
                </span>
                <div class="card-body">
                    <p class="card-text">Reciclagem <br> de Materias</p>
                </div>
            </div>
        </a>
        <a href="./telas/ranking.php">
            <div class="card m-3">
                <span class="material-icons">
                    stars
                </span>
                <div class="card-body">
                    <p class="card-text">Ranking</p>
                </div>
            </div>
        </a>
    </div>
    <div id="rodape" class="container-fluid">
        <div id="rodape" class="container-fluid">
            <footer class="d-flex flex-wrap justify-content-around align-items-center py-3 my-4 border-top">
                <div class="d-flex align-items-center">
                <a href="#" class="">
                    <img src="./imgs/logo_recicla_mais.svg" alt="" class="logo-bottom">
                </a>
                <p class="mb-3 mb-md-0  temaGreen">reciclamaissuporte@gmail.com</p>
                </div>
            </footer>
            <p class="text-center pb-4  temaGreen">Reciclar nunca foi tão fácil!</p>
        </div>
    </div>
    <!--<a href="https://www.flaticon.com/br/icones-gratis/reciclar" title="reciclar ícones">Reciclar ícones criados por Freepik - Flaticon</a>-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>