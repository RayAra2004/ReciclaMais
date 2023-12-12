function Comentario(){
    const comentarios = document.querySelector('.comentarios');
    let c = '';
    for(let i = 0; i < 4; i++){
        c += `
        <div class="comentario-user row mt-3">
            <div class="perfil-comentario ms-3 col-3">
                <ion-icon name="person-circle-outline"></ion-icon>
                <p>Carlos Eduardo</p>
            </div>
            
            <div class="container col-8 mt-5">
                <span>O ponto está localizado exatamente como descrito</span>
            </div>
            <div class="avaliacao-user">
                <div class="d-flex justify-content-center">
                    <ion-icon class="estrela" name="star-outline"></ion-icon>
                    <ion-icon class="estrela" name="star-outline"></ion-icon>
                    <ion-icon class="estrela" name="star-outline"></ion-icon>
                    <ion-icon class="estrela" name="star-outline"></ion-icon>
                    <ion-icon class="estrela" name="star-outline"></ion-icon>
                </div>
            </div>
        </div>
        `
    }

    comentarios.innerHTML = c;
}
