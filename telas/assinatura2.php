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
    <div class="row form1">
      <div class="col-md-10">
        <h1 class="verde"><a>Cadastro de cartão</a></h1>
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
            <input type="date" class="form-control" id="validade" name="validade" style="width: 100%;">
          </div>
          <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cvv" name="cvv" style="width: 100%;">
          </div>
          <div class="mb-3">
            <label for="bandeira" class="form-label">Bandeira</label>
            <select class="form-control" id="bandeira" name="bandeira">
              <option value="visa">Visa</option>
              <option value="mastercard">Mastercard</option>
              <option value="elo">Elo</option>
              <option value="hipercard">Hipercard</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
      </div>
    </div>
    </div>
</body>
</html>