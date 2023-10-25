<?php 
    session_start();
    if (!(isset($_SESSION['comp_header']))){
        $_SESSION['comp_header'] = '<a class="btn temaGreen" href="/ReciclaMais/telas/entidades/login/login.php" role="button">Entrar</a>';
    }
    $css = '<link rel="stylesheet" href="../ReciclaMais/css/index.css">';
    include '../ReciclaMais/telas/componentes/header.php';

    include './sql/entidades/Usuario.php';
?>
    <section class="body_content">
        <?php 
            $usuarios = new Usuario();
            $tabela_usuarios = $usuarios->findAll();

            if(count($tabela_usuarios) > 0){
                foreach($tabela_usuarios as $usuario){
                    echo $usuario['nome'];
                }
            }
        ?>
        <div  id="navCards" class="container d-flex text-center justify-content-around pt-3">
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
    </section>
<?php
    include '../ReciclaMais/telas/componentes/footer.php'
?>