<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recicla +</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="/ReciclaMais/css/reset.css">
        <link rel="stylesheet" href="/ReciclaMais/css/geral.css">
        <?php echo $css ?>
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
        <!-- Adicione o Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" defer></script>

    </head>
    <?php 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    ?>
    <body>
        <nav class="navbar navbar-expand-sm header" data-bs-theme="dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/ReciclaMais/index.php">
                        <img src="/ReciclaMais/imgs/logo_recicla_mais.svg" class="logo-top" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-md-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a href="/ReciclaMais/index.php" class="nav-link temaGreen">Home</a>
                            <a href="/ReciclaMais/telas/entidades/sobreNos/sobreNos.php" class="nav-link temaGreen">Sobre Nós</a>
                            <a href="/ReciclaMais/telas/entidades/ajuda/ajuda.php" class="nav-link temaGreen">Ajuda</a>
                            <!--<a class="btn temaGreen" href="/ReciclaMais/telas/login.php" role="button">Entrar</a>-->
                            <?php echo $_SESSION['comp_header'] ?>
                        </div>
                    </div>
                </div>
        </nav>