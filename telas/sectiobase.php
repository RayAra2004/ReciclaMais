<?php 
    session_start();
    if (!(isset($_SESSION['comp_header']))){
        $_SESSION['comp_header'] = '<a class="btn temaGreen" href="/ReciclaMais/telas/login.php" role="button">Entrar</a>';
    }
    $css = '<link rel="stylesheet" href="../css/login.css"> <script src="../script/login.js" defer></script>';
    include './componentes/header.php';
?>
<section class="body_content">
    
</section>
<?php
    include './componentes/footer.php'
?>    