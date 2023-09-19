<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">  </head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="../css/reset.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css"> <!--olinho-->
    <link rel="stylesheet" href="../css/assinatura.css">
    <!--<script src="./../script/login.js" defer></script>-->
    <script src="../script/cabecalho/geral.js" defer></script>
    <link rel="stylesheet" href="./../css/geral.css">


    <title>Aprender a reciclar</title>
</head>
<body>
    <div class="container mt-5 todo">
        <div class="container d-flex justify-content-center flex-wrap">
            <div class="container-fluid m-0 p-0 div-img-login">
                <img class="img-fluid img-login" src="./../imgs/login_desktop.png"/>
            </div>
            <div class="col-lg-4 div-form">
                <div class="container card px-5 py-3 form1">
                <form action="/cadastro" method="post">
                    <div class="mb-3">
                    <label for="numero_cartao" class="form-label">Número do cartão</label>
                    <input type="text" class="form-control" id="numero_cartao" name="numero_cartao" style="width: 100%;">
                    </div>
                    <div class="mb-3">
                    <label for="nome_titular" class="form-label">Nome do titular</label>
                    <input type="text" class="form-control" id="nome_titular" name="nome_titular" style="width: 100%;">
                    </div>
                    <div class="mb-3">
                    <label for="validade" class="form-label">Validade</label>
                    <input type="month" class="form-control" id="validade" name="validade" style="width: 100%;">
                    </div>
                    <div class="mb-3">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" style="width: 100%;">
                    </div>
                    <div class="mb-3">
                    <label for="bandeira" class="form-label">Tipo</label>
                    <select class="form-control preto" id="bandeira" name="bandeira">
                        <option value="visa" class="preto">Crédito</option>
                        <option value="mastercard" class="preto">Débito</option>
                    </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-cadastre" id="finaliza_cartão">Cadastrar</button>
                </form>
                </div>
                <div class="card px-5 py-3 h-50 d-none justify-content-center align-content-center flex-wrap invalid-email" id="invalid-email">
                    <div class="container-progress">
                        <div class="progress-bar"></div>
                    </div>
                    <p class="text-center">EMAIL NÃO CADASTRADO NO SISTEMA</p>
                </div>
                <div class="card px-5 py-3 h-50 d-none justify-content-center align-content-center flex-wrap invalid-email" id="invalid-password">
                    <div class="container-progress">
                        <div class="progress-bar"></div>
                    </div>
                    <p class="text-center">SENHA INCORRETA</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>