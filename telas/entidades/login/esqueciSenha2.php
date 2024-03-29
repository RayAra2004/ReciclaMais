<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">  </head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="../css/reset.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
    <link rel="stylesheet" href="../css/esqueciSenha.css">
    <link rel="stylesheet" href="./../css/geral.css">
    <script src="../script/cabecalho/geral.js" defer></script>
    <!--<script src="./../script/login.js" defer></script>-->
    <title>Aprender a reciclar</title>
</head>
<body onload="header(); footer()">
    <header id="cabecalho"></header>
    <div class="container pt-5 todo">
        <div class="container d-flex justify-content-center">
            <div class="col-md-4">
                <div class="card px-5 py-3" id="form1">
                    <form id="form-login" action=""  class="d-flex flex-column">
                        <label for="input-email" class="mb-2 text-white">Digite o código que recebeu pelo email:</label>
                        <input class="mb-3" type="text" name="input-email" id="input-email" placeholder="Digite seu Email" required>
                        <div class="invalid-email vermelho">Código inválido!</div>

                        <a href="./esqueciSenha3.php"><div class="btn border-0 btn-dark container preto">Este é o código que recebi</div></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="rodape" class="container-fluid"></div>
</body>
</html>