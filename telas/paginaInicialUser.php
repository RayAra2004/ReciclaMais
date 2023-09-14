<?php 
    $css = '<link rel="stylesheet" href="../css/paginaInicialUser.css"> <script src="../script/paginaInicialUser.js" defer></script>';
    include './componentes/header.php';
?>
<section class="body_content">
    <div class="conteudo">
        <div class="opcoes">
            <div class="grupo">
                <div class="option">
                    <span class="material-icons">
                        location_on
                    </span>
                    <p>Pontos De Coleta</p>
                </div>
            </div>
            <div class="grupo">
                <br>
                <br>
                <div class="option">
                    <span class="material-icons">
                        add_circle_outline
                    </span>
                    <p>Adicionar Ponto</p>
                </div>
            </div>
        </div>
        <div class="opcoes">
            <div class="grupo">
                <div class="option">
                    <span class="material-icons">
                        recycling
                    </span>
                    <p>Reciclagem de Materiais</p>
                </div>
            </div>
            <div class="grupo">
                <div class="option">
                    <span class="material-icons">
                        stars
                    </span>
                    <p>Melhores Avaliações</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    include './componentes/footer.php'
?>