<?php 
    $css = '<link rel="stylesheet" href="../css/ranking.css"> <script src="./../script/componentes/CardRanking.js" defer></script>';
    include './componentes/header.php';
?>
<section class="body_content">
    <div class="container row m-auto">
        <p class="text-center text-white my-4">RANKING</p>
        <div class="p-0 d-flex flex-desktop">
            <div id="ranking1" class="container col-6 d-flex flex-column flex-wrap align-content-center"></div>
            <div id="ranking2" class="container col-6 d-flex flex-column flex-wrap align-content-center"></div>
        </div>
        
    </div>
</section>
<?php
    include './componentes/footer.php'
?>