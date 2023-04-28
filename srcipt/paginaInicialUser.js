function header(){
    const header = document.querySelector('.header_desktop');
    header.innerHTML = `
    <div class="logo">
        <img src="../imgs/logo_recicla_mais.svg" alt="">
    </div>
    <div class="links">
        <a href="../index.html">Home</a>
        <a href="../telas/sobreNos.html">Sobre Nós</a>
        <a href="">Seja um validador</a>
        <a href="">Ajuda</a>
    </div>
    <button>
        <a href="../telas/login.html">Entrar</a>
    </button>
    `
    const header_mobile = document.querySelector('.header_mobile');
    header_mobile.innerHTML = `
        <div class="logo">
            <img src="./imgs/logo_recicla_mais.svg" alt="">
        </div>
        <button>Entrar</button>
        <div class="menu">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
    `       
}