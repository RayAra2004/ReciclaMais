<?php 
    $css = '<link rel="stylesheet" href="/ReciclaMais/css/descricaoPonto.css"> <script src="./../script/componentes/Comentario.js" defer></script>';
    include './../../componentes/header.php';
?>
<section class="body_content">
    <div class="container d-flex flex-wrap flex-column align-content-center pt-4">
        <div class="container d-flex justify-content-center">
            <p>INFORMAÇÕES DO PONTO SELECIONADO</p>
        </div>
        <div class="divPontuacao">
            <div class="pontuacao d-flex justify-content-start pt-1">
                <ion-icon class="estrela" name="star"></ion-icon>
                <p class="mt-1">4.8/5.0</p>
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <img class="img-fluid w-25" src="./../imgs/pessoas_reciclando.jpg" alt="">
        </div>
        <div class="container text-center mt-3 pt-5 infos-gerais">
            <p>NOME: MARCA AMBIENTAL</p>
            <p>ENDEREÇO:</p>
            <p>Rod. Gov. Mário Covas, 1864 - Padre Martins, Cariacica - ES, <br> 29157-100</p>
            <br> <br>
            <p>TELEFONE: (27) 2123-7700</p>
        </div>
        <div class="container mt-3 d-flex flex-column flex-wrap justify-content-center align-content-center avaliacao">
            <p class="mb-4 text-center">AVALIE O PONTO</p>
            <div class="d-flex justify-content-center">
                <ion-icon class="estrela" name="star-outline"></ion-icon>
                <ion-icon class="estrela" name="star-outline"></ion-icon>
                <ion-icon class="estrela" name="star-outline"></ion-icon>
                <ion-icon class="estrela" name="star-outline"></ion-icon>
                <ion-icon class="estrela" name="star-outline"></ion-icon>
            </div>
        </div>
        <div class="container comentario d-flex flex-column flex-wrap align-content-center mt-3">
            <p class="mb-3">ADICIONE UM COMENTÁRIO</p>
            <input type="text" name="" id="" placeholder="Adicione um comentário">
        </div>
        <div class="container mt-4 comentarios"></div>
        <div class="container mt-5 mb-5 abrir-maps d-flex justify-content-center">
            <button>ABRIR TRAGETÓRIA ATÉ O PONTO</button>
        </div>
    </div>
</section>
<?php
    include './../../componentes/footer.php'
?> 