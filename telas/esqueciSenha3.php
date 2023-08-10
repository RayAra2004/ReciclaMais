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
    <script src="../srcipt/cabecalho/geral.js" defer></script>
    <title>Aprender a reciclar</title>
</head>
<body onload="header(); footer()">
    <header id="cabecalho"></header>
    <div class="container mt-5 todo">
        <div class="container d-flex justify-content-center">
            <div class="col-md-4">
                <div class="card px-5 py-3" id="form1">
                    <form id="form-login" action=""  class="d-flex flex-column">
                        <label for="input-email" class="mb-2 text-white">Digite sua senha:</label>
                        <input class="mb-3" type="text" name="input-email" id="input-email" placeholder="Digite seu Email" required>
                        <div class="invalid-email vermelho">Senha inválida!</div>

                        <label for="input-senha" class="mb-2 text-white">Reescreva sua senha:</label>
                        <input class="mb-3" type="password" name="input-senha" id="input-senha" placeholder="Digite sua senha" required>
                        <div class="invalid-password vermelho">Senha precisa ter 8 caracteres!</div>

                        <button click="submit" class="btn border-0 btn-dark container preto">Login</button>
                        <div id="opcoes" class="d-flex azul mt-3 text-center justify-content-around gap-2"><a class="" onclick="alert('pagina não criada')">Esqueci minha senha</a><a class="" href="./cadastro.html">Cadastre-se</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="rodape" class="container-fluid"></div>
</body>
</html>