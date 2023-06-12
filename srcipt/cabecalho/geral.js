function header(){
    const header = document.getElementById("cabecalho").innerHTML = `
    <nav class="navbar navbar-expand-sm bg-body-tertiary m-2" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./../index.html"><img src="../imgs/logo_recicla_mais.svg" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a href="../index.html" class="nav-link">Home</a>
                    <a href="../telas/sobreNos.html" class="nav-link">Sobre Nós</a>
                    <a href="" class="nav-link">Seja um validador</a>
                    <a href="../telas/ajuda.html" class="nav-link">Ajuda</a>
                </div>
            </div>
        </div>
    </nav>
    `    
    let a = document.getElementsByClassName("nav-link");
    for (i = 0; i < a.length; i++) {
        a[i].style.color = "#05e981";
    }
}