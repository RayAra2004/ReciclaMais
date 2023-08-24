const ranking1 = document.getElementById('ranking1');
const ranking2 = document.getElementById('ranking2');

let rankig = '';
for(let i = 0; i < 10; i++){
    rankig += `
    <div class="card mb-3 ranking-empresa">
        <div class="row g-0">
            <div class="col-md-4 img-empresa">
                <img src="./../imgs/logoMA.png" class="img-empresa img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <div class="card-header">
                    <h5 class="card-title">MARCA AMBIENTAL</h5>
                </div>
                <div class="card-body d-flex mt-3 infos-card">
                    <p class="card-text d-flex">
                        <ion-icon class="" name="pint-outline"></ion-icon>
                        <ion-icon class="ms-3" name="star"></ion-icon>
                        <span>4.8/5</span>
                        <a href="./descricaoPonto.php">
                            <button class="btn-infos ms-3">Ver mais</button>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    `
}

ranking1.innerHTML = rankig;
ranking2.innerHTML = rankig;

            