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
    <link rel="stylesheet" href="../css/login.css">
    <script src="./../script/login.js" defer></script>
    <script src="../script/cabecalho/geral.js" defer></script>
    <link rel="stylesheet" href="./../css/geral.css">
    <title>Login</title>
</head>
<body>
    <div class="container mt-5 todo">
        <div class="container d-flex justify-content-center conteudo">
            <div class="container-fluid m-0 p-0 div-img-login">
                <img class="img-fluid img-login" src="./../imgs/login_desktop.png"/>
            </div>
            <div class="col-md-4">
                <div class="container card px-5 py-3 form1">
                    <div class="d-flex justify-content-center">
                        <a href="../index.php">
                            <img src="./../imgs/logo_recicla_mais2.svg"/>
                        </a>
                    </div>
                    <form id="form-login" action=""  class="d-flex flex-column">
                        <label for="input-email" class="mb-2">Digite seu email:</label>
                        <input class="mb-3" type="email" name="input-email" id="input-email" placeholder="Digite seu Email" required >
                        
                        <label for="input-senha" class="mb-2">Digite sua senha:</label>
                        <input class="mb-2" type="password" name="input-senha" id="input-senha" placeholder="Digite sua senha" 
                        required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$">
                        
                        <a class="mb-4" href="./esqueciSenha.php">Esqueci minha senha</a>
                        <!-- <span class="lnr lnr-eye"></span>  olinho -->
                        <button click="submit" class="btn border-0 container bg_verde preto">Login</button>
                        <div id="opcoes" class="azul mt-3 text-center justify-content-around gap-2">
                            <p class="azul">Ainda não possui cadastro?</p>
                            <a class="d-flex justify-content-center" href="./cadastro.php">
                                <div class="btn-cadastre">
                                    <p>Cadastre-se</p>
                                </div>
                            </a>
                        </div>
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