<?php 
    include './telas/componentes/header.php'
?>
    <section class="body_content">
        <?php echo
        `<div  id="navCards" class="container d-flex text-center justify-content-around pt-3">
            <div class="card m-3">
                <span class="material-icons">
                    forest
                </span>
                <div class="card-body">
                <p class="card-text">Nosso grupo RECICLA+ é empenhado em melhorar o meio ambiente a cada dia!</p>
                </div>
            </div>
            <div class="card m-3">
                <span class="material-icons">
                    recycling
                </span>
                <div class="card-body">
                <p>Aprenda a reciclar o material que você tem em casa de maneira rápida, não descarte o seu lixo de maneira incorreta.</p>
                </div>
            </div>
            <div class="card m-3">
                <span class="material-icons">
                    delete_forever
                </span>
                <div class="card-body">
                <p>10,5 milhões de toneladas de resíduos sólidos urbanos foram destinados de forma inadequada no Brasil em 2019.</p>
                </div>
            </div>
        </div>
        <div class="card container">
            <div class="row no-gutters card-conteudo">
            <div class="col-md-5">
                <img src="./imgs/foto-site-sem-login.svg" class="card-img" alt="...">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                <h5 class="card-title">Por que Reciclar?</h5>
                <p class="card-text">Quanto mais reciclar, mais diminuirá os custos com limpeza urbana, além de evitar a poluição reduzindo as emissões de gases de efeito estufa que provocam a mudança climática global, mantendo o Meio Ambiente sustentável para as gerações futuras.</p>
                </div> 
            </div>
            </div>
        </div>

        <div  id="navCards" class="container d-flex text-center justify-content-around pt-3">
            <a href="./telas/pontosColeta.php">
                <div class="card m-3">
                    <span class="material-icons">
                        place
                    </span>
                    <div class="card-body">
                        <p class="card-text">Pontos de<br> Coleta</p>
                    </div>
                </div>
            </a>
            <a href="./telas/comoReciclar.php">
                <div class="card m-3">
                    <span class="material-icons">
                        recycling
                    </span>
                    <div class="card-body">
                        <p class="card-text">Reciclagem <br> de Materias</p>
                    </div>
                </div>
            </a>
            <a href="./telas/ranking.php">
                <div class="card m-3">
                    <span class="material-icons">
                        stars
                    </span>
                    <div class="card-body">
                        <p class="card-text">Ranking</p>
                    </div>
                </div>
            </a>
        </div>
        <div id="rodape" class="container-fluid">
            <div id="rodape" class="container-fluid">
                <footer class="d-flex flex-wrap justify-content-around align-items-center py-3 my-4 border-top">
                    <div class="d-flex align-items-center">
                    <a href="#" class="">
                        <img src="./imgs/logo_recicla_mais.svg" alt="" class="logo-bottom">
                    </a>
                    <p class="mb-3 mb-md-0  temaGreen">reciclamaissuporte@gmail.com</p>
                    </div>
                </footer>
                <p class="text-center pb-4  temaGreen">Reciclar nunca foi tão fácil!</p>
            </div>
        </div>
        <!--<a href="https://www.flaticon.com/br/icones-gratis/reciclar" title="reciclar ícones">Reciclar ícones criados por Freepik - Flaticon</a>-->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>`;?>
    </section>
</body>
</html>