function header(){
    const header = document.getElementById("cabecalho").innerHTML = 
    `
    <nav class="navbar navbar-expand-sm bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./../index.php"><img src="../imgs/logo_recicla_mais.svg" class="logo-top" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-md-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a href="../index.php" class="nav-link">Home</a>
                    <a href="../telas/sobreNos.php" class="nav-link">Sobre Nós</a>
                    <a href="../telas/ajuda.php" class="nav-link">Ajuda</a>
                    <a class="btn" href="./../telas/login.php" role="button">Entrar</a>
                </div>
            </div>
        </div>
    </nav>
    `    
    let a = document.getElementsByClassName("nav-link");
    for (i = 0; i < a.length; i++) {
        a[i].style.color = "#05e981";
    }
    let b = document.getElementsByClassName("btn");
    for (i = 0; i < b.length; i++) {
        b[i].style.color = "#000";
        b[i].style.background = "#05e981";
    }
}

function footer(){
    const footer = document.getElementById("rodape").innerHTML =
    `   
    <footer class="d-flex flex-wrap justify-content-around align-items-center py-3 my-4">
        <div class="d-flex align-items-center">
            <a href="#" class="">
                <img src="./../imgs/logo_recicla_mais.svg" alt="" class="logo-bottom">
            </a>
            <p class="mb-3 mb-md-0  temaGreen">reciclamaissuporte@gmail.com</p>
        </div>
    </footer>
    <p class="text-center pb-4  temaGreen">Reciclar nunca foi tão fácil!</p>
    `
}